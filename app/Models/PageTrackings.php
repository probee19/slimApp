<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class PageTrackings extends Eloquent
{

    protected $table = 'page_trackings';

    protected $fillable = [
		'utm',
		'page',
		'test_id'
    ];

}
