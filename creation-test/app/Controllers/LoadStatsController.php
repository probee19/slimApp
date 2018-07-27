<?php


namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Test;
use App\Models\TestInfo;
use App\Models\UserTest;
use App\Models\Countries;
use App\Models\Share;
use App\Models\DailyStat;
use App\Models\User;
use App\Models\Resultat;
use App\Models\StatPerResult;
use App\Models\DailyStatPerTest;
use App\Models\DailyGlobalStats;
use App\Models\BotTests;
use App\Models\Language;
use App\Controllers\CronController;
use App\Controllers\JsonController;

class LoadStatsController extends Controller
{
    public function index($request, $response, $args)
    {
        echo 'hello';
    }

    public function loadStatDetail($request, $response, $args)
    {
      $tab = $_GET['tab'];
      $test_id = $_GET['id'];
      $theme = $_GET['theme'];
      if($tab == 'global'){
        $resultats = Resultat::on('reader')->where('id_test',$test_id)->with('stats')->with('test')->get();
        $data_resultats = array();
        if($resultats)
          foreach ($resultats as $resultat) {
            if($resultat->stats)
              $data_resultats []= [
                "id_resultat"         =>  $resultat->id_resultat,
                "titre_test"          =>  $resultat->test->titre_test,
                "titre_resultat"      =>  $resultat->titre_resultat,
                "texte_resultat"      =>  $resultat->texte_resultat,
                "nb_tests"            =>  $resultat->stats->nb_tests,
                "partages_count"      =>  $resultat->stats->partages_count,
                "reactions_count"     =>  $resultat->stats->reactions_count,
                "shares_count"        =>  $resultat->stats->shares_count,
                "click_count"         =>  $resultat->stats->click_count,
                "comments_count"      =>  $resultat->stats->comments_count
              ];
            else
              $data_resultats []= [
                "id_resultat"         =>  $resultat->id_resultat,
                "titre_test"          =>  $resultat->test->titre_test,
                "titre_test"          =>  $resultat->test->titre_test,
                "titre_resultat"      =>  $resultat->titre_resultat,
                "texte_resultat"      =>  $resultat->texte_resultat,
                "nb_tests"            =>  0,
                "partages_count"      =>  0,
                "reactions_count"     =>  0,
                "shares_count"        =>  0,
                "click_count"         =>  0,
                "comments_count"      =>  0
              ];
          }
        return $this->view->render($response, 'ajaxviews/globalStatOneTest.twig', compact('theme','data_resultats'));
      }

      if($tab == 'daily'){
        $data_days = DailyStatPerTest::on('reader')->where('id_test',$test_id)->orderBy('created_at','DESC')->get();
        return $this->view->render($response, 'ajaxviews/dailyStatOneTest.twig', compact('theme','data_days'));
      }

      if($tab == 'weekly'){

      }

      if($tab == 'last_share'){
          $data = Share::on('reader')->where('test_id', $test_id)->with('userInfo')->with('testInfo')->with('userTestInfo')->orderBy('created_at','DESC')->take(20)->get();
          $data_share = array();
          foreach ($data as $share) {
            $resultat = Resultat::on('reader')->where('id_resultat','=',$share->userTestInfo->result_id)->first();
            $data_share[] = [
              "titre_resultat"    =>  $resultat->titre_resultat,
              "texte_resultat"    =>  $resultat->texte_resultat,
              "titre_test"        =>  $share->testInfo->titre_test,
              "user_id"           =>  $share->userInfo->id,
              "facebook_id"       =>  $share->userInfo->facebook_id,
              "first_name"        =>  $share->userInfo->first_name,
              "last_name"         =>  $share->userInfo->last_name,
              "created_at"        =>  $share->created_at
            ];
          }
          return $this->view->render($response, 'ajaxviews/lastShareOneTest.twig', compact('theme','data_share'));
      }



    }

