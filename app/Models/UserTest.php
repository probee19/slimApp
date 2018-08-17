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
        'url_thum_io',
        'test_from',
        'lang',
        'ab_testing'
    ];

    public function testInfo(){
        return $this->belongsTo('App\Models\Test', 'test_id', 'id_test');
    }
}
