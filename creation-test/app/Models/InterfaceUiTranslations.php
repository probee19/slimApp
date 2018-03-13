<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class InterfaceUiTranslations extends Eloquent
{

    protected $table = 'interface_ui_translations';

    protected $fillable = [
      "interface_ui_id",
      "interface_ui_code",
      "interface_ui",
      "lang"
    ];

}
