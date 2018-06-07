<?php


namespace App\Controllers;

use App\Models\DailyStat;
use App\Models\Share;
use App\Models\UserTest;
use App\Models\Test;
use App\Helpers\Helper;

class DailyStatsController extends Controller
{
    public function index($request, $response, $args){
      $share = Share::where('cron_flag', 0)->with('testInfo')->get();

        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($share));
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
