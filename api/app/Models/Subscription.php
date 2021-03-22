<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subscription extends Model
{
    /**
     * 複数代入しない属性
     *
     * @var array
     */
    protected $guarded = [];

    public static function saveWithUser($userId, $sessionId)
    {
        DB::beginTransaction();

        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $checkoutSession = \Stripe\Checkout\Session::retrieve($sessionId);

            $user = User::find($userId);
            $user->stripe_id = $checkoutSession->customer;
            $user->save();

            $subscription = Subscription::firstOrNew(['stripe_id' => $checkoutSession->subscription]);
            $subscription->fill([
                'user_id' => $user->id,
                'name' => 'serverside',
                'stripe_id' => $checkoutSession->subscription,
                'stripe_status' => $checkoutSession->payment_status,
            ]);
            $subscription->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $subscription;
    }
}
