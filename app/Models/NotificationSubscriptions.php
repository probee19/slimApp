<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class NotificationSubscriptions extends Eloquent
{

    protected $table = 'notification_subscriptions';

    protected $fillable = [
        'browser',
        'country_code',
        'token',
        'lang'
    ];

}
