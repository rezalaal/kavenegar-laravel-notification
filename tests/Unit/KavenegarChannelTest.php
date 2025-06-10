<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Notifications\Notification;
use Kavenegar\LaravelNotification\KavenegarChannel;
use Kavenegar\KavenegarApi;
use Mockery;


class KavenegarChannelTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_sms_is_sent_via_kavenegar()
    {
        $sender = '10004346';
        $receptor = '09123456789';
        $message = 'Test message';

        $notifiable = Mockery::mock();
        $notifiable->shouldReceive('routeNotificationFor')->with('sms')->andReturn($receptor);

        $notification = Mockery::mock(Notification::class);
        $notification->shouldReceive('toSMS')->with($notifiable)->andReturn($message);

        $api = Mockery::mock(KavenegarApi::class);
        $api->shouldReceive('Send')->once()->with($sender, $receptor, $message);

        config(['services.kavenegar.sender' => $sender]);

        $channel = new KavenegarChannel($api);
        $channel->send($notifiable, $notification);

        // Assert mock expectations are met
        $this->assertTrue(true);
    }

    public function test_send_does_nothing_when_no_receptor()
    {
        $sender = '10004346';

        $notifiable = Mockery::mock();
        $notifiable->shouldReceive('routeNotificationFor')->with('sms')->andReturn(null);

        $notification = Mockery::mock(Notification::class);

        $api = Mockery::mock(KavenegarApi::class);
        $api->shouldReceive('Send')->never();

        config(['services.kavenegar.sender' => $sender]);

        $channel = new KavenegarChannel($api);
        $channel->send($notifiable, $notification);

        // Assert mock expectations are met
        $this->assertTrue(true);
    }

}
