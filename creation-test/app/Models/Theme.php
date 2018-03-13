<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Theme extends Eloquent
{

    protected $table = 'themes';

    protected $fillable = [];

    public function tests(){ 
        return $this->hasMany('App\Models\Test', 'id_theme', 'id');
    }
}
