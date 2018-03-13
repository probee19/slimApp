<?php


namespace App\Controllers;


use App\Helpers\Helper;
use App\Models\Test;
use App\Models\Resultat;
use App\Models\User;
use App\Models\Share;
use App\Models\DailyStat;
use App\Models\UserTest;

class TestController extends Controller
{

    public function index($request, $response, $args){
      //Helper::checkCookies();
      if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL){
        return $response->withStatus(302)->withHeader('Location', "http://www.creation.funizi.com" );
      }
        $test_id = $args['test'];
        $this_test = Test::where('id_test',$test_id)->first();

        $shares = Share::selectRaw('COUNT(DISTINCT test_id, result_code) AS partages_count_unique, SUM(partages_count) AS partages_count, SUM(shares_count) AS shares_count, SUM(clicks_count) AS clicks_count, SUM(comments_count) AS comments_count, SUM(reactions_count) AS reactions_count')
            ->where('test_id',$test_id)
            ->groupBy('test_id')
            ->first();
        if($shares)
          $data_test =[
            "partages_count"          =>  $shares->partages_count,
            "partages_count_unique"   =>  $shares->partages_count_unique,
            "shares_count"            =>  $shares->shares_count,
            "clicks_count"            =>  $shares->clicks_count,
            "comments_count"          =>  $shares->comments_count,
            "reactions_count"         =>  $shares->reactions_count,
            "nb_played"               =>  0,
            "taux_share"              =>  0
          ];
        else
          $data_test =[
            "partages_count"          =>  0,
            "partages_count_unique"   =>  0,
            "shares_count"            =>  0,
            "clicks_count"            =>  0,
            "comments_count"          =>  0,
            "reactions_count"         =>  0,
            "nb_played"               =>  0,
            "taux_share"              =>  0
          ];

        $tested = UserTest::selectRaw('COUNT(*) AS nb_played')
            ->where('test_id',$test_id)
            ->groupBy('test_id')
            ->first();
        if($tested){
          $data_test['nb_played'] = $tested->nb_played;
          $data_test['taux_share'] = round(($data_test['partages_count']/$tested->nb_played*100), 2);
        }

        return $this->view->render($response, 'oneTest.twig', compact('this_test', 'data_test'));
    }


    public static function get_lundi_dimanche_from_week($week,$year,$format="d/m/Y") {

        $firstDayInYear=date("N",mktime(0,0,0,1,1,$year));
        if ($firstDayInYear<5)
        $shift=-($firstDayInYear-1)*86400;
        else
        $shift=(8-$firstDayInYear)*86400;
        if ($week>1) $weekInSeconds=($week-1)*604800; else $weekInSeconds=0;
        $timestamp=mktime(0,0,0,1,1,$year)+$weekInSeconds+$shift;
        $timestamp_dimanche=mktime(0,0,0,1,7,$year)+$weekInSeconds+$shift;

        return array(date($format,$timestamp),date($format,$timestamp_dimanche));

    }
}
