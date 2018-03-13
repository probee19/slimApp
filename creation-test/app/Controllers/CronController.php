<?php


namespace App\Controllers;

use App\Models\DailyStat;
use App\Models\WeeklyStat;
use App\Models\DailyStatPerTest;
use App\Models\DailyGlobalStats;
use App\Models\StatPerResult;
use App\Models\Share;
use App\Models\UserTest;
use App\Models\Resultat;
use App\Models\Test;
use App\Helpers\Helper;
use App\Controllers\LoadStatsController;

class CronController extends Controller
{
    public function index($request, $response, $args){
      echo "test";
    }

    public function updateDailyStat($request, $response, $args){
      $data = array(); $data_to_insert = array(); $dates = array(); $nb_update = 0; $actions = array();

      $shares = Share::where('cron_flag', 0)
                      ->with('testInfo')
                      ->take(20)
                      ->orderBy('id', 'DESC')
                      ->get();

      foreach ($shares as $share) {
          $stats_data_array = array(
            'result_code'   => $share->result_code,
            'titre_test'    => $share->testInfo->titre_test
          );

          $stats_from_fb = json_decode($this->get_stats_from_facebook($stats_data_array));

          $share_count_from_fb = $stats_from_fb->share_count_from_fb;
          $comment_count_from_fb = $stats_from_fb->comment_count_from_fb;
          $reaction_count_from_fb = $stats_from_fb->reaction_count_from_fb;

          $new_stats_from_fb = [
            "shares_count"    =>  $stats_from_fb->share_count_from_fb,
            "comments_count"  =>  $stats_from_fb->comment_count_from_fb,
            "reactions_count" =>  $stats_from_fb->reaction_count_from_fb
          ];

          $data[] = array(
              'result_code'             => $share->result_code,
              'id_test'                 => $share->test_id,
              'titre_test'              => $share->testInfo->titre_test,
              'share_count'             => $share->shares_count,
              'comment_count'           => $share->comments_count,
              'reaction_count'          => $share->reactions_count,
              'share_count_from_fb'     => $share_count_from_fb,
              'comment_count_from_fb'   => $comment_count_from_fb,
              'reaction_count_from_fb'  => $reaction_count_from_fb
            );
          if ($share->share_count < $share_count_from_fb ||  $share->comment_count < $comment_count_from_fb || $share->reaction_count < $reaction_count_from_fb) {
              try {
                $daily_stats = DailyStat::where('result_code', $share->result_code)->orderByRaw('id','DESC')->firstOrFail();
                if($daily_stats){
                  $date_share = new \DateTime($daily_stats->created_at);
                  $today = date("Y/m/d");

                  $new_share_count    = $share_count_from_fb - $share->share_count;
                  $new_comment_count  = $comment_count_from_fb - $share->comment_count;
                  $new_reaction_count = $reaction_count_from_fb - $share->reaction_count;

                  $new_stats_for_this_day = [
                    "shares_count"    =>  $new_share_count,
                    "comments_count"  =>  $new_comment_count,
                    "reactions_count" =>  $new_reaction_count
                  ];


                  if($date_share->format("Y/m/d") == $today){                   //Update daily stats
                    $actiions[] = "Update daily stats for ".$share->result_code;
                    DailyStat::where('result_code', $share->result_code)->update($new_stats_for_this_day);
                  }
                  else                                                          // Add stats
                      $data_to_insert[] = array(
                          "result_code"       => $share->result_code,
                          "clicks_count"      =>  0 ,
                          "reactions_count"   =>  $new_reaction_count ,
                          "comments_count"    =>  $new_comment_count ,
                          "shares_count"      =>  $new_share_count,
                          "lang"              =>  $share->lang,
                          "created_at"        =>  \date("Y-m-d H:i:s"), # \Datetime()
                          "updated_at"        =>  \date("Y-m-d H:i:s")
                        );
                }
              } catch (\Exception $e) {
                // Add stats
                  $data_to_insert[] = array(
                      "result_code"       => $share->result_code,
                      "clicks_count"      =>  0 ,
                      "reactions_count"   =>  $reaction_count_from_fb ,
                      "comments_count"    =>  $comment_count_from_fb ,
                      "shares_count"      =>  $share_count_from_fb,
                      "lang"              =>  $share->lang,
                      "created_at"        =>  \date("Y-m-d H:i:s"), # \Datetime()
                      "updated_at"        =>  \date("Y-m-d H:i:s")
                    );
              }
              // Update : set new stats for this share on Shares
              Share::where('result_code', $share->result_code)->update($new_stats_from_fb);
          }
          else {
            // No updates, No add
          }
          // Update : set cron_flag to 1 for this share on Shares
          Share::where('result_code', $share->result_code)->update(['cron_flag'=>1]);
      }

      // Insertion Request for new stats for this day
      DailyStat::insert($data_to_insert);


      // Update : set all cron_flag to 1 if no data
      if(count($shares) == 0)
        Share::where('cron_flag',1)->update(['cron_flag'=>0]);


        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($data));
    }


    public function updateDailyStatPerTest($request, $response, $args)
    {
        $tests = Test::where([['statut', 1],['cron_flag','=',0]])->orderBy('created_at','DESC')->with('usertests')->take(1)->get();

        foreach ($tests as $test) {
            $begin = new \DateTime($test->created_at);
            //$begin = new \DateTime('today');
            $today = new \DateTime('today');
            $this_date = date_create();


            $interval = new \DateInterval('P1D');
            $end = new \DateTime('tomorrow');
            $period = new \DatePeriod($begin, $interval, $end);
            $date_array = array();
            foreach ($period as $date) {
              $date_array[] = $date;
            }
            $number_of_day = 0;
            foreach(array_reverse($date_array) as $date) {
                $this_date = date_format($date, 'Y-m-d 00:00:00');
                $this_date_plus_one = date('Y-m-d H:i:s', strtotime($this_date . ' +1 day'));

                $test_user_test = UserTest::selectRaw('COUNT(*) AS nb_test')->where([ ['test_id','=',$test->id_test], ['created_at',">=", $this_date], ['created_at',"<=", $this_date_plus_one] ])->first();
                $share = Share::selectRaw('SUM(partages_count) AS partages_count')->where([['test_id','=',$test->id_test],['created_at',">=", $this_date], ['created_at',"<=", $this_date_plus_one]  ])->first();
                //Helper::debug($user_test->nb_test);
                $share_count_test = 0; $comment_count_test = 0; $reaction_count_test = 0; $click_count_test = 0;

                foreach ($test->usertests as $user_test) {
                  $daily_stats = DailyStat::selectRaw('SUM(shares_count) AS shares_count, SUM(comments_count) AS comments_count, SUM(reactions_count) AS reactions_count, SUM(clicks_count) AS clicks_count')->where([['result_code','=',$user_test->uuid], ['created_at',">=", $this_date], ['created_at',"<=", $this_date_plus_one] ])->first();
                  if($daily_stats){
                    $share_count_test += $daily_stats->shares_count;
                    $comment_count_test += $daily_stats->comments_count;
                    $reaction_count_test += $daily_stats->reactions_count;
                    $click_count_test += $daily_stats->clicks_count;
                  }
                }
                $data_stats_test = [
                  'id_test'         =>  $test->id_test,
                  'nb_tests'        =>  intval($test_user_test->nb_test),
                  'partages_count'  =>  intval($share->partages_count),
                  'click_count'     =>  intval($click_count_test),
                  'reactions_count' =>  intval($share_count_test),
                  'comments_count'  =>  intval($comment_count_test),
                  'shares_count'    =>  intval($share_count_test),
                  "created_at"      =>  \date("Y-m-d H:i:s"), # \Datetime()
                  "updated_at"      =>  \date("Y-m-d H:i:s")
                ];

                Helper::debug($data_stats_test);
                try{
                  $daily_stats_per_test = DailyStatPerTest::where([['id_test','=',$test->id_test], ['created_at',">=", $this_date], ['created_at',"<=", $this_date_plus_one]])->firstOrFail();
                  if($daily_stats_per_test)
                    DailyStatPerTest::where([['id','=',$daily_stats_per_test->id], ['id_test','=',$test->id_test]])->update($data_stats_test);
                } catch (\Exception $e) {
                    DailyStatPerTest::insert($data_stats_test);
                }
            }

            Test::where('id_test',$test->id_test)->update(['cron_flag'=>1]);
        }


        if(count($tests) == 0)
          Test::where('cron_flag',1)->update(['cron_flag'=>0]);

    }


    public function updateStatPerResult($request, $response, $args)
    {
      $results = Resultat::with('userstest')->orderBy('id_resultat','DESC')->take(2)->get();


      foreach ($results as $result) {
        $nb_partage_resultat = 0;  $nb_shares_resultat = 0;  $nb_click_resultat = 0; $nb_reactions_resultat = 0; $nb_comments_resultat = 0;
        $nb_showned = count($result->userstest);
        foreach ($result->userstest as $user_test) {
           $share = Share::where('result_code',$user_test->uuid)->get();
           $nb_partage_resultat += $share->partages_count;
           $nb_shares_resultat += $share->shares_count;
           $nb_click_resultat += $share->clicks_count;
           $nb_reactions_resultat += $share->reactions_count;
           $nb_comments_resultat += $share->comments_count;
        }

        $data_stats_result = [
          'id_result'       =>  $result->id_resultat,
          'nb_tests'        =>  intval($nb_showned),
          'partages_count'  =>  intval($nb_partage_resultat),
          'click_count'     =>  intval($nb_click_resultat),
          'reactions_count' =>  intval($nb_reactions_resultat),
          'comments_count'  =>  intval($nb_comments_resultat),
          'shares_count'    =>  intval($nb_shares_resultat)
        ];
        Helper::debug($data_stats_result);
        try{
          $stats_per_result = StatPerResult::where('id_result','=',$result->id_resultat)->firstOrFail();
          if($stats_per_result)
            StatPerResult::where('id_result','=',$result->id_resultat)->update($stats_per_result);
        } catch (\Exception $e) {
            StatPerResult::insert($data_stats_result);
        }
        Resultat::where('id_resultat',$result->id_resultat)->update(['cron_flag'=>1]);

      }

      if(count($results) == 0)
        Resultat::where('cron_flag',1)->update(['cron_flag'=>0]);

    }

    public function updateWeeklyStat($request, $response, $args)
    {

      Share::orderBy('test_id','DESC')->chunk(10, function($shares)
      {
        foreach ($shares as $share) {
          $result_code = $share->result_code;
          $today = new \DateTime();
          $actual_week = $today->format('W');

          $share_count = 0; 	$partages_count = 0; $comment_count = 0; $reaction_count = 0; $clicks_count = 0;

          $daily_stats = DailyStat::where('result_code',$result_code)->get();
          foreach ($daily_stats as $ds) {
            $date_share = new \DateTime($ds->created_at);
            if($date_share->format('W') == $actual_week){
              $partages_count += $ds->partages_count;
              $share_count += $ds->shares_count;
              $comment_count += $ds->comments_count;
              $reaction_count += $ds->reactions_count;
              $clicks_count += $ds->clicks_count;
            }
          }
          $data_stats_result = [
            'result_code'     =>  $result_code,
            'week'            =>  intval($actual_week),
            'partages_count'  =>  intval($nb_partage_resultat),
            'click_count'     =>  intval($nb_click_resultat),
            'reactions_count' =>  intval($nb_reactions_resultat),
            'comments_count'  =>  intval($nb_comments_resultat),
            'shares_count'    =>  intval($nb_shares_resultat),
            "created_at"      =>  \date("Y-m-d H:i:s"), # \Datetime()
            "updated_at"      =>  \date("Y-m-d H:i:s")
          ];

          try{
            $weekly_stats = WeeklyStat::where([['result_code','=',$result_code], ['week','=',$actual_week]])->orderBy('id','DESC')->firstOrFail();
            if($weekly_stats)
              WeeklyStat::where([['result_code','=',$result_code], ['week','=',$actual_week]])->update($data_stats_result);
          }
          catch(\Exception $e) {
              WeeklyStat::insert($data_stats_result);
          }

        }
      });


    }
    public function get_stats_from_facebook($args)
    {
      $id_url='?id='.urlencode('http://funizi.com/resultat/'.$args['result_code'].'?ref=fb');
        $facebook_data_array = array(
         'base_url'     => 'https://graph.facebook.com/v2.10/',
         'fields'       => "fields=og_object{id},engagement{reaction_count,share_count,comment_count}",
         'id'           => $id_url,
         'access_token' => 'access_token=348809548888116|2d51d516fa50ce2382b2e8214db499c3',
        );
      $rep = $this->get_facebook_data($facebook_data_array);
      $json = json_decode($rep);
      $share_count_from_fb = $json->engagement->share_count;
      $comment_count_from_fb = $json->engagement->comment_count;
      $reaction_count_from_fb = $json->engagement->reaction_count;


      $id_url='?id='.urlencode('http://funizi.com/result/'.Helper::cleanUrl($args['titre_test']).'/'.$args['result_code'].'?ref=fb');
      $facebook_data_array = array(
       'base_url'     => 'https://graph.facebook.com/v2.10/',
       'fields'       => "fields=og_object{id},engagement{reaction_count,share_count,comment_count}",
       'id'           => $id_url,
       'access_token' => 'access_token=348809548888116|2d51d516fa50ce2382b2e8214db499c3',
      );

      $rep = $this->get_facebook_data($facebook_data_array);
      $json = json_decode($rep);

      $share_count_from_fb += $json->engagement->share_count;
      $comment_count_from_fb += $json->engagement->comment_count;
      $reaction_count_from_fb += $json->engagement->reaction_count;

      $stats = array(
        'share_count_from_fb'     => $share_count_from_fb,
        'comment_count_from_fb'   => $comment_count_from_fb,
        'reaction_count_from_fb'  => $reaction_count_from_fb
      );
      return json_encode($stats);
    }

    public function get_facebook_data( $args ) {

      /* Concatenate the array values. */
      $url = $args['base_url'] . $args['id'].'&' . $args['fields'].'&' . $args['access_token'];
     // echo $url;
      /* Initiate request. Store the results in the $response varialbe */
      $ch = curl_init();
      curl_setopt( $ch, CURLOPT_URL, $url );
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec( $ch );
      curl_close( $ch );

      /* Return the values in the $response variable. */
      return $response;

    }

    public static function updateDailyGlobalStat()
    {
      //$begin = new \DateTime("2017-12-26");
      $begin = new \DateTime();
      $end = new \DateTime();
      $begin->sub(new \DateInterval('P1D'));
      $end->add(new \DateInterval('P1D'));
      $interval = new \DateInterval('P1D');

      $period = new \DatePeriod($begin, $interval, $end);
      $date_array = array();
      foreach ($period as $date) {
        $date_array[] = $date;
      }
      $number_of_day = 0;

      foreach(array_reverse($date_array) as $day) {
        $this_day = $day->format('Y-m-d');
        //Helper::debug($this_day);
        $data = LoadStatsController::loadGlobalStatForOneDay($this_day);
        $all_data [] = $data;
        $number_of_day++; $flag = true;
        try{
          $data_bd = DailyGlobalStats::whereDate('day','=',$this_day)->firstOrFail();
          $data['created_at'] = $data_bd->created_at;
          $data['updated_at'] = \date("Y-m-d H:i:s");
          $update  = DailyGlobalStats::whereDate('day','=',$this_day)->update($data);
        }
        catch(\Exception $e){
          $new_insert = DailyGlobalStats::insertGetId($data);
          $flag = false;
        }
      }

    }
}
