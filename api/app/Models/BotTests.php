<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class BotTests extends Eloquent
{

    protected $table = 'bot_tests';

    protected $fillable = [
		'messenger_user_id',
		'first_name',
		'last_name',
		'gender' ,
		'test_id',
		'uuid',
		'result',
		'img_url',
    ];

    public function testInfo(){
        return $this->belongsTo('App\Models\Test', 'test_id', 'id_test');
    }
}
