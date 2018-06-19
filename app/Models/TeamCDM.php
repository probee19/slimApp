<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class TeamCDM extends Eloquent
{

    protected $table = 'team_cdm_2018';

    protected $fillable = [
		'id',
		'cc',
		'french',
		'english' ,
    ];


}
