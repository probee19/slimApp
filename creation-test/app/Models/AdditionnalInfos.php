<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class AdditionnalInfos extends Eloquent
{

    protected $table = 'additionnal_infos';

    protected $fillable = [
        'name',
        'label_back',
        'label_front',
        'typeinput'
    ];

}
