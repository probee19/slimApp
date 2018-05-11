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
}
