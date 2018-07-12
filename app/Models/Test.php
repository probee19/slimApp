<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Test extends Eloquent
{
    //protected $connection = 'writer';

    protected $table = 'tests';

    protected $fillable = [
        'id_test',
        'affichage_discover_count'
    ];

    public function resultat(){
        return $this->hasMany('App\Models\Resultat', 'id_test');
    }
    public function usertests(){
        return $this->hasMany('App\Models\UserTest', 'test_id', 'id_test');
    }

    public function themeInfo(){
        return $this->belongsTo('App\Models\Theme', 'id_theme', 'id');
    }

    public function testAdminInfo(){
        return $this->belongsTo('App\Models\Admin', 'id_test_owner', 'id_fb');
    }

    public function testOwnerInfo(){
        return $this->belongsTo('App\Models\User', 'id_test_owner', 'facebook_id');
    }

    public function themePersoInfo(){
        return $this->belongsTo('App\Models\Theme', 'id_test', 'id_test');
    }

    public function shares(){
        return $this->hasMany('App\Models\Share', 'test_id', 'id_test');
    }
}
