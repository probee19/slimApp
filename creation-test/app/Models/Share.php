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
        'lang'
    ];

    public function testInfo(){
        return $this->belongsTo('App\Models\Test', 'test_id', 'id_test');
    }

    public function userTestInfo(){
        return $this->belongsTo('App\Models\UserTest', 'result_code', 'uuid');
    }

    public function userInfo(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
