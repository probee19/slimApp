<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class UserTest extends Eloquent
{

    protected $table = 'users_tests';

    protected $fillable = [
        'user_id',
        'test_id',
        'uuid',
        'shared_link',
        'is_shared',
        'result_id',
        'result_description',
        'img_url',
        'test_from',
        'lang'
    ];

    public function testInfo(){
        return $this->belongsTo('App\Models\Test', 'test_id', 'id_test');
    }

    public function userInfo(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
