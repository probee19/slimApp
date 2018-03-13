<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class TestInfo extends Eloquent
{

    protected $table = 'test_info';

    protected $fillable = [
        'id_test',
        'titre_test',
        'test_description',
        'lang'
    ];

    public function test(){
        return $this->belongsTo('App\Models\Test', 'id_test', 'id_test');
    }
}
