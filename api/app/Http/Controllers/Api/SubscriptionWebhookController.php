<?php

namespace App\Http\Controllers\Api;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * @group 5. Subscriptions
 */
class SubscriptionWebhookController extends ApiController
{
    /**
     * @var \Stripe\Subscription|\Stripe\Invoice
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
     * @var int
     */
    private const ADD_END_DAYS = 2;

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
            case 'invoice.payment_succeeded': // 支払い成功時
                $this->setEventData($event);

                if (empty($this->user)) {
                    return $this->respondWithOK([]);
                }

                /** @phpstan-ignore-next-line */
                $endsAt = Carbon::createFromTimestamp($this->stripeSubscription->lines->data[0]->period->end)->addDays(self::ADD_END_DAYS);

                if (isset($this->subscription)) {
                    $this->subscription->ends_at = $endsAt;
                    $this->subscription->save();
                    break;
                }

                $subscription = new Subscription();
                $subscription->fill([
                    'user_id' => $this->user->id,
                    'name' => 'serverside',
                    'stripe_id' => $this->stripeSubscription->subscription,
                    'stripe_status' => $this->stripeSubscription->status,
                    'ends_at' => $endsAt,
                ]);
                $subscription->save();
                break;
            case 'customer.subscription.deleted': // サブスクリプション終了時
                $this->setEventData($event);

                if (empty($this->user) || empty($this->subscription)) {
                    return $this->respondWithOK([]);
                }

                $this->subscription->ends_at = Carbon::createFromTimestamp($this->stripeSubscription->ended_at);
                $this->subscription->save();
                break;
            case 'customer.subscription.updated': // サブスクリプション再開、キャンセル時
                $this->setEventData($event);

                if (empty($this->user) || empty($this->subscription)) {
                    return $this->respondWithOK([]);
                }

                if ($this->stripeSubscription->cancel_at_period_end) { // サブスクリプションキャンセル時
                    $this->subscription->ends_at = Carbon::createFromTimestamp($this->stripeSubscription->cancel_at);
                } else { // サブスクリプション再開時
                    $this->subscription->ends_at = Carbon::createFromTimestamp($this->stripeSubscription->current_period_end)->addDays(self::ADD_END_DAYS);
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

        $this->user = User::firstWhere('stripe_id', $this->stripeSubscription->customer);
        if (!$this->user) {
            return;
        }

        $stripeSubscriptionId = '';
        if ($this->stripeSubscription->items) { // invoice.payment_succeeded 以外のイベント時
            $stripeSubscriptionId = $this->stripeSubscription->items->data[0]->subscription;
        } elseif ($this->stripeSubscription->lines) { // invoice.payment_succeeded のイベント時
            $stripeSubscriptionId = $this->stripeSubscription->lines->data[0]->subscription;
        }

        $this->subscription = $this->user->subscriptions()->firstWhere('stripe_id', $stripeSubscriptionId);
    }
}
