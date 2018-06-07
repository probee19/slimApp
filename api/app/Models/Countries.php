<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Countries extends Eloquent
{

    protected $table = 'countries';

    protected $fillable = [
		'alpha2',
		'langFR',
		'langEN',
	];
  public function users(){
      return $this->hasMany('App\Models\User', 'country_code', 'aplha2');
  }

  public function tests(){ 
      return $this->hasManyThrough('App\Models\UserTest', 'App\Models\User', 'country_code', 'user_id', 'alpha2');
  }
}
