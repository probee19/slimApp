<?php


namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\DailyStat;
use App\Models\Share;
use App\Models\UserTest;
use App\Models\Test;

class DailyStatsController extends Controller
{
    public function index($request, $response, $args){
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
                        "shares_count"      =>  $new_share_count
                      );
              }
            } catch (\Exception $e) {
              // Add stats
                $data_to_insert[] = array(
                    "result_code"       => $share->result_code,
                    "clicks_count"      =>  0 ,
                    "reactions_count"   =>  $reaction_count_from_fb ,
                    "comments_count"    =>  $comment_count_from_fb ,
                    "shares_count"      =>  $share_count_from_fb
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
      if(count($share) == 0)
        Share::where('cron_flag',1)->update(['cron_flag'=>0]);



        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($data));
    }

    public function DailyStatPerTest($request, $response, $args)
    {

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
}