    public function get_lundi_dimanche_from_week($week,$year,$format="d/m/Y") {

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

    public static function getGeoDataCharts($start,$end, $nb_tests_all, $nb_player_all , $lang = "")
    {
      // Data For Geo Chart
      $countries = UserTest::on('reader')->selectRaw('country_code, country_name, COUNT(DISTINCT users_tests.user_id) AS nb_player, COUNT(users_tests.id) AS nb_test_done , COUNT(DISTINCT users_tests.user_id, users_tests.test_id ) AS nb_test_unique_done')
                ->join('users', 'users.id', '=', 'users_tests.user_id')
                ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"],['country_code','!=',NULL],['country_code','!=','']])
                ->groupBy('country_code')
                ->orderBy('nb_test_done', 'DESC')
                ->get();

      $data_chart_tests 	= "['Country', 'Tests effectués']";
      $data_chart_shares 	= "['Country', 'Taux de partage']";
      $data_chart_users 	= "['Country', 'Utilisateurs']";
      foreach ($countries as $country) {

          $country_names = Helper::getNameContry($country->country_code);

          $country_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS nb_share, COUNT(DISTINCT user_id, test_id) AS nb_share_unique')
              ->join('users','users.id','=','shares.user_id')
              ->where([['shares.created_at',">=","$start"],['shares.created_at',"<=","$end"], ['shares.lang','LIKE',"%$lang%"],['country_code','=',"$country->country_code"]])
              ->first();

          $taux_share  = round(($country_shares->nb_share / $country->nb_test_done)*100, 2) ;
          $taux_share_unique  = round(($country_shares->nb_share_unique / $country->nb_test_unique_done)*100, 2) ;

          $data_chart_tests  .= ", ['".addslashes($country_names['en'])."', ".$country->nb_test_done."]";
          $data_chart_shares .= ", ['".addslashes($country_names['en'])."', ".$taux_share."]";
          $data_chart_users  .= ", ['".addslashes($country_names['en'])."', ".$country->nb_player."]";
          // For Tables
            $data_players_countries [] = [
              "country_name_fr" =>  $country_names['fr'],
              "country_name_en" =>  $country_names['en'],
              "nb_players"      =>  $country->nb_player,
              "taux_nb_players" =>  round(($country->nb_player/ $nb_player_all) * 100, 2)
            ];
            $best_tests_countries [] = [
                "country_code"    =>  $country->country_code,
                "country_name"    =>  $country_names['fr'],
                "nb_test_done"    =>  $country->nb_test_done,
                "taux_test"       =>  round(($country->nb_test_done/ $nb_tests_all) * 100, 2)
            ];
          if($country->nb_test_done >=10 && $country_shares->nb_share > 0)
            $best_shares_countries [] = [
                "country_code"            =>  $country->country_code,
                "country_name"            =>  $country_names['fr'],
                "nb_test_done"            =>  $country->nb_test_done,
                "nb_test_unique_done"     =>  $country->nb_test_unique_done,
                "nb_share"                =>  intval($country_shares->nb_share),
                "nb_share_unique"         =>  intval($country_shares->nb_share_unique),
                "taux_share"              =>  $taux_share,
                "taux_share_unique"       =>  $taux_share_unique
            ];
      }
      $data = [
        "data_chart_tests"        =>  $data_chart_tests,
        "data_chart_shares"       =>  $data_chart_shares,
        "data_chart_users"        =>  $data_chart_users,
        "best_tests"              =>  $best_tests_countries,
        "best_shares"             =>  $best_shares_countries,
        "data_players_countries"  =>  $data_players_countries

      ];
      // END Data For Geo Chart
        return $data;

    }

    public static function getLineChartData($start, $end, $lang = "")
    {
       CronController::updateDailyGlobalStat();
       $all_data = DailyGlobalStats::on('reader')->where([['day',">=","$start"],['day',"<=","$end"]])->orderBy('day','ASC')->get();
       $stats = array();
       foreach ($all_data as $data) {
         $day = date_create($data->day);
         $day = date_format($day, 'Y, m - 1, d');
          $stats[] = [
              "day"                                   =>    $day,
              "nb_tests_done"                         =>    $data->nb_tests_done ,
              "nb_tests_created"                      =>    $data->nb_tests_created ,
              "nb_test_unique_done"                   =>    $data->nb_test_unique_done ,
              "nb_tests_done_from_messenger"          =>    $data->nb_tests_done_from_messenger ,
              "nb_test_unique_done_from_messenger"    =>    $data->nb_test_unique_done_from_messenger ,
              "partage_count"                         =>    $data->partage_count ,
              "partage_count_unique"                  =>    $data->partage_count_unique ,
              "taux_partage"                          =>    $data->taux_partage ,
              "taux_partage_unique"                   =>    $data->taux_partage_unique,
              "nb_player"                             =>    $data->nb_player ,
              "nb_new_users"                          =>    $data->nb_new_users ,
              "taux_test_per_user"                    =>    $data->taux_test_per_user ,
              "share_count"                           =>    $data->share_count ,
              "click_count"                           =>    $data->click_count ,
              "comment_count"                         =>    $data->comment_count,
              "reaction_count"                        =>    $data->reaction_count
          ];
       }
       //Helper::debug($stats);
       return $stats;
    }

    public static function getLangPieChart($start,$end)
    {
      $ut = UserTest::on('reader')->selectRaw('COUNT(*) AS nb_test_done, COUNT(distinct user_id) AS nb_player, COUNT(DISTINCT user_id, test_id) AS nb_test_unique_done, lang AS lang')
          ->groupBy('lang')
          ->where([['created_at',">=","$start"],['created_at',"<=","$end"]])
          ->get();
      $data_pie = array();
      foreach ($ut as $ut_lang) {
        # code...
        $data_pie [] = [
          "lang"                  => $ut_lang->lang,
          "nb_test_done"          => $ut_lang->nb_test_done,
          "nb_player"             => $ut_lang->nb_player,
          "nb_test_unique_done"   => $ut_lang->nb_test_unique_done
        ];
      }
      return $data_pie;
    }

    public static function getGlobalStat($start, $end, $last_day_start, $last_day_end, $lang = "")
    {
      $s = date_create($start);
      $s = date_format($s, 'd/m/Y');
      $e = date_create($end);
      date_sub($e,date_interval_create_from_date_string("1 day"));
      $e = date_format($e, 'd/m/Y');

      // Nombre de tests crées
      $counts_tests_created = Test::on('reader')->where([['created_at',">=","$start"],['created_at',"<=","$end"],['statut','!=', -1] ])
                ->count();
      // Nombre de  tests effectués pour cette période
      $counts_wt = UserTest::on('reader')->selectRaw('COUNT(*) AS nb_test_done, COUNT(distinct user_id) AS nb_player, COUNT(DISTINCT user_id, test_id) AS nb_test_unique_done ')
                ->where([['created_at',">=","$start"],['created_at',"<=","$end"], ['lang','LIKE',"%$lang%"]])
                ->first();
      $taux_diff_test = 0;

      if($s == $e){
        $counts_wty = UserTest::on('reader')->selectRaw('COUNT(*) AS nb_test_done, COUNT(distinct user_id) AS nb_player, COUNT(DISTINCT user_id, test_id) AS nb_test_unique_done ')
                ->where([['created_at',">=","$last_day_start"],['created_at',"<=","$last_day_end"], ['lang','LIKE',"%$lang%"] ])
                ->first();

        if($counts_wt->nb_test_done > $counts_wty->nb_test_done)
          $taux_diff_test   = round((($counts_wt->nb_test_done - $counts_wty->nb_test_done) / $counts_wty->nb_test_done)*100, 2);
        else
          $taux_diff_test   = round((($counts_wt->nb_test_done - $counts_wty->nb_test_done) / $counts_wty->nb_test_done)*100, 2);

        if($counts_wt->nb_player > $counts_wty->nb_player)
          $taux_diff_player = round((($counts_wt->nb_player - $counts_wty->nb_player) / $counts_wty->nb_player)*100, 2);
        else
          $taux_diff_player = round((($counts_wt->nb_player - $counts_wty->nb_player) / $counts_wty->nb_player)*100, 2);
      }

      // Nombre de  tests effectués à travers le bot messenger
      $counts_bt = BotTests::on('reader')->selectRaw('COUNT(*) AS nb_test_done, COUNT(distinct messenger_user_id) AS nb_player, COUNT(DISTINCT messenger_user_id, test_id) AS nb_test_unique_done ')
                ->where([['created_at',">=","$start"],['created_at',"<=","$end"] ])
                ->first();

      // Nombre d'utilisateurs inscrits pour cette période
      $counts_new_users = User::on('reader')->where([['created_at',">=","$start"],['created_at',"<=","$end"] ])
                         ->count();

      // Nombre de partage directs pour cette période
      $counts_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS partages_count, COUNT(DISTINCT user_id, test_id) AS partages_count_unique')
                        ->where([['created_at',">=","$start"],['created_at',"<=","$end"], ['lang','LIKE',"%$lang%"] ])
                        ->first();

      // Nombre de partages, de commentaires, de réactions, de clics pour cette période
      //$counts_stats = DailyStat::on('reader')->selectRaw('SUM(shares_count) AS shares_count, SUM(comments_count) AS comments_count , SUM(reactions_count) AS reactions_count, SUM(clicks_count) AS clicks_count ')
                        //->where([['created_at',">=","$start"],['created_at',"<=","$end"] , ['lang','LIKE',"%$lang%"]])
                        //->first();

    	// Calcul des pourcentages pour cette période
    	$taux_sharing_all  			= ($counts_shares->partages_count  / $counts_wt->nb_test_done )*100;
    	$taux_sharing_unique_all  	= ($counts_shares->partages_count_unique  / $counts_wt->nb_test_unique_done )*100;
    	$taux_test_per_user_all  	= $counts_wt->nb_test_done  / $counts_wt->nb_player ;

      $data_global = [
        "start"                                     =>    $s,
        "end"                                       =>    $e,
        "nb_tests_created_all"                      =>    $counts_tests_created    ,
        "nb_tests_done_all"                         =>    $counts_wt->nb_test_done     ,
        "taux_diff_test"                            =>    $taux_diff_test    ,
        "taux_diff_player"                          =>    $taux_diff_player    ,
        "nb_tests_done_all_y"                       =>    $counts_wty->nb_test_done    ,
        "nb_test_unique_done_all"                   =>    $counts_wt->nb_test_unique_done    ,
        "nb_test_unique_done_all_y"                 =>    $counts_wty->nb_test_unique_done    ,
        "nb_tests_done_all_from_messenger"          =>    $counts_bt->nb_test_done    ,
        "nb_test_unique_done_all_from_messenger"    =>    $counts_bt->nb_test_unique_done    ,
        "share_count_all"                           =>    intval($counts_shares->partages_count)    ,
        "share_count_unique_all"                    =>    intval($counts_shares->partages_count_unique)    ,
        "taux_sharing_all"                          =>    round($taux_sharing_all, 2)    ,
        "taux_sharing_unique_all"                   =>    round($taux_sharing_unique_all, 2)   ,
        "nb_player_all"                             =>    $counts_wt->nb_player    ,
        "nb_new_users_all"                          =>    $counts_new_users    ,
        "taux_test_per_user_all"                    =>    round($taux_test_per_user_all, 2)    ,
        "share_count_2_all"                         =>    intval($counts_stats->shares_count )   ,
        "click_count_all"                           =>    0 /*$counts_stats->clicks_count*/    ,
        "comment_count_all"                         =>    0 /*$counts_stats->comments_count*/   ,
        "reaction_count_all"                        =>    0 /*$counts_stats->reactions_count*/
      ];
      return $data_global;
    }

    public static function getGlobalStatMini($start, $end, $last_day_start, $last_day_end, $lang, $list_tests = NULL)
    {
      $s = date_create($start);
      $s = date_format($s, 'd/m/Y');
      $e = date_create($end);
      date_sub($e,date_interval_create_from_date_string("1 day"));
      $e = date_format($e, 'd/m/Y');
      // Nombre de  tests effectués pour cette période
      $counts_wt = UserTest::on('reader')->selectRaw('COUNT(*) AS nb_test_done, COUNT(distinct user_id) AS nb_player, COUNT(DISTINCT user_id, test_id) AS nb_test_unique_done ')
            ->where([['created_at',">=","$start"],['created_at',"<=","$end"], ['lang','LIKE',"%$lang%"] ])
            ->first();

      $taux_diff_test = 0;
      if($s == $e){
        $counts_wty = UserTest::on('reader')->selectRaw('COUNT(*) AS nb_test_done, COUNT(distinct user_id) AS nb_player, COUNT(DISTINCT user_id, test_id) AS nb_test_unique_done ')
                ->where([['created_at',">=","$last_day_start"],['created_at',"<=","$last_day_end"], ['lang','LIKE',"%$lang%"] ])
                ->first();
        if($counts_wt->nb_test_done > $counts_wty->nb_test_done)
          $taux_diff_test   = round((($counts_wt->nb_test_done - $counts_wty->nb_test_done) / $counts_wty->nb_test_done)*100, 2);
        else
          $taux_diff_test   = round((($counts_wt->nb_test_done - $counts_wty->nb_test_done) / $counts_wty->nb_test_done)*100, 2);

        if($counts_wt->nb_player > $counts_wty->nb_player)
          $taux_diff_player = round((($counts_wt->nb_player - $counts_wty->nb_player) / $counts_wt->nb_player)*100, 2);
        else
          $taux_diff_player = round((($counts_wt->nb_player - $counts_wty->nb_player) / $counts_wty->nb_player)*100, 2);
      }

      // Nombre d'utilisateurs inscrits pour cette période
      $counts_new_users = User::on('reader')->where([['created_at',">=","$start"],['created_at',"<=","$end"] ])
             ->count();

       // Nombre de partage directs pour cette période
       $counts_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS partages_count, COUNT(DISTINCT user_id, test_id) AS partages_count_unique')
             ->where([['created_at',">=","$start"],['created_at',"<=","$end"], ['lang','LIKE',"%$lang%"] ])
             ->first();

        // Calcul des pourcentages pour cette période
        $taux_sharing_all  			= ($counts_shares->partages_count  / $counts_wt->nb_test_done )*100;
        $taux_sharing_unique_all  	= ($counts_shares->partages_count_unique  / $counts_wt->nb_test_unique_done )*100;
        $taux_test_per_user_all  	= $counts_wt->nb_test_done  / $counts_wt->nb_player ;

        $data_global = [
          "start"                                     =>    $s,
          "end"                                       =>    $e,
          "nb_tests_done_all"                         =>    $counts_wt->nb_test_done    ,
          "taux_diff_test"                            =>    $taux_diff_test    ,
          "taux_diff_player"                          =>    $taux_diff_player    ,
          "nb_test_unique_done_all"                   =>    $counts_wt->nb_test_unique_done    ,
          "share_count_all"                           =>    intval($counts_shares->partages_count)    ,
          "share_count_unique_all"                    =>    intval($counts_shares->partages_count_unique)    ,
          "taux_sharing_all"                          =>    round($taux_sharing_all, 2)    ,
          "taux_sharing_unique_all"                   =>    round($taux_sharing_unique_all, 2)   ,
          "nb_player_all"                             =>    $counts_wt->nb_player    ,
          "nb_new_users_all"                          =>    $counts_new_users    ,
          "taux_test_per_user_all"                    =>    round($taux_test_per_user_all, 2)
        ];
        return $data_global;
        // Data For Best Tests
    }

    public function loadstatforthisrange($request, $response, $args)
    {
      $lang = $_GET['lang'];
      $start = date_create($_GET['start']);
      $last_day_start = date_create($_GET['start']);
      date_sub($last_day_start,date_interval_create_from_date_string("1 day"));
      $last_day_start = date_format($last_day_start, 'Y-m-d');
      $last_day_end = date_create();
      $today = date_format($last_day_end, 'Y-m-d');
      date_sub($last_day_end,date_interval_create_from_date_string("1 day"));

      if(date_format($start, 'Y-m-d') == $today)
        $last_day_end = date_format($last_day_end, 'Y-m-d H:i:s');
      else
        $last_day_end = date_format($start, 'Y-m-d');

    	$start = date_format($start, 'Y-m-d');

    	$s = date_create($_GET['start']);
    	$s = date_format($s, 'd/m/Y');
    	$end = date_create($_GET['end']);

      // For Line Charts
      $start_line_chart = date_create($_GET['start']) ;
      $end_line_chart = date_create($_GET['end']) ;
      $end_line_chart = date_format($end_line_chart, 'Y-m-d');
      if($start == $end_line_chart)
           date_sub($start_line_chart,date_interval_create_from_date_string("7 day"));
      $start_line_chart = date_format($start_line_chart, 'Y-m-d');
      // End For Line Charts

    	date_add($end,date_interval_create_from_date_string("1 day"));
    	$end = date_format($end, 'Y-m-d');
    	$e = date_create($_GET['end']);
    	$e = date_format($e, 'd/m/Y');

      $data_best_tests = array(); $data_best_tests_countries = array(); $data_best_shares_countries = array(); $best_tests_countries= array();
      $best_shares_countries = array();
      $date_time = date("Y-m-d H:i:s");

      // Global Statistics
        $data_global = self::getGlobalStat($start, $end, $last_day_start, $last_day_end, $lang);
      // End  Global Statistics

      // Data For Line Chart
        $data_line_chart = self::getLineChartData($start_line_chart,$end_line_chart);
      // End Data For Line Chart

      $data_chart_all = self::getGeoDataCharts($start,$end, $data_global["nb_tests_done_all"], $data_global["nb_player_all"], $lang);
      $best_tests_countries   = $data_chart_all["best_tests"];
      $best_shares_countries  = $data_chart_all["best_shares"];

      // For Pie Or Doughnut
      $data_pie = self::getLangPieChart($start,$end);

      //Data For Geo Chart
      $data_chart = [
        "data_chart_tests"   =>  $data_chart_all["data_chart_tests"],
        "data_chart_shares"  =>  $data_chart_all["data_chart_shares"],
        "data_chart_users"   =>  $data_chart_all["data_chart_users"]
      ];
      // END Data For Geo Chart

      // Data Countries nbPlayers
        $data_players_countries =  $data_chart_all["data_players_countries"];
      // END Data Countries nbPlayers

      $best_shares_countries = Helper::array_msort($best_shares_countries, array('taux_share'=>SORT_DESC, 'country_name'=>SORT_ASC));
      $data_best_tests_countries = array_slice($best_tests_countries, 0, 10);
      $data_best_shares_countries = array_slice($best_shares_countries, 0, 10);

      // Data For Best Tests
      $best_tests_col = UserTest::on('reader')->selectRaw('test_id, COUNT(users_tests.id) AS nb_test_done, ROUND((COUNT(users_tests.id) / '.$data_global["nb_tests_done_all"].' * 100), 2) AS taux_test, COUNT(DISTINCT user_id) AS nb_test_unique_done, titre_test')
            ->join('tests','tests.id_test','=','users_tests.test_id')
            ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"] , ['users_tests.lang','LIKE',"%$lang%"]])
            ->groupBy('test_id')
            ->orderBy('nb_test_done','DESC')
            ->get();

      foreach ($best_tests_col as $data_bests) {
        $best_shares_col = Share::on('reader')->selectRaw('SUM(partages_count) AS nb_share, COUNT(DISTINCT user_id, test_id) AS nb_share_unique')
            ->where([['created_at',">=","$start"], ['created_at',"<=","$end"], ['lang','LIKE',"%$lang%"],  ['test_id','=',$data_bests->test_id]])
            ->groupBy('test_id')
            ->first();

        if($data_bests->nb_test_unique_done >=50 && $best_shares_col->nb_share > 0)
          $best_shares [] = [
            "test_id"               =>  $data_bests->test_id,
            "nb_test_done"          =>  $data_bests->nb_test_done,
            "nb_test_unique_done"   =>  $data_bests->nb_test_unique_done,
            "taux_test"             =>  $data_bests->taux_test,
            "titre_test"            =>  $data_bests->titre_test,
            "nb_share"              =>  intval($best_shares_col->nb_share),
            "nb_share_unique"       =>  intval($best_shares_col->nb_share_unique),
            "taux_share"            =>  round(($best_shares_col->nb_share/$data_bests->nb_test_done*100), 2),
            "taux_share_unique"     =>  round(($best_shares_col->nb_share_unique/$data_bests->nb_test_unique_done*100), 2)
          ];

        $best_tests [] = [
            "test_id"               =>  $data_bests->test_id,
            "nb_test_done"          =>  $data_bests->nb_test_done,
            "nb_test_unique_done"   =>  $data_bests->nb_test_unique_done,
            "taux_test"             =>  $data_bests->taux_test,
            "titre_test"            =>  $data_bests->titre_test
        ];
      }

      $best_shares = Helper::array_msort($best_shares, array('taux_share'=>SORT_DESC, 'nb_test_done'=>SORT_ASC));
      $data_best_tests = array_slice($best_tests, 0, 10);
      $data_best_shares = array_slice($best_shares, 0, 10);

      // END Data For Best Tests

      return $this->view->render($response, 'globalStats.twig', compact('data_global', 'date_time', 'data_chart', 'data_line_chart', 'data_best_tests', 'data_best_shares', 'data_best_tests_countries', 'data_best_shares_countries', 'data_players_countries', 'data_pie'));
    }

    public function loadTopTests($request, $response, $args)
    {
      $lang = $_GET['lang'];
      $start = date_create($_GET['start']);

      $last_day_start = date_create($_GET['start']);
      date_sub($last_day_start,date_interval_create_from_date_string("1 day"));
      $last_day_start = date_format($last_day_start, 'Y-m-d');
      $last_day_end = date_create();
      $today = date_format($last_day_end, 'Y-m-d');
      date_sub($last_day_end,date_interval_create_from_date_string("1 day"));

      if(date_format($start, 'Y-m-d') == $today)
        $last_day_end = date_format($last_day_end, 'Y-m-d H:i:s');
      else
        $last_day_end = date_format($start, 'Y-m-d');


      $start = date_format($start, 'Y-m-d H:i:s');
      $s = date_create($_GET['start']);
      $s = date_format($s, 'd/m/Y');
      $end = date_create($_GET['end']);
      date_add($end,date_interval_create_from_date_string("1 day"));
      $end = date_format($end, 'Y-m-d H:i:s');
      $e = date_create($_GET['end']);
      $e = date_format($e, 'd/m/Y');



        $data_global = self::getGlobalStatMini($start, $end, $last_day_start , $last_day_end, $lang);

        // Data For Best Tests
        $best_tests_col = UserTest::on('reader')->selectRaw('test_id, COUNT(users_tests.id) AS nb_test_done, ROUND((COUNT(users_tests.id) / '.$data_global["nb_tests_done_all"].' * 100), 2) AS taux_test, COUNT(DISTINCT user_id) AS nb_test_unique_done, titre_test')
              ->join('tests','tests.id_test','=','users_tests.test_id')
              ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"] ])
              ->groupBy('test_id')
              ->orderBy('nb_test_done','DESC')
              ->get();

        foreach ($best_tests_col as $data_bests) {
          $best_shares_col = Share::on('reader')->selectRaw('SUM(partages_count) AS nb_share, COUNT(DISTINCT user_id, test_id) AS nb_share_unique')
              ->where([['created_at',">=","$start"], ['created_at',"<=","$end"], ['lang','LIKE',"%$lang%"], ['test_id','=',$data_bests->test_id]])
              ->groupBy('test_id')
              ->first();

            $best_tests [] = [
              "test_id"               =>  $data_bests->test_id,
              "nb_test_done"          =>  $data_bests->nb_test_done,
              "nb_test_unique_done"   =>  $data_bests->nb_test_unique_done,
              "taux_test"             =>  $data_bests->taux_test,
              "titre_test"            =>  $data_bests->titre_test,
              "nb_share"              =>  intval($best_shares_col->nb_share),
              "nb_share_unique"       =>  intval($best_shares_col->nb_share_unique),
              "taux_share"            =>  round(($best_shares_col->nb_share/$data_bests->nb_test_done*100), 2),
              "taux_share_unique"     =>  round(($best_shares_col->nb_share_unique/$data_bests->nb_test_unique_done*100), 2)
            ];
        }

        $data_best_tests = Helper::array_msort($best_tests, array('nb_test_done'=>SORT_DESC, 'nb_test_unique_done'=>SORT_DESC));
        // END Data For Best Tests

        return $this->view->render($response, 'topTests.twig', compact('data_global', 'data_best_tests'));




    }

    public function loadBestTests($request, $response, $args)
    {
      $lang = $_GET['lang']; $btn_maj = 0;
      $start = date_create($_GET['start']);
      $end = date_create($_GET['end']);
      $interval = date_diff($start, $end);

      $last_day_start = date_create($_GET['start']);
      date_sub($last_day_start,date_interval_create_from_date_string("1 day"));
      $last_day_start = date_format($last_day_start, 'Y-m-d');
      $last_day_end = date_create();
      $today = date_format($last_day_end, 'Y-m-d');
      date_sub($last_day_end,date_interval_create_from_date_string("1 day"));

      if(date_format($start, 'Y-m-d') == $today)
        $last_day_end = date_format($last_day_end, 'Y-m-d H:i:s');
      else
        $last_day_end = date_format($start, 'Y-m-d');


      $start = date_format($start, 'Y-m-d H:i:s');
      $s = date_create($_GET['start']);
      $s = date_format($s, 'd/m/Y');

      date_add($end,date_interval_create_from_date_string("1 day"));
      $end = date_format($end, 'Y-m-d H:i:s');
      $e = date_create($_GET['end']);
      $e = date_format($e, 'd/m/Y');


      $date_dif = (int)$interval->format('%R%a days');

      $data_global = self::getGlobalStatMini($start, $end, $last_day_start , $last_day_end, $lang);

      // Data For Best Tests
      $best_tests_col = UserTest::on('reader')->selectRaw('test_id, tests.codes_countries AS codes_countries, tests.url_image_test AS url_image_test, tests.unique_result AS unique_result, tests.statut AS statut, tests.id_theme AS id_theme, tests.id_rubrique AS id_rubrique, COUNT(users_tests.id) AS nb_test_done, ROUND((COUNT(users_tests.id) / '.$data_global["nb_tests_done_all"].' * 100), 2) AS taux_test, COUNT(DISTINCT user_id) AS nb_test_unique_done, titre_test')
            ->join('tests','tests.id_test','=','users_tests.test_id')
            ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"] ])
            ->groupBy('test_id')
            ->orderBy('nb_test_done','DESC')
            ->get();

      foreach ($best_tests_col as $data_bests) {
        $best_shares_col = Share::on('reader')->selectRaw('SUM(partages_count) AS nb_share, COUNT(DISTINCT user_id, test_id) AS nb_share_unique')
            ->where([['created_at',">=","$start"], ['created_at',"<=","$end"], ['lang','LIKE',"%$lang%"], ['test_id','=',$data_bests->test_id]])
            ->groupBy('test_id')
            ->first();

        if(round(($best_shares_col->nb_share/$data_bests->nb_test_done*100), 2) >= 25 && $data_bests->nb_test_unique_done > 50){
            $best_tests [] = [
              "test_id"               =>  $data_bests->test_id,
              "id_theme"              =>  $data_bests->id_theme,
              "id_rubrique"           =>  $data_bests->id_rubrique,
              "statut"                =>  $data_bests->statut,
              "unique_result"         =>  $data_bests->unique_result,
              "url_image_test"        =>  $data_bests->url_image_test,
              "codes_countries"       =>  $data_bests->codes_countries,
              "nb_test_done"          =>  $data_bests->nb_test_done,
              "nb_test_unique_done"   =>  $data_bests->nb_test_unique_done,
              "taux_test"             =>  $data_bests->taux_test,
              "titre_test"            =>  $data_bests->titre_test,
              "nb_share"              =>  intval($best_shares_col->nb_share),
              "nb_share_unique"       =>  intval($best_shares_col->nb_share_unique),
              "taux_share"            =>  round(($best_shares_col->nb_share/$data_bests->nb_test_done*100), 2),
              "taux_share_unique"     =>  round(($best_shares_col->nb_share_unique/$data_bests->nb_test_unique_done*100), 2)
            ];
            $data_json [] = [
              "test_id"    =>  $data_bests->test_id
            ];
        }
      }
      $data_best_tests = Helper::array_msort($best_tests, array('taux_share'=>SORT_DESC, 'nb_test_done'=>SORT_DESC));
      // END Data For Best Tests

      // Setting Json file
      //if($date_dif == 6){
        //JsonController::setLovedTestJSON($start, $end);
      //}
      $btn_maj = 1;

      return $this->view->render($response, 'topTests.twig', compact('data_global', 'data_best_tests', 'btn_maj'));
    }

    public function loadStatsForSomeTests($request, $response, $args)
    {
      $lang = $_GET['lang'];
      $start = date_create($_GET['start']);

      $last_day_start = date_create($_GET['start']);
      date_sub($last_day_start,date_interval_create_from_date_string("1 day"));
      $last_day_start = date_format($last_day_start, 'Y-m-d');
      $last_day_end = date_create();
      $today = date_format($last_day_end, 'Y-m-d');
      date_sub($last_day_end,date_interval_create_from_date_string("1 day"));

      if(date_format($start, 'Y-m-d') == $today)
        $last_day_end = date_format($last_day_end, 'Y-m-d H:i:s');
      else
        $last_day_end = date_format($start, 'Y-m-d');


      $start = date_format($start, 'Y-m-d H:i:s');
      $s = date_create($_GET['start']);
      $s = date_format($s, 'd/m/Y');
      $end = date_create($_GET['end']);
      date_add($end,date_interval_create_from_date_string("1 day"));
      $end = date_format($end, 'Y-m-d H:i:s');
      $e = date_create($_GET['end']);
      $e = date_format($e, 'd/m/Y');
      $list_tests = array(281,280,278,274,271,263,262,261,256,254,252,251,245,243,250,253,240);


        $data_global = self::getGlobalStatMini($start, $end, $last_day_start , $last_day_end, $lang, $list_tests);

        // Data For Best Tests
        $best_tests_col = UserTest::on('reader')->selectRaw('test_id, COUNT(users_tests.id) AS nb_test_done, ROUND((COUNT(users_tests.id) / '.$data_global["nb_tests_done_all"].' * 100), 2) AS taux_test, COUNT(DISTINCT user_id) AS nb_test_unique_done, titre_test')
              ->join('tests','tests.id_test','=','users_tests.test_id')
              ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"] ])
              ->whereIn('test_id',$list_tests)
              ->groupBy('test_id')
              ->orderBy('nb_test_done','DESC')
              ->get();

        foreach ($best_tests_col as $data_bests) {
          $best_shares_col = Share::on('reader')->selectRaw('SUM(partages_count) AS nb_share, COUNT(DISTINCT user_id, test_id) AS nb_share_unique')
              ->where([['created_at',">=","$start"], ['created_at',"<=","$end"], ['lang','LIKE',"%$lang%"], ['test_id','=',$data_bests->test_id]])
              ->whereIn('test_id',$list_tests)
              ->groupBy('test_id')
              ->first();

            $best_tests [] = [
              "test_id"               =>  $data_bests->test_id,
              "nb_test_done"          =>  $data_bests->nb_test_done,
              "nb_test_unique_done"   =>  $data_bests->nb_test_unique_done,
              "taux_test"             =>  $data_bests->taux_test,
              "titre_test"            =>  $data_bests->titre_test,
              "nb_share"              =>  intval($best_shares_col->nb_share),
              "nb_share_unique"       =>  intval($best_shares_col->nb_share_unique),
              "taux_share"            =>  round(($best_shares_col->nb_share/$data_bests->nb_test_done*100), 2),
              "taux_share_unique"     =>  round(($best_shares_col->nb_share_unique/$data_bests->nb_test_unique_done*100), 2)
            ];
        }

        $data_best_tests = Helper::array_msort($best_tests, array('nb_test_done'=>SORT_DESC, 'nb_test_unique_done'=>SORT_DESC));
        // END Data For Best Tests

        return $this->view->render($response, 'topTests.twig', compact('data_global', 'data_best_tests'));




    }

    public function loadTopContries($request, $response, $args)
    {
      $lang = $_GET['lang'];
      $start = date_create($_GET['start']);

      $last_day_start = date_create($_GET['start']);
      date_sub($last_day_start,date_interval_create_from_date_string("1 day"));
      $last_day_start = date_format($last_day_start, 'Y-m-d');
      $last_day_end = date_create();
      $today = date_format($last_day_end, 'Y-m-d');
      date_sub($last_day_end,date_interval_create_from_date_string("1 day"));

      if(date_format($start, 'Y-m-d') == $today)
        $last_day_end = date_format($last_day_end, 'Y-m-d H:i:s');
      else
        $last_day_end = date_format($start, 'Y-m-d');

  		$start = date_format($start, 'Y-m-d H:i:s');
  		$s = date_create($_GET['start']);
  		$s = date_format($s, 'd/m/Y');
  		$end = date_create($_GET['end']);
  		date_add($end,date_interval_create_from_date_string("1 day"));
  		$end = date_format($end, 'Y-m-d H:i:s');
  		$e = date_create($_GET['end']);
  		$e = date_format($e, 'd/m/Y');
      $best_countries = array();


      $data_global = self::getGlobalStatMini($start, $end, $last_day_start , $last_day_end, $lang);


        $data_chart_tests 	= "['Country', 'Tests effectués']";
        $data_chart_shares 	= "['Country', 'Taux de partage']";
        $data_chart_users 	= "['Country', 'Utilisateurs']";

        // Best Countries
        $countries = UserTest::on('reader')->selectRaw('country_code, country_name, COUNT(DISTINCT users_tests.user_id) AS nb_player,  COUNT(users_tests.id) AS nb_test_done , COUNT(DISTINCT users_tests.user_id, users_tests.test_id ) AS nb_test_unique_done')
                  ->join('users', 'users.id', '=', 'users_tests.user_id')
                  ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"],['country_code','!=',NULL],['country_code','!=','']])
                  ->groupBy('country_code')
                  ->orderBy('nb_test_done', 'DESC')
                  ->get();

        foreach ($countries as $country) {

            $country_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS nb_share, COUNT(DISTINCT user_id, test_id) AS nb_share_unique')
                ->join('users','users.id','=','shares.user_id')
                ->where([['shares.created_at',">=","$start"],['shares.created_at',"<=","$end"], ['shares.lang','LIKE',"%$lang%"],['country_code','=',"$country->country_code"]])
                ->first();
            $taux_share  = round((intval($country_shares->nb_share) / $country->nb_test_done)*100, 2) ;
            $taux_share_unique  = round((intval($country_shares->nb_share_unique) / $country->nb_test_unique_done)*100, 2) ;

            $country_names = Helper::getNameContry($country->country_code);

            // For chart
            $data_chart_tests  .= ", ['".addslashes($country_names['en'])."', ".$country->nb_test_done."]";
            $data_chart_shares .= ", ['".addslashes($country_names['en'])."', ".$taux_share."]";
            $data_chart_users  .= ", ['".addslashes($country_names['en'])."', ".$country->nb_player."]";

            //if($country->nb_test_done >=10 && $country_shares->nb_share > 0)
            // For Tables
              $best_countries [] = [
                  "country_code"          =>"$country->country_code",
                  "country_name"          =>$country_names['fr'],
                  "nb_test_done"          =>$country->nb_test_done,
                  "nb_test_unique_done"   =>$country->nb_test_unique_done,
                  "nb_share"              =>intval($country_shares->nb_share),
                  "nb_share_unique"       =>intval($country_shares->nb_share_unique),
                  "taux_share"            =>$taux_share,
                  "taux_share_unique"     =>$taux_share_unique,
                  "taux_test"             =>round(($country->nb_test_done/ $data_global["nb_tests_done_all"]) * 100, 2)
              ];

        }

        $data_chart = [
          "data_chart_tests"   =>  $data_chart_tests,
          "data_chart_shares"  =>  $data_chart_shares,
          "data_chart_users"   =>  $data_chart_users
        ];

        $best_countries = Helper::array_msort($best_countries, array('nb_test_done'=>SORT_DESC, 'nb_test_unique_done'=>SORT_DESC));

        // END Best Countries

        return $this->view->render($response, 'topCountries.twig', compact('data_global', 'best_countries', 'data_chart'));

    }

    public function loadTopUsers($request, $response, $args)
    {
      $lang = $_GET['lang'];
      $start = date_create($_GET['start']);

      $last_day_start = date_create($_GET['start']);
      date_sub($last_day_start,date_interval_create_from_date_string("0 day"));
      $last_day_start = date_format($last_day_start, 'Y-m-d');
      $last_day_end = date_create();
      $today = date_format($last_day_end, 'Y-m-d');
      date_sub($last_day_end,date_interval_create_from_date_string("0 day"));

      if(date_format($start, 'Y-m-d') == $today)
        $last_day_end = date_format($last_day_end, 'Y-m-d H:i:s');
      else
        $last_day_end = date_format($start, 'Y-m-d');


  		$start = date_format($start, 'Y-m-d H:i:s');
  		$s = date_create($_GET['start']);
  		$s = date_format($s, 'd/m/Y');
  		$end = date_create($_GET['end']);
  		date_add($end,date_interval_create_from_date_string("1 day"));
  		$end = date_format($end, 'Y-m-d H:i:s');
  		$e = date_create($_GET['end']);
  		$e = date_format($e, 'd/m/Y');
      $best_users = array();

      $data_global = self::getGlobalStatMini($start, $end, $last_day_start , $last_day_end, $lang);
        $users = UserTest::on('reader')->selectRaw('users.facebook_id, users.id AS user_id, users.first_name AS first_name, users.last_name AS last_name, COUNT(users_tests.id) AS nb_test_done, COUNT(DISTINCT users_tests.user_id, users_tests.test_id) AS nb_test_unique_done')
                  ->join('users', 'users.id', '=', 'users_tests.user_id')
                  ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"]])
                  ->groupBy('user_id')
                  ->orderBy('nb_test_done', 'DESC')
                  ->get();
        $nbnb = 0;
        foreach ($users as $user) {

            $user_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS nb_share, COUNT(DISTINCT user_id, test_id) AS nb_share_unique')
                ->where([['shares.created_at',">=","$start"],['shares.created_at',"<=","$end"], ['shares.lang','LIKE',"%$lang%"],['user_id','=',$user->user_id]])
                ->first();
            $taux_share  = round((intval($user_shares->nb_share) / $user->nb_test_done)*100, 2) ;
            $taux_share_unique  = round((intval($user_shares->nb_share_unique) / $user->nb_test_unique_done)*100, 2) ;
            // For Tables
            //if($country->nb_test_done >=10 && $country_shares->nb_share > 0)
              $best_users [] = [
                  "user_id"                 =>  $user->user_id,
                  "facebook_id"             =>  $user->facebook_id,
                  "user_name"               =>  "$user->first_name " . " $user->last_name",
                  "first_name"              =>  "$user->first_name",
                  "last_name"               =>  "$user->last_name",
                  "nb_test_done"            =>  $user->nb_test_done,
                  "nb_test_unique_done"     =>  $user->nb_test_unique_done,
                  "nb_share"                =>  intval($user_shares->nb_share),
                  "nb_share_unique"         =>  intval($user_shares->nb_share_unique),
                  "taux_share"              =>  $taux_share,
                  "taux_share_unique"       =>  $taux_share_unique,
                  "taux_test"               =>  round(($user->nb_test_done/ $data_global["nb_tests_done_all"]) * 100, 2)
              ];
            //  if($nbnb++ == 100) break;
        }
        $best_users = Helper::array_msort($best_users, array('nb_test_done'=>SORT_DESC, 'nb_test_unique_done'=>SORT_DESC));

        //Helper::debug($best_users);
        //exit;

      return $this->view->render($response, 'topUsers.twig', compact('data_global', 'best_users'));

    }

    public function loadTestForUser($request, $response, $args)
    {
      $lang = $_GET['lang'];
      $start = date_create($_GET['start']);
    	$start = date_format($start, 'Y-m-d H:i:s');
    	$s = date_create($_GET['start']);
    	$s = date_format($s, 'd/m/Y');
    	$end = date_create($_GET['end']);
    	date_add($end,date_interval_create_from_date_string("1 day"));
    	$end = date_format($end, 'Y-m-d H:i:s');
    	$e = date_create($_GET['end']);
    	$e = date_format($e, 'd/m/Y');
    	$user_id = $_GET['user'];
    	$user_name = $_GET['userName'];
    	$facebook_id = $_GET['fb_id'];
      $tests_users = array();
      // Nombre de  tests effectués pour cette période
      $counts_wt = UserTest::on('reader')->selectRaw('COUNT(*) AS nb_test_done, COUNT(DISTINCT user_id, test_id) AS nb_test_unique_done ')
            ->where([['created_at',">=","$start"],['created_at',"<=","$end"], ['lang','LIKE',"%$lang%"],['user_id','=',$user_id]])
            ->first();

       // Nombre de partage directs pour cette période
       $counts_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS partages_count, COUNT(DISTINCT user_id, test_id) AS partages_count_unique')
             ->where([['created_at',">=","$start"],['created_at',"<=","$end"], ['lang','LIKE',"%$lang%"],['user_id','=',$user_id]])
             ->first();

        $data_global = [
          "start"                      =>    $s,
          "end"                        =>    $e,
          "user_name"                  =>    $user_name,
          "user_id"                    =>    $user_id,
          "facebook_id"                =>    $facebook_id,
          "nb_tests_done_all"          =>    $counts_wt->nb_test_done    ,
          "nb_test_unique_done_all"    =>    $counts_wt->nb_test_unique_done    ,
          "share_count_all"            =>    intval($counts_shares->partages_count)    ,
          "share_count_unique_all"     =>    intval($counts_shares->partages_count_unique)    ,
          "taux_sharing_all"           =>    round((intval($counts_shares->partages_count)  / $counts_wt->nb_test_done )*100, 2)    ,
          "taux_sharing_unique_all"    =>    round((intval($counts_shares->partages_count_unique)  / $counts_wt->nb_test_unique_done )*100, 2)   ,
          "taux_test_per_user_all"     =>    round($counts_wt->nb_test_done  / $counts_wt->nb_player, 2)
        ];

        $users_tests = UserTest::on('reader')->selectRaw('titre_test, test_id, COUNT(users_tests.id) AS nb_test_done, COUNT(DISTINCT users_tests.user_id) AS nb_test_unique_done')
            ->join('tests','id_test','=','test_id')
            ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"],['users_tests.user_id','=',$user_id]])
            ->groupBy('test_id')
            ->orderBy('nb_test_done')
            ->get();

        foreach ($users_tests as $test) {
          $user_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS nb_share, COUNT(DISTINCT user_id, test_id) AS nb_share_unique')
              ->where([['shares.created_at',">=","$start"],['shares.created_at',"<=","$end"], ['shares.lang','LIKE',"%$lang%"],['user_id','=',$user_id],['test_id','=',$test->test_id]])
              ->first();

          $tests_users [] = [
              "test_id"                 =>  $test->test_id,
              "titre_test"              =>  $test->titre_test,
              "nb_test_done"            =>  $test->nb_test_done,
              "nb_test_unique_done"     =>  $test->nb_test_unique_done,
              "nb_share"                =>  intval($user_shares->nb_share),
              "nb_share_unique"         =>  intval($user_shares->nb_share_unique),
              "taux_share"              =>  round((intval($user_shares->nb_share)  / $test->nb_test_done )*100, 2),
              "taux_share_unique"       =>  round((intval($user_shares->nb_share_unique)  / $test->nb_test_unique_done )*100, 2)
          ];
        }
        $tests_users = Helper::array_msort($tests_users, array('nb_test_done'=>SORT_DESC, 'nb_test_unique_done'=>SORT_DESC));

        return $this->view->render($response, 'userStats.twig', compact('data_global','tests_users'));

    }

    public function loadStatForThisTestForCountries($request, $response, $args)
    {
      $lang = $_POST['lang'];
    	$start = date_create($_POST['start']);
    	$start = date_format($start, 'Y-m-d H:i:s');
    	$s = date_create($_POST['start']);
    	$s = date_format($s, 'd/m/Y');
    	$end = date_create($_POST['end']);
    	date_add($end,date_interval_create_from_date_string("1 day"));
    	$end = date_format($end, 'Y-m-d H:i:s');
    	$e = date_create($_POST['end']);
    	$e = date_format($e, 'd/m/Y');

    	$countries = json_decode($_POST['countries']);
    	$test = $_POST['test'];
    	$test_name = $_POST['name'];
    	$countries_filter = array();
    	$test_filter_for_test = '';
    	$test_filter_for_share = '';
    	$nb_countries = 0;
    	$label_countries = '';
    	$label_test = '';

      $best_tests = array();  $data_best_tests = array();
      $best_countries = array();  $data_best_countries = array();
      $data_best_users = array();

      foreach ($countries as $key => $country) {
        if($nb_countries == 0)
          $label_countries .= '('.$country;
        else
          $label_countries .= ', '.$country;

        $countries_filter[] = $key;
        $nb_countries++;
      }
      //Helper::debug($countries);

      if($nb_countries != 0)
        $label_countries .= ')';


      if($test != '' && $test != 0){
        $test_filter_for_test = ", ['test_id', '=' ".$test."]";
        //$test_filter_for_test = ' AND ut.test_id = '.$test;
        $test_filter_for_share = ' AND s.test_id = '.$test;
        $label_test .= $test_name.' : ';
      }


      if (($test != '' && $test != 0) && $nb_countries == 0 ) {
        // Nombre de  tests effectués pour cette période
        $counts_wt = UserTest::on('reader')->selectRaw('COUNT(*) AS nb_test_done, COUNT(distinct user_id) AS nb_player, COUNT(DISTINCT user_id, test_id) AS nb_test_unique_done ')
              ->where([['created_at',">=","$start"],['created_at',"<=","$end"], ['lang','LIKE',"%$lang%"],['test_id','=', $test] ] )
              ->first();

        // Nombre d'utilisateurs inscrits pour cette période
        $counts_new_users = User::on('reader')->where([['users.created_at',">=","$start"],['users.created_at',"<=","$end"],['test_id','=', $test]])
              ->join('users_tests','users_tests.user_id','=','users.id')
              ->count();

        // Nombre de partage directs pour cette période
        $counts_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS partages_count, COUNT(DISTINCT user_id, test_id) AS partages_count_unique')
              ->where([['created_at',">=","$start"],['created_at',"<=","$end"], ['lang','LIKE',"%$lang%"],['test_id','=', $test]])
              ->first();
      }
      elseif($nb_countries != 0 && ($test == '' || $test == 0) ){
        // Nombre de  tests effectués pour cette période
        $counts_wt = UserTest::on('reader')->selectRaw('COUNT(*) AS nb_test_done, COUNT(distinct user_id) AS nb_player, COUNT(DISTINCT user_id, test_id) AS nb_test_unique_done ')
              ->join('users','users.id','=','user_id')
              ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"] ] )
              ->whereIn('country_code',$countries_filter)
              ->first();
        // Nombre d'utilisateurs inscrits pour cette période
        $counts_new_users = User::on('reader')->where([['created_at',">=","$start"],['created_at',"<=","$end"]])
              ->whereIn('country_code',$countries_filter)
              ->count();
        // Nombre de partage directs pour cette période
        $counts_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS partages_count, COUNT(DISTINCT user_id, test_id) AS partages_count_unique')
              ->join('users','users.id','=','user_id')
              ->where([['shares.created_at',">=","$start"],['shares.created_at',"<=","$end"], ['shares.lang','LIKE',"%$lang%"] ])
              ->whereIn('country_code',$countries_filter)
              ->first();
      }
      elseif($nb_countries != 0 && ($test != '' && $test != 0) ) {
        // Nombre de  tests effectués pour cette période
        $counts_wt = UserTest::on('reader')->selectRaw('COUNT(users_tests.id) AS nb_test_done, COUNT(distinct user_id) AS nb_player, COUNT(DISTINCT user_id, test_id) AS nb_test_unique_done ')
              ->join('users','users.id','=','user_id')
              ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"],['users_tests.test_id','=', $test] ] )
              ->whereIn('country_code',$countries_filter)
              ->first();
        // Nombre d'utilisateurs inscrits pour cette période
        $counts_new_users = User::on('reader')->where([['users.created_at',">=","$start"],['users.created_at',"<=","$end"],['test_id','=', $test]])
              ->join('users_tests','users_tests.user_id','=','users.id')
              ->whereIn('country_code',$countries_filter)
              ->count();
        // Nombre de partage directs pour cette période
        $counts_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS partages_count, COUNT(DISTINCT user_id, test_id) AS partages_count_unique')
              ->join('users','users.id','=','user_id')
              ->where([['shares.created_at',">=","$start"],['shares.created_at',"<=","$end"], ['shares.lang','LIKE',"%$lang%"],['test_id','=', $test]])
              ->whereIn('country_code',$countries_filter)
              ->first();
      }

      $data_global = [
        "start"                        =>    $s,
        "end"                          =>    $e,
        "test_id"                      =>    $test,
        "titre_test"                   =>    $test_name,
        "label_test"                   =>    $label_test,
        "label_countries"              =>    $label_countries,
        "nb_tests_done_all"            =>    intval($counts_wt->nb_test_done)    ,
        "nb_test_unique_done_all"      =>    intval($counts_wt->nb_test_unique_done)   ,
        "share_count_all"              =>    intval($counts_shares->partages_count)   ,
        "share_count_unique_all"       =>    intval($counts_shares->partages_count_unique)    ,
        "taux_sharing_all"             =>    round((intval($counts_shares->partages_count)  / $counts_wt->nb_test_done )*100, 2)    ,
        "taux_sharing_unique_all"      =>    round((intval($counts_shares->partages_count_unique)  / $counts_wt->nb_test_unique_done )*100, 2)   ,
        "nb_player_all"                =>    $counts_wt->nb_player    ,
        "nb_new_users_all"             =>    $counts_new_users    ,
        "taux_test_per_user_all"       =>    round($counts_wt->nb_test_done  / $counts_wt->nb_player, 2)
      ];

      if($test == '' || $test == 0){
        // Data For Best Tests
        $best_tests_col = UserTest::on('reader')->selectRaw('test_id, COUNT(users_tests.id) AS nb_test_done, ROUND((COUNT(users_tests.id) / '.intval($counts_wt->nb_test_done).' * 100), 2) AS taux_test, COUNT(DISTINCT user_id) AS nb_test_unique_done, titre_test')
              ->join('tests','tests.id_test','=','users_tests.test_id')
              ->join('users','users.id','=','users_tests.user_id')
              ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"] ])
              ->whereIn('country_code',$countries_filter)
              ->groupBy('test_id')
              ->orderBy('nb_test_done','DESC')
              ->get();

        foreach ($best_tests_col as $data_bests) {
          $best_shares_col = Share::on('reader')->selectRaw('SUM(partages_count) AS nb_share, COUNT(DISTINCT user_id, test_id) AS nb_share_unique')
              ->join('users','users.id','=','shares.user_id')
              ->where([['shares.created_at',">=","$start"], ['shares.created_at',"<=","$end"], ['shares.lang','LIKE',"%$lang%"], ['test_id','=',$data_bests->test_id]])
              ->whereIn('country_code',$countries_filter)
              ->groupBy('test_id')
              ->first();

            $best_tests [] = [
              "test_id"               =>  $data_bests->test_id,
              "nb_test_done"          =>  $data_bests->nb_test_done,
              "nb_test_unique_done"   =>  $data_bests->nb_test_unique_done,
              "taux_test"             =>  $data_bests->taux_test,
              "titre_test"            =>  $data_bests->titre_test,
              "nb_share"              =>  intval($best_shares_col->nb_share),
              "nb_share_unique"       =>  intval($best_shares_col->nb_share_unique),
              "taux_share"            =>  round((intval($best_shares_col->nb_share)/$data_bests->nb_test_done*100), 2),
              "taux_share_unique"     =>  round((intval($best_shares_col->nb_share_unique)/$data_bests->nb_test_unique_done*100), 2)
            ];
        }

        $data_best_tests = Helper::array_msort($best_tests, array('nb_test_done'=>SORT_DESC, 'nb_test_unique_done'=>SORT_DESC));
        // END Data For Best Tests
      }

      if($nb_countries > 1 || $test != '' || $test != 0 ){
        // Best Countries
        if (($test != '' && $test != 0) && $nb_countries == 0 ){
          $countries = UserTest::on('reader')->selectRaw('country_code,  COUNT(users_tests.id) AS nb_test_done , COUNT(DISTINCT users_tests.user_id, users_tests.test_id ) AS nb_test_unique_done')
                  ->join('users', 'users.id', '=', 'users_tests.user_id')
                  ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"],['users_tests.test_id','=', $test]])
                  ->groupBy('country_code')
                  ->orderBy('nb_test_done', 'DESC')
                  ->get();
        }
        elseif($nb_countries != 0 && ($test == '' || $test == 0)){
          $countries = UserTest::on('reader')->selectRaw('country_code,  COUNT(users_tests.id) AS nb_test_done , COUNT(DISTINCT users_tests.user_id, users_tests.test_id ) AS nb_test_unique_done')
                  ->join('users', 'users.id', '=', 'users_tests.user_id')
                  ->where([['users_tests.created_at',">=","$start"], ['users_tests.lang','LIKE',"%$lang%"],['users_tests.created_at',"<=","$end"]])
                  ->whereIn('country_code',$countries_filter)
                  ->groupBy('country_code')
                  ->orderBy('nb_test_done', 'DESC')
                  ->get();
        }
        elseif($nb_countries != 0 && ($test != '' && $test != 0) ) {
          $countries = UserTest::on('reader')->selectRaw('country_code,  COUNT(users_tests.id) AS nb_test_done , COUNT(DISTINCT users_tests.user_id, users_tests.test_id ) AS nb_test_unique_done')
                  ->join('users', 'users.id', '=', 'users_tests.user_id')
                  ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"],['users_tests.test_id','=', $test]])
                  ->whereIn('country_code',$countries_filter)
                  ->groupBy('country_code')
                  ->orderBy('nb_test_done', 'DESC')
                  ->get();
        }

        foreach ($countries as $country) {
            $country_name = Countries::on('reader')->selectRaw('langFR AS country_name_fr')
                ->where('alpha2','=',$country->country_code)
                ->first();
            if($test == '')
              $country_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS nb_share, COUNT(DISTINCT user_id, test_id) AS nb_share_unique')
                  ->join('users','users.id','=','shares.user_id')
                  ->where([['shares.created_at',">=","$start"],['shares.created_at',"<=","$end"], ['shares.lang','LIKE',"%$lang%"],['country_code','=',"$country->country_code"]])
                  ->first();
            else
              $country_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS nb_share, COUNT(DISTINCT user_id, test_id) AS nb_share_unique')
                  ->join('users','users.id','=','shares.user_id')
                  ->where([['shares.created_at',">=","$start"],['shares.created_at',"<=","$end"], ['shares.lang','LIKE',"%$lang%"],['test_id','=', $test],['country_code','=',"$country->country_code"]])
                  ->first();

            // For Tables
              $best_countries [] = [
                  "country_code"            =>  "$country->country_code",
                  "country_name"            =>  "$country_name->country_name_fr",
                  "nb_test_done"            =>  $country->nb_test_done,
                  "nb_test_unique_done"     =>  $country->nb_test_unique_done,
                  "nb_share"                =>  intval($country_shares->nb_share),
                  "nb_share_unique"         =>  intval($country_shares->nb_share_unique),
                  "taux_share"              =>  round((intval($country_shares->nb_share) / $country->nb_test_done)*100, 2),
                  "taux_share_unique"       =>  round((intval($country_shares->nb_share_unique) / $country->nb_test_unique_done)*100, 2),
                  "taux_test"               =>  round(($country->nb_test_done/ $counts_wt->nb_test_done) * 100, 2)
              ];

        }
        $data_best_countries = Helper::array_msort($best_countries, array('nb_test_done'=>SORT_DESC, 'nb_test_unique_done'=>SORT_DESC));

        // END Best Countries
      }

      // Top Users
      if (($test != '' && $test != 0) && $nb_countries == 0 ){
        $users = UserTest::on('reader')->selectRaw('facebook_id, users.id AS user_id, first_name AS first_name, last_name AS last_name, COUNT(users_tests.id) AS nb_test_done, COUNT(DISTINCT users_tests.user_id, users_tests.test_id) AS nb_test_unique_done')
                ->join('users', 'users.id', '=', 'users_tests.user_id')
                ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"],['users_tests.test_id','=', $test] ])
                ->groupBy('user_id')
                ->orderBy('nb_test_done', 'DESC')
                ->get();
      }
      elseif($nb_countries != 0 && ($test == '' && $test == 0)){
        $users = UserTest::on('reader')->selectRaw('facebook_id, users.id AS user_id, first_name AS first_name, last_name AS last_name, COUNT(users_tests.id) AS nb_test_done, COUNT(DISTINCT users_tests.user_id, users_tests.test_id) AS nb_test_unique_done')
                ->join('users', 'users.id', '=', 'users_tests.user_id')
                ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"]])
                ->whereIn('country_code',$countries_filter)
                ->groupBy('user_id')
                ->orderBy('nb_test_done', 'DESC')
                ->get();
      }
      elseif($nb_countries != 0 && ($test != '' && $test != 0) ) {
        $users = UserTest::on('reader')->selectRaw('facebook_id, users.id AS user_id, first_name AS first_name, last_name AS last_name, COUNT(users_tests.id) AS nb_test_done, COUNT(DISTINCT users_tests.user_id, users_tests.test_id) AS nb_test_unique_done')
                ->join('users', 'users.id', '=', 'users_tests.user_id')
                ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"], ['users_tests.lang','LIKE',"%$lang%"],['users_tests.test_id','=', $test] ])
                ->whereIn('country_code',$countries_filter)
                ->groupBy('user_id')
                ->orderBy('nb_test_done', 'DESC')
                ->get();
      }

      foreach ($users as $user) {
        if($test == '')
          $user_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS nb_share, COUNT(DISTINCT user_id, test_id) AS nb_share_unique')
              ->where([['shares.created_at',">=","$start"],['shares.created_at',"<=","$end"], ['shares.lang','LIKE',"%$lang%"],['user_id','=',$user->user_id]])
              ->first();
        else
        $user_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS nb_share, COUNT(DISTINCT user_id, test_id) AS nb_share_unique')
            ->where([['created_at',">=","$start"],['created_at',"<=","$end"], ['lang','LIKE',"%$lang%"],['user_id','=',$user->user_id],['test_id','=', $test]])
            ->first();

          $taux_share  = round((intval($user_shares->nb_share) / $user->nb_test_done)*100, 2) ;
          $taux_share_unique  = round((intval($user_shares->nb_share_unique) / $user->nb_test_unique_done)*100, 2) ;
          // For Tables

          //if($country->nb_test_done >=10 && $country_shares->nb_share > 0)
            $data_best_users [] = [
                "user_id"                 =>  $user->user_id,
                "facebook_id"             =>  $user->facebook_id,
                "user_name"               =>  "$user->first_name " . " $user->last_name",
                "first_name"              =>  "$user->first_name",
                "last_name"               =>  "$user->last_name",
                "nb_test_done"            =>  $user->nb_test_done,
                "nb_test_unique_done"     =>  $user->nb_test_unique_done,
                "nb_share"                =>  intval($user_shares->nb_share),
                "nb_share_unique"         =>  intval($user_shares->nb_share_unique),
                "taux_share"              =>  $taux_share,
                "taux_share_unique"       =>  $taux_share_unique,
                "taux_test"               =>  round(($user->nb_test_done/ $counts_wt->nb_test_done) * 100, 2)
            ];

      }
      $data_best_users = Helper::array_msort($data_best_users, array('nb_test_done'=>SORT_DESC, 'nb_test_unique_done'=>SORT_DESC));
      // End Top Users

      return $this->view->render($response, 'testAndCountriesStats.twig', compact('data_global', 'data_best_tests', 'data_best_countries', 'data_best_users'));
    }

    public function loadStatForDays($request, $response, $args)
    {
       $all_data = DailyGlobalStats::on('reader')->orderBy('day','DESC')->get();
       return $this->view->render($response, 'allDays.twig', compact('all_data'));
       //return $this->view->render($response, 'chunk.twig', compact('all_data'));

    }

    public static function loadGlobalStatForOneDay($day)
    {
      # code...
        $start = date_create($day);
      	$start = date_format($start, 'Y-m-d');

      	$s = date_create($day);
      	$s = date_format($s, 'd/m/Y');

      	$end = date_create($day);
      	date_add($end,date_interval_create_from_date_string("1 day"));
      	$end = date_format($end, 'Y-m-d');


        // Nombre de tests crées
        $counts_tests_created = Test::on('reader')->where([['created_at',">=","$start"],['created_at',"<=","$end"],['statut','!=', -1] ])
                  ->count();

        // Nombre de  tests effectués pour cette période
        $counts_wt = UserTest::on('reader')->selectRaw('COUNT(*) AS nb_test_done, COUNT(distinct user_id) AS nb_player, COUNT(DISTINCT user_id, test_id) AS nb_test_unique_done ')
                  ->where([['created_at',">=","$start"],['created_at',"<=","$end"] ])
                  ->first();

        // Nombre de  tests effectués à travers le bot messenger
        $counts_bt = BotTests::on('reader')->selectRaw('COUNT(*) AS nb_test_done, COUNT(distinct messenger_user_id) AS nb_player, COUNT(DISTINCT messenger_user_id, test_id) AS nb_test_unique_done ')
                  ->where([['created_at',">=","$start"],['created_at',"<=","$end"] ])
                  ->first();

        // Nombre d'utilisateurs inscrits pour cette période
        $counts_new_users = User::on('reader')->where([['created_at',">=","$start"],['created_at',"<=","$end"] ])
                           ->count();

        // Nombre de partage directs pour cette période
        $counts_shares = Share::on('reader')->selectRaw('SUM(partages_count) AS partages_count, COUNT(DISTINCT user_id, test_id) AS partages_count_unique')
                          ->where([['created_at',">=","$start"],['created_at',"<=","$end"] ])
                          ->first();

        // Nombre de partages, de commentaires, de réactions, de clics pour cette période
        //$counts_stats = DailyStat::on('reader')->selectRaw('SUM(shares_count) AS shares_count, SUM(comments_count) AS comments_count , SUM(reactions_count) AS reactions_count, SUM(clicks_count) AS clicks_count ')
                          //->where([['created_at',">=","$start"],['created_at',"<=","$end"] ])
                          //->first();


      	// Calcul des pourcentages pour cette période
      	$taux_sharing_all  			= ($counts_shares->partages_count  / $counts_wt->nb_test_done )*100;
      	$taux_sharing_unique_all  	= ($counts_shares->partages_count_unique  / $counts_wt->nb_test_unique_done )*100;
      	$taux_test_per_user_all  	= $counts_wt->nb_test_done  / $counts_wt->nb_player ;


        $data_global = [
          "day"                                   =>    $start,
          "nb_tests_created"                      =>    $counts_tests_created    ,
          "nb_tests_done"                         =>    $counts_wt->nb_test_done    ,
          "nb_test_unique_done"                   =>    $counts_wt->nb_test_unique_done    ,
          "nb_tests_done_from_messenger"          =>    $counts_bt->nb_test_done    ,
          "nb_test_unique_done_from_messenger"    =>    $counts_bt->nb_test_unique_done    ,
          "partage_count"                         =>    intval($counts_shares->partages_count)    ,
          "partage_count_unique"                  =>    intval($counts_shares->partages_count_unique)    ,
          "taux_partage"                          =>    round($taux_sharing_all, 2)    ,
          "taux_partage_unique"                   =>    round($taux_sharing_unique_all, 2)   ,
          "nb_player"                             =>    $counts_wt->nb_player    ,
          "nb_new_users"                          =>    $counts_new_users    ,
          "taux_test_per_user"                    =>    round($taux_test_per_user_all, 2)    ,
          "share_count"                           =>    intval($counts_stats->shares_count )   ,
          "click_count"                           =>    0    ,
          "comment_count"                         =>    0   ,
          "reaction_count"                        =>    0,
          //"click_count"                           =>    $counts_stats->clicks_count    ,
          //"comment_count"                         =>    $counts_stats->comments_count   ,
          //"reaction_count"                        =>    $counts_stats->reactions_count,
          "created_at"                            =>    \date("Y-m-d H:i:s"), # \Datetime()
          "updated_at"                            =>    \date("Y-m-d H:i:s")  # \Datetime()
        ];

        return $data_global;
    }


    public function loadABTestingStat($request, $response, $args)
    {


      if(isset($args['start'])) $start = $args['start'];
      if(isset($args['end'])) $end = $args['end'];

      $start = date_create($args['start']);
      $start = date_format($start, 'Y-m-d H:i:s');

      $s = date_create($args['start']);
      $s = date_format($s, 'd/m/Y');

      $end = date_create($end);
      date_add($end,date_interval_create_from_date_string("1 day"));
      $end = date_format($end, 'Y-m-d H:i:s');

      $e = date_create($args['end']);
      $e = date_format($e, 'd/m/Y');

      $nb_tests = UserTest::selectRaw('COUNT(*) AS nb, COUNT(DISTINCT user_id) AS nb_users, ab_testing')->where([['ab_testing','!=',NULL],['created_at',">=","$start"],['created_at',"<=","$end"]])->groupBy('ab_testing')->get();
      $nb_shares = Share::selectRaw('SUM(partages_count) AS nb, ab_testing')->where([['ab_testing','!=',NULL],['created_at',">=","$start"],['created_at',"<=","$end"]])->groupBy('ab_testing')->get();

      $data = [];
      foreach ($nb_tests as $test)
        $data[$test->ab_testing] = [
          "tests_count"     => $test->nb,
          "users_count"     => $test->nb_users,
          "ab_testing"      => $test->ab_testing,
          "taux"            => round($test->nb / $test->nb_users , 2),
        ];

      foreach ($nb_shares as $share){
        $data[$share->ab_testing]["shares_count"]= $share->nb;
        $data[$share->ab_testing]["taux_partage"]= round(($share->nb / $data[$share->ab_testing]["tests_count"])*100, 2);
      }

      $all_data = [
        "data_count"        => $data,
        "start"             => $s,
        "end"               => $e
      ];

      //Helper::debug($all_data);
      return $this->view->render($response, 'abTestingResults.twig', compact('all_data'));
    }
}
