<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class NotificationCampaigns extends Eloquent
{

    protected $table = 'notification_campaigns';

    protected $fillable = [
        'test_id',
        'title',
        'body',
        'url',
        'icon',
        'countries',
        'status'
    ];

}
