<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Share extends Eloquent
{
    protected $table = "shares";

    protected $fillable = [
        'result_code',
        'user_id',
        'test_id',
        'btn_share',
        'shares_count',
        'cron_flag',
        'shares_count',
        'comments_count',
        'reactions_count',
        'lang',
        'ab_testing'
    ];

    public function testInfo(){
        return $this->belongsTo('App\Models\Test', 'test_id', 'id_test');
    }


}
