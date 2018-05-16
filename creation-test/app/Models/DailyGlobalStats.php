<?php
/**
 * Created by PhpStorm.
 * User: probee
 * Date: 29/08/2017
 * Time: 11:15
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model as Eloquent;

class DailyGlobalStats extends Eloquent
{
    protected $table = 'daily_global_stats';

    protected $fillable = [
      "day",
      "nb_tests_created",
      "nb_tests_done",
      "nb_test_unique_done",
      "nb_tests_done_from_messenger",
      "nb_test_unique_done_from_messenger",
      "partage_count",
      "partage_count_unique",
      "taux_partage",
      "taux_partage_unique",
      "nb_player",
      "nb_new_users",
      "taux_test_per_user",
      "share_count",
      "click_count",
      "comment_count",
      "reaction_count"
    ];

}
