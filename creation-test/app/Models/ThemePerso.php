<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ThemePerso extends Eloquent
{

    protected $table = 'themes_perso';

    protected $fillable = [
      'id_test',
      'code_php',
      'code_css',
      'code_js',
      'code_head',
      'code_bottom',
      'nb_friends_fb',
      'max_friends',
      'best_friends',
      'lang'
    ];
    
    public function test(){
        return $this->belongsTo('App\Models\Test', 'id_test', 'id_test');
    }
}
