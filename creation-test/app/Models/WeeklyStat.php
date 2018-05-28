<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class WeeklyStat extends Eloquent
{
    protected $table = "weekly_stats";

    protected $fillable = [
        'result_code',
        'shares_count',
        'comments_count',
        'reactions_count',
        'clicks_count',
        'partages_count'
    ];

}
