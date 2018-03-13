<?php
/**
 * Created by PhpStorm.
 * User: probee
 * Date: 29/08/2017
 * Time: 11:15
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model as Eloquent;

class DailyStatPerTest extends Eloquent
{
    protected $table = 'daily_stats_per_test';

    protected $fillable = [
      'id_test',
      'nb_tests', 
      'partages_count',
      'reactions_count',
      'shares_count',
      'click_count',
      'comments_count'
    ];

}
