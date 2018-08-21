<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class PlayBuzz extends Eloquent
{

    protected $table = 'playbuzz';

    protected $fillable = [
        'id_rubrique',
        'titre_playbuzz',
        'code_playbuzz',
        'url_image_playbuzz',
        'statut',
        'codes_countries',
        'default_lang',
        'created_at',
        'updated_at',
    ];

}
