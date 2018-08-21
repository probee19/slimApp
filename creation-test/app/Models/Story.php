<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Story extends Eloquent
{

    protected $table = 'stories';

    protected $fillable = [
        'id_rubrique',
        'titre_story',
        'code_story',
        'url_image_story',
        'statut',
        'codes_countries',
        'default_lang',
        'created_at',
        'updated_at',
    ];

}
