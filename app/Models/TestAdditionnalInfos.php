<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class TestAdditionnalInfos extends Eloquent
{

    protected $table = 'test_additionnal_infos';

    protected $fillable = [
        'id_test',
        'id_additionnal_info',
        'label',
        'lang'
    ];

    public function additionalInfos(){
       return $this->belongsTo('App\Models\AdditionnalInfos', 'id_additionnal_info', 'id');
    }

}
