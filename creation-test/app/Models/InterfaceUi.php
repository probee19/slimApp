<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class InterfaceUi extends Eloquent
{

    protected $table = 'interface_ui';

    protected $fillable = [
      "label"
    ];


    public function translations(){
        return $this->hasMany('App\Models\InterfaceUiTranslations', 'interface_ui_id','id');
    }

}
