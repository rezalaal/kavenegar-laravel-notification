<?php

namespace Kavenegar\LaravelNotification;

use Illuminate\Notifications\Notification;
use Kavenegar\KavenegarApi;
use Throwable;

class KavenegarChannel
{
    protected KavenegarApi $api;

    /**
     * Create a new Kavenegar channel instance.
     */
    public function __construct(KavenegarApi $api)
    {
        $this->api = $api;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  Notification  $notification
     * @return void
     * @throws Throwable
     */
    public function send(mixed $notifiable, Notification $notification): void
    {
        $sender = config('services.kavenegar.sender');
        $receptor = $notifiable->routeNotificationFor('sms');

        // اگر گیرنده یا پیام خالی باشد، ارسال انجام نشود
        if (empty($receptor)) {
            return;
        }

        $message = $notification->toSMS($notifiable);

        try {
            $this->api->Send($sender, $receptor, $message);
        } catch (Throwable $e) {
            report($e); // لاگ یا هندل بهتر
        }
    }
}
