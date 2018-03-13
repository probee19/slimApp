<?php
/**
 * Created by PhpStorm.
 * User: probee
 * Date: 29/08/2017
 * Time: 11:15
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model as Eloquent;

class StatPerResult extends Eloquent
{
    protected $table = 'stats_per_result';

    protected $fillable = [
      'id_resultat',
      'nb_tests',
      'partages_count',
      'reactions_count',
      'shares_count',
      'click_count',
      'comments_count'
    ];

}
