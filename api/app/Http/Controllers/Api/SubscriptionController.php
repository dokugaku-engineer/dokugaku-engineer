<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Subscription\Subscription as SubscriptionResource;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * @group 5. Subscriptions
 */
class SubscriptionController extends ApiController
{
    /**
     * サブスクリプション情報を取得
     *
     * @queryParam user_id int required User id. Example: 10
     *
     * @responsefile responses/subscription.show.json
     *
     * @param  Request  $request
     * @return SubscriptionResource|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request, string $userId)
    {
        if ($request['user_id'] !== (int) $userId) {
            return $this->respondInvalidQuery('Invalid user');
        }
        $subscriptions = Subscription::where(['user_id' => $userId])->get();
        $subscription = $subscriptions->sortByDesc('updated_at')->first();
        // 購読中のものに絞る
        $subscribingSubs = $subscriptions->filter(function ($v) {
            return $v['status'] === 'paid' &&
                ($v['ends_at'] === null ||
                    Carbon::now()->lt(new Carbon($v['ends_at'])));
        });

        if ($subscribingSubs->isNotEmpty()) {
            $subscription = $subscribingSubs->sortByDesc('updated_at')->first();
        }

        if ($subscription) {
            return new SubscriptionResource($subscription);
        }

        return $this->respondWithOK([]);
    }

    /**
     * チェックアウトセッションを作成
     *
     * @bodyParam price_id string required Stripe Price id. Example: price_1IXhEbFtloVF6oou
     *
     * @response {
     *   "sessionId": "cs_test_a1WlBanMf7"
     * }
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCheckoutSession(Request $request)
    {
        try {
            $user = User::find($request['user_id']);
            $priceId = $request['price_id'];
            $checkout = $user->newSubscription('serverside', $priceId)->checkout([
                'success_url' => env('CLIENT_SCHEME', 'http') . '://' . env('CLIENT_URL', 'localhost:3333') . '/course/serverside?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => env('CLIENT_SCHEME', 'http') . '://' . env('CLIENT_URL', 'localhost:3333') . '/course/serverside',
            ]);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return $this->respondBadRequest($e->getError()->message);
        } catch (\Exception $e) {
            return $this->respondBadRequest($e->getMessage());
        }

        /** @phpstan-ignore-next-line */
        return $this->respondWithOK(['sessionId' => $checkout->id]);
    }

    /**
     * サブスクリプションを保存
     *
     * @bodyParam session_id string required Stripe session id. Example: cs_test_a1WlBanMf7
     *
     * @responsefile responses/subscription.show.json
     *
     * @param  Request  $request
     * @return SubscriptionResource|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $sessionId = $request['session_id'];
        $userId = $request['user_id'];

        try {
            $subscription = Subscription::saveWithUser($userId, $sessionId);

            return new SubscriptionResource($subscription);
        } catch (\Exception $e) {
            return $this->respondBadRequest($e->getMessage());
        }
    }

    /**
     * カスタマーポータルを作成
     *
     * @response {
     *   "url": "https://billing.stripe.com/session/_JANkBAkl6"
     * }
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function customerPortal(Request $request)
    {
        $user = User::find($request['user_id']);
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = \Stripe\BillingPortal\Session::create([
            'customer' => $user->stripe_id,
            'return_url' => env('CLIENT_SCHEME', 'http') . '://' . env('CLIENT_URL', 'localhost:3333') . '/settings/billing',
        ]);

        return $this->respondWithOK(['url' => $session->url]);
    }
}
