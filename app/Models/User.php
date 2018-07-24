<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'facebook_id',
        'last_name',
        'genre',
        'test_count',
        'ip_address',
        'country_code',
        'country_name',
    ];

    public function usertests(){
        return $this->hasMany('App\Models\UserTest', 'user_id', 'id');
    }

    public function tests(){
        return $this->hasMany('App\Models\Test', 'id_test_owner', 'facebook_id');
    }
}
