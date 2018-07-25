<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ClickEvents extends Eloquent
{

    protected $table = 'click_events';

    protected $fillable = [
        'cookie_code',
    		'button',
    		'ip_address',
        'browser',
    ];

}
