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

    ];

    public function test(){
       return $this->belongsTo('App\Models\Test', 'id_test', 'id_resultat');
    }

}