<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * @group 5. Subscriptions
 */
class SubscriptionController extends ApiController
{

    public function subscribe(Request $request)
    {
        $user = $request->user();
        // $userId = $request['user_id'];

        if (!$user->subscribed('serverside')) {
            $payment_method = $request->payment_method;
            $plan = $request->plan;
            $user->newSubscription('serverside', $plan)->create($payment_method);
            $user->load('subscriptions');
        }

        return $this->status();
    }

    /**
     * チェックアウトセッションを作成
     *
     */
    public function createCheckoutSession(Request $request)
    {
        $userId = $request['user_id'];
        $priceId = $request['price_id'];

        try {
            $user = User::find($userId);
            $checkout = $user->newSubscription('serverside', $priceId)->checkout([
                'success_url' => route('course', ['name' => 'serverside']),
                'cancel_url' => route('course', ['name' => 'serverside']),
            ]);
        } catch (\Exception $e) {
            return $this->respondBadRequest($e->getError()->message);
        }

        return $this->respondWithOK(['sessionId' => $checkout->id]);
    }
}
