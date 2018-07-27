<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\DailyStat;
use App\Models\Resultat;
use App\Models\Share;
use App\Models\Language;
use App\Models\Test;
use App\Models\User;
use App\Models\UserTest;
use App\Models\BotTests;

class ResultController extends Controller
{
    public function index($request, $response, $args){

        $url = $this->helper->detectLang($request, $response);
        if($url != "") return $response->withStatus(302)->withHeader('Location', $url );

        $helper = new Helper();
        $lang = $this->helper->getLangSubdomain($request);

        if(isset($_GET['pays']) && !empty($_GET['pays'])){
            $country_code = strtoupper($_GET['pays']);
        }else{
	        $country_code = $helper->getCountryCode();
        }
    		if(isset($args['code'])){
    			$code = $args['code'];
    		}
    		if(isset($args['new'])){
    			$new = $args['new'];
    		}

        $is_result = true;
        $date = date('Y-m-d');
        $test = UserTest::on('reader')->where('uuid', "$code")->with('testInfo')->first();
        //$testInfo = Test::where('id_test', $test->testInfo->id_test)->first();
        $testInfo = Test::on('reader')->selectRaw('test_info.titre_test AS titre_test, test_info.test_description AS test_description, tests.unique_result AS unique_result, tests.id_theme AS id_theme, tests.id_rubrique AS id_rubrique, tests.id_test AS id_test')
          ->join('test_info','test_info.id_test','tests.id_test')
          ->Where([['tests.id_test', '=', $test->testInfo->id_test],['test_info.lang','=',$lang]])->first();
        if(isset($test))
            $result_description = $test->result_description;
        if(!isset($test)){
            $test = BotTests::on('reader')->where('uuid', "$code")->with('testInfo')->first();
            $result_description = "<strong>N’oublie pas de PARTAGER ça maintenant avec tes amis et tes proches !</strong>";
        }
        $img_url = $test->img_url;

        if(isset($_GET['utm']) && !empty($_GET['utm']))
            $helper->setUTM($_GET['utm'], "test", $test->testInfo->id_test);

        if(isset($_GET['ref']) && $_GET['ref'] === 'fb' && $test != null){
            $result_url = $this->router->pathFor('single', [
                'id'      =>  $test->test_id,
                'name'    =>  $this->helper->cleanUrl($test->testInfo->titre_test)
            ], ['ref' => $code] );
            $_SESSION['referal'] = $code;

            return $response->withStatus(302)->withHeader('Location', $result_url );

        }else{
            $titre_test = $testInfo->titre_test;
            $test_id = $test->test_id;
            $title_url = $this->helper->getUrlTest($titre_test, $test_id, $lang);
            $titre_url = $this->helper->cleanUrl($title_url);
            $url_redirect_share = "";
            //$url_to_share = "";
            //$url_to_share = urlencode("http://www.funizi.com/result/".$titre_url."/".$code."?ref=fb");
            $url_to_share = urlencode($request->getUri()->getBaseUrl()."/test/".$titre_url."/".$test_id."/ref/".$code."?utm_source=facebook&utm_medium=share&utm_campaign=funizi_".date('Y-m-d')."&utm_content=test_".$test_id);
            $url_to_share_msg = urlencode($request->getUri()->getBaseUrl()."/test/".$titre_url."/".$test_id."/ref/".$code."?utm_source=facebook&utm_medium=messenger&utm_campaign=funizi_messenger_share".date('Y-m-d')."&utm_content=test_".$test_id);
            $url_to_share_wtsp = urlencode($this->helper->bitly_shorten($request->getUri()->getBaseUrl()."/test/".$titre_url."/".$test_id."/ref/".$code."?utm_source=facebook&utm_medium=whatsapp&utm_campaign=funizi_whatsapp_share".date('Y-m-d')."&utm_content=test_".$test_id));

            //$this->helper->bitly_shorten($request->getUri()->getBaseUrl()."/test/".$titre_url."/".$test_id."/ref/".$code."?utm_source=facebook&utm_medium=whatsapp&utm_campaign=funizi_whatsapp_share".date('Y-m-d')."&utm_content=test_".$test_id);
            //$url_redirect_share = urlencode("http://www.funizi.com/result/".$titre_url."/".$code."/new");
            $url_redirect_share = urlencode($request->getUri()->getBaseUrl()."/result/".$titre_url."/".$code."/new");

            if(!$test){
                $is_result = false;
            }

            if(isset($_GET['ab']))
              $ab_testing =$_GET['ab'];
            else
              $ab_testing = $test->ab_testing;


            if($test->testInfo->codes_countries !=''){
                $exclude = [$test->test_id];
                if(!empty($_SESSION['uid'])){
                    //$sandbox->getRelatedTest( $request,31, $_SESSION['uid'], 9, 2);
                    $testUser = User::on('reader')->where('facebook_id', '=', $_SESSION['uid'])
                        ->with('usertests')->first();
                    foreach($testUser->usertests as $user){
                        $exclude [] = $user->test_id;
                    }
                }
                $top_tests = $this->helper->getLocalTests($country_code, $exclude, $lang, 3);
                foreach ($top_tests as $top_test) {
                  $exclude [] = $top_test["id_test"];
                }

                $all_test = $helper->relatedTests($test->test_id, $country_code, $exclude, $lang);
            }
            else{
                $exclude = [$test->test_id];
                if(!empty($_SESSION['uid'])){
                    //$sandbox->getRelatedTest( $request,31, $_SESSION['uid'], 9, 2);
                    $testUser = User::on('reader')->where('facebook_id', '=', $_SESSION['uid'])
                        ->with('usertests')->first();
                    if($testUser && count($testUser->usertests) > 0)
                      foreach($testUser->usertests as $user)
                          $exclude [] = $user->test_id;

                }
                $top_tests = $this->helper->getLocalTests($country_code, $exclude, $lang, 3);
                if(count($top_tests) > 0)
                foreach ($top_tests as $top_test) {
                  $exclude [] = $top_test["id_test"];
                }

                $all_test = $helper->relatedTests($test->test_id, $country_code, $exclude, $lang);
            }
            $testId = $test->test_id;
            $unique_result = $test->testInfo->unique_result;
            $id_rubrique = $test->testInfo->id_rubrique;
            $if_additionnal_info = $test->testInfo->if_additionnal_info;

            $interface_ui = $this->helper->getUiLabels($lang);
            $all_lang = $this->helper->getActivatedLanguages();
            return $this->view->render($response, 'result.twig', compact('lang', 'code', 'titre_test', 'is_result', 'all_test', 'titre_url', 'new', 'testId', 'unique_result', 'if_additionnal_info', 'id_rubrique', 'img_url', 'result_description', 'ab_testing', 'url_to_share','url_to_share_msg', 'url_to_share_wtsp', 'url_redirect_share', 'top_tests', 'interface_ui','lang','all_lang'));
        }
    }
}
