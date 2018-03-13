<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Language extends Eloquent
{

    protected $table = 'lang';

    protected $fillable = [
      "code",
      "name",
      "status",
      "translated",
      "test_count"
    ];

}
