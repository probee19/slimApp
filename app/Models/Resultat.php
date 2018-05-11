<?php
/**
 * Created by PhpStorm.
 * User: probee
 * Date: 29/08/2017
 * Time: 11:15
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model as Eloquent;

class Resultat extends Eloquent
{
    protected $table = 'resultats';

    protected $fillable = [
      'id_resultat',
      'id_test',
      'titre_resultat',
      'texte_resultat',
      'image_resultat',
      'genre'
    ];

    public function test(){
       return $this->belongsTo('App\Models\Test', 'id_test','id_test');
    }

    public function userstest(){
       return $this->hasMany('App\Models\UserTest', 'result_id','id_resultat');
    }


    public function stats(){
       return $this->hasOne('App\Models\StatPerResult', 'id_result', 'id_resultat');
    }
}
