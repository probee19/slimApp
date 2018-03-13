<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class DailyStat extends Eloquent
{
    protected $table = "daily_stats";

    protected $fillable = [
        'result_code',
        'shares_count',
        'comments_count',
        'reactions_count',
        'clicks_count',
        'partages_count',
        'lang'
    ];

}
