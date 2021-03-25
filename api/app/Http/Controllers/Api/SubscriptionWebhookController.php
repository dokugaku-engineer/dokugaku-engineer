<?php

namespace App\Http\Controllers\Api;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Log;

/**
 * @group 5. Subscriptions
 */
class SubscriptionWebhookController extends ApiController
{
    /**
     * @var \Stripe\Subscription
     */
    private $stripeSubscription;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Subscription
     */
    private $subscription;

    /**
     * Webhookの処理
     *
     * @response {}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleWebhook(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $payload = $request->getContent();
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
        } catch (\UnexpectedValueException $e) {
            return $this->respondBadRequest();
        }

        switch ($event->type) {
            case 'customer.subscription.created':
                $this->setEventData($event);

                if (empty($this->user) || empty($this->subscription)) {
                    return $this->respondWithOK([]);
                }

                $this->subscription->ends_at = null;
                $this->subscription->save();
                break;
            case 'customer.subscription.deleted':
                $this->setEventData($event);

                if (empty($this->user) || empty($this->subscription)) {
                    return $this->respondWithOK([]);
                }

                $this->subscription->ends_at = Carbon::createFromTimestamp($this->stripeSubscription->ended_at);
                $this->subscription->save();
                break;
            case 'customer.subscription.updated':
                $this->setEventData($event);

                if (empty($this->user) || empty($this->subscription)) {
                    return $this->respondWithOK([]);
                }

                if ($this->stripeSubscription->cancel_at_period_end) { // サブスクリプションキャンセル時
                    $this->subscription->ends_at = Carbon::createFromTimestamp($this->stripeSubscription->cancel_at);
                } else { // サブスクリプション再開時
                    $this->subscription->ends_at = null;
                }

                $this->subscription->save();
                break;
        }

        return $this->respondWithOK([]);
    }

    /**
     * イベントデータからユーザーとサブスクリプションを格納
     *
     * @param \Stripe\Event $event
     * @return void
     */
    private function setEventData($event)
    {
        /** @phpstan-ignore-next-line */
        $this->stripeSubscription = $event->data->object;
        Log::info($this->stripeSubscription); // Webhookで渡される実データが不明なので一時的にログに吐いておく

        $this->user = User::firstWhere('stripe_id', $this->stripeSubscription->customer);
        if (!$this->user) {
            return;
        }

        $this->subscription = $this->user->subscriptions()->firstWhere('stripe_id', $this->stripeSubscription->items->data[0]->subscription);
    }
}
