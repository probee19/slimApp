<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class DisabledTest extends Eloquent
{

    protected $table = 'disabled_tests';

    protected $fillable = [
        'id_test',
        'objet'
    ];

    public function test(){
        return $this->belongsTo('App\Models\Test', 'id_test', 'id_test');
    }

}
