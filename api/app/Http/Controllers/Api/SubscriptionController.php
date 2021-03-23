<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Subscription\Subscription as SubscriptionResource;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @group 5. Subscriptions
 */
class SubscriptionController extends ApiController
{
    public function show(Request $request, string $userId)
    {
        if ($request['user_id'] !== (int) $userId) {
            return $this->respondInvalidQuery('Invalid user');
        }
        $subscription = Subscription::where(['user_id' => $userId])->first();
        if ($subscription) {
            return new SubscriptionResource($subscription);
        }
    }

    /**
     * チェックアウトセッションを作成
     *
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
        } catch (\Exception $e) {
            return $this->respondBadRequest($e->getError()->message);
        }

        return $this->respondWithOK(['sessionId' => $checkout->id]);
    }

    public function store(Request $request)
    {
        $sessionId = $request['session_id'];
        $userId = $request['user_id'];

        try {
            $subscription = Subscription::saveWithUser($userId, $sessionId);
            return new SubscriptionResource($subscription);
        } catch (\Exception $e) {
            return $this->respondBadRequest($e->getError()->message);
        }
    }

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
