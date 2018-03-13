<?php
/**
 * Created by PhpStorm.
 * User: probee
 * Date: 29/08/2017
 * Time: 11:15
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model as Eloquent;

class Rubrique extends Eloquent
{
    protected $table = 'rubriques';

    protected $fillable = [
      'titre_rubrique',
      'nb_test' 
    ];

    public function tests(){
       return $this->hasMany('App\Models\Test', 'id_rubrique', 'id_rubrique');
    }

}
