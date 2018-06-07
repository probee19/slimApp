<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Visitors extends Eloquent
{

    protected $table = 'visitors';

    protected $fillable = [
        'cookie_code',
		'browser',
        'ip_address',
        'country_code',
    ];

}
