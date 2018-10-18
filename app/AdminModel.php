<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use Pusher\Pusher;

class AdminModel extends Model
{
    protected $table = 'admin_master';
    public $timestamps = false;

    public static function getNotification($token, $title, $message, $notify_data)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($message)->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['data' => json_encode($notify_data)]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

//        $token = "denG_Y3xlKw:APA91bFg0PVxYaI-knF2q-X79Lbz5xRP_a0BhPOQyfSmbW7bYmPQuZyfPUnArMpmYnM8K6WbUKt-iKT4Owjlx31XNH4fMC1ioBsqTtcI5_rEfJJc2ImvvWOBEG_ejPZLdfYzdyZ9eDGx";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);


    }
    public static function getWebNotification()
    {
//        require __DIR__ . '/vendor/autoload.php';

        $options = array(
            'cluster' => 'mt1',
            'useTLS' => true
        );
        $pusher = new Pusher(
            'a6ab632500510572d965',
            '11c13820624124374df6',
            '612652',
            $options
        );

        $data['message'] = 'hello world';
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
