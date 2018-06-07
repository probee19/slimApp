<?php


namespace App\Controllers;


use App\Helpers\Helper;
use App\Models\DailyStat;
use App\Models\Resultat;
use App\Models\Share;
use App\Models\Test;
use App\Models\User;
use App\Models\UserTest;

class ResultController extends Controller
{
    public function index($request, $response, $args){
        $helper = new Helper();
        if($_GET['pays'] && $_GET['pays'] !=''){
            $country_code = strtoupper($_GET['pays']);
        }else{

            $country_code = $helper->getCountryCode();
        }
        $code = $args['code'];
        $new = $args['new'];
        $is_result = true;
        $date = date('Y-m-d');
        $test = UserTest::where('uuid', "$code")->with('testInfo')->first();
        $img_url = $test->img_url;
        $result_description = $test->result_description;
        //Helper::debug($test);
        //die();
        $testInfo = Test::where('id_test', $test->testInfo->id_test)->with('testAdminInfo')->with('testOwnerInfo')->first();


        if(!$testInfo->testAdminInfo && $testInfo->testOwnerInfo){
            $test_owner = [
                "facebook_id" => $testInfo->testOwnerInfo->facebook_id,
                "first_name" => $testInfo->testOwnerInfo->first_name,
                "last_name" => $testInfo->testOwnerInfo->last_name
            ];
        }
        if($_GET['ref'] && $_GET['ref'] === 'fb' && $test != null){
            $result_url = $this->router->pathFor('single', [
                'id'      =>  $test->test_id,
                'name'    =>  Helper::cleanUrl($test->testInfo->titre_test)
            ], ['ref' => $code] );
            $_SESSION['referal'] = $code;
            try {
                $share = Share::where('result_code','=', "$code")->firstOrFail();
                if($share){
                    Share::where('result_code', '=', "$code")->increment('clicks_count');
                    try{
                        $daily = DailyStat::where([
                                ['result_code', '=', "$code"],
                                ['created_at', 'LIKE', $date.'%']
                            ]
                        )->firstOrFail();
                        if($daily)
                            DailyStat::where([
                                ['result_code', '=', "$code"],
                                ['created_at', 'LIKE', $date.'%']
                            ])->increment('clicks_count');
                    }catch (\Exception $e){
                        $daily = DailyStat::create([
                            'result_code'   => "$code",
                            'clicks_count'  => 1
                        ]);
                    }
                }
            } catch (\Exception $e) {
                // var_dump $share
            }
            return $response->withStatus(302)->withHeader('Location', $result_url );

        }else{
            $titre_test = $test->testInfo->titre_test;
            $titre_url = Helper::cleanUrl($titre_test);
            $url_redirect_share = "";
            $url_to_share = "";
            $url_to_share = urlencode("http://www.funizi.com/result/".$titre_url."/".$code."?ref=fb");
            $url_redirect_share = urlencode("http://www.funizi.com/result/".$titre_url."/".$code."/new");

            if(!$test){
                $is_result = false; 
            }
            if($test->testInfo->codes_countries !=''){
                $exclude = [$test->test_id];
                if(!empty($_SESSION['uid'])){
                    //$sandbox->getRelatedTest( $request,31, $_SESSION['uid'], 9, 2);
                    $testUser = User::where('facebook_id', '=', $_SESSION['uid'])
                        ->with('usertests')->first();
                    foreach($testUser->usertests as $user){
                        $exclude [] = $user->test_id;
                    }
                }
                $all_test = $helper->relatedTests($country_code, $exclude);
                }else{
                $exclude = [$test->test_id];
                if(!empty($_SESSION['uid'])){
                    //$sandbox->getRelatedTest( $request,31, $_SESSION['uid'], 9, 2);
                    $testUser = User::where('facebook_id', '=', $_SESSION['uid'])
                        ->with('usertests')->first();
                    foreach($testUser->usertests as $user){
                        $exclude [] = $user->test_id;
                    }
                }
                $all_test = $helper->relatedTests($country_code, $exclude);
            }
            $testId = $test->test_id;
            $unique_result = $test->testInfo->unique_result;
            return $this->view->render($response, 'result.twig', compact('code', 'titre_test', 'is_result', 'all_test', 'titre_url', 'new', 'test_owner', 'testId', 'unique_result', 'img_url', 'result_description', 'url_to_share', 'url_redirect_share'));
        }
    }
}
