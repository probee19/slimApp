<?php


namespace App\Controllers;

use App\Models\DailyStat;
use App\Models\Share;
use App\Models\UserTest;
use App\Models\Test;
use App\Models\BotTests;
use App\Models\Citation;
use App\Models\ShareCitation;

class ShareController extends Controller
{
    public function index($request, $response, $args){
        $code = $request->getParam('code');
        $btn_share = $args['btn'];
        $lang = $args['lang'];
        $date = date('Y-m-d');
        $is_code = UserTest::where('uuid', $code)->first();
        if(! $is_code)
            $is_code = BotTests::where('uuid', $code)->first();
        $test_id = $is_code->test_id;
        $share = 1;
        if($is_code) {
            try {
                $share = Share::on('reader')->where('result_code','=', "$code")->firstOrFail();
                if($share)
                Share::where('result_code','=', "$code")->increment('partages_count');
                //Test::where('id_test','=', $test_id)->increment('nb_partages');

            } catch (\Exception $e) {
                $share = Share::create([
                    'result_code'   => "$code",
                    'user_id'       => $is_code->user_id,
                    'test_id'       => $is_code->test_id,
                    'btn_share'     => "$btn_share",
                    'lang'          => "$lang",
                    'ab_testing'    =>  $this->helper->getAB(),
                ]);
            }
            /*
            try{
                $daily = DailyStat::on('reader')->where([
                        ['result_code', '=', "$code"],
                        ['created_at', 'LIKE', $date.'%']
                    ]
                )->firstOrFail();
                if($daily)
                    DailyStat::where([
                        ['result_code', '=', "$code"],
                        ['created_at', 'LIKE', $date.'%']
                    ])->increment('partages_count');
            }catch (\Exception $e){
                $daily = DailyStat::create([
                    'result_code'   => "$code",
                    'partages_count'  => 1
                ]);
            }
            */


        }
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($share));
    }


    public function shareQuote($request, $response, $args)
    {
      $id = $request->getParam('code');
      $btn_share = $args['btn'];
      $lang = $args['lang'];
      $date = date('Y-m-d');
      $is_quote = Citation::where('id_citation','=', $id)->first();

      $share = 1;
      if($is_quote) {
          $uid = 0;
          if(isset($_SESSION['uid'])) $uid = $_SESSION['uid'];
          $share = shareCitation::create([
              'user_id'       => $uid,
              'citation_id'   => $id,
              'btn_share'     => "$btn_share",
              'lang'          => "$lang",
              'ab_testing'    =>  $this->helper->getAB(),
          ]);
      }
      return $response->withStatus(200)
          ->withHeader('Content-Type', 'application/json')
          ->write(json_encode($share));
    }
}
