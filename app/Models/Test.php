<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Test extends Eloquent
{

    protected $table = 'tests';

    protected $fillable = [
        'id_test',
        'affichage_discover_count',
        'id_test_owner',
        'id_rubrique',
        'id_theme',
        'titre_test',
        'url_image_test',
        'statut',
        'permissions',
        'unique_result',
        'date_creation_test',
        'codes_countries',
        'tests_count',
        'shares_count',
        'test_description',
        'highlight',
        'default_lang',
        'if_translated'
    ];

    public function testInfoLang(){
        return $this->hasMany('App\Models\TestInfo', 'id_test', 'id_test');
    }
    public function resultat(){
        return $this->hasMany('App\Models\Resultat', 'id_test','id_test');
    }
    public function usertests(){
        return $this->hasMany('App\Models\UserTest', 'test_id', 'id_test');
    }

    public function themeInfo(){
        return $this->belongsTo('App\Models\Theme', 'id_theme', 'id');
    }


    public function defaultLangInfo(){
        return $this->belongsTo('App\Models\Language', 'default_lang', 'code');
    }


    public function testAdminInfo(){
        return $this->belongsTo('App\Models\Admin', 'id_test_owner', 'id_fb');
    }

    public function testOwnerInfo(){
        return $this->belongsTo('App\Models\User', 'id_test_owner', 'facebook_id');
    }

    public function themePersoInfo(){
        return $this->belongsTo('App\Models\ThemePerso', 'id_test', 'id_test');
    }

    public function shares(){
        return $this->hasMany('App\Models\Share', 'test_id', 'id_test');
    }

}
