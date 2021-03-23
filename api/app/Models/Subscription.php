<?php

namespace App\Models;

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

    /**
     * サブスクリプションとユーザーを保存
     *
     * @param int    $userId    ユーザーID
     * @param string $sessionId StripeのセッションID
     */
    public static function saveWithUser(int $userId, string $sessionId)
    {
        DB::beginTransaction();

        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $checkoutSession = \Stripe\Checkout\Session::retrieve($sessionId);

            $user = User::find($userId);
            $user->stripe_id = $checkoutSession->customer;
            $user->save();

            $subscription = self::firstOrNew(['stripe_id' => $checkoutSession->subscription]);
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
