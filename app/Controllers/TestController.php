<?php
namespace App\Controllers;
use App\Helpers\RandomStringGenerator;
use App\Helpers\Helper;
use App\Models\Test;
use App\Models\User;
use App\Models\UserTest;
use App\Models\Language;
class TestController extends Controller
{

    public function index($request, $response, $args){

        $url = $this->helper->detectLang($request, $response);
        if($url != "") return $response->withStatus(302)->withHeader('Location', $url );

        $sandbox = new Helper();
        $lang = $this->helper->getLangSubdomain($request);
        $interface_ui = $this->helper->getUiLabels($lang);
        $baseDomain = "https://" . $lang . ".".$this->base_domain;
        $id = (int)$args['id'];
        $country_code = $sandbox->getCountryCode();

        if(isset($_GET['p']) && $_GET['p'] == 1)
          $no_ads = true;

        //$code = $request->getParam('ref');
        $code = "";
        if(isset($args['code']))
            $code = $args['code'];
        //$user_test = UserTest::where('uuid', '=', "$code")->first();
        //$img_url = $user_test->img_url;
        $img_url = "/uploads/$code.jpg";

        $tests_from_json = $this->helper->getAllTestJson($lang, true);
        $test  = $tests_from_json[$id];

        $permission = $test['permissions'];
        if((!$test || $test['statut'] != 1 ) && (!isset($_GET['access'])) ){
            $result_url = $this->router->pathFor('accueil' );
            $this->flash->addMessage('invalid_test', $interface_ui['label_notif_no_test']);
            return $response->withStatus(302)->withHeader('Location', $result_url );
        }

        if(isset($_GET['utm']) && $_GET['utm'] !='')
            $sandbox->setUTM($_GET['utm'], "test", $id);

        $exclude = [$id];
        if(!empty($_SESSION['uid'])){
            //$sandbox->getRelatedTest( $request,31, $_SESSION['uid'], 9, 2);
            $testUser = User::on('reader')->where('facebook_id', '=', $_SESSION['uid'])
                ->with('usertests')->first();
            if($testUser && count($testUser->usertests) > 0)
                foreach($testUser->usertests as $user){
                    $exclude [] = $user->test_id;
                }
        }

        $all_test = $sandbox->relatedTests($id, $country_code, $exclude, $lang);

        // For Facebook connect
        $helper = $this->fb->getRedirectLoginHelper();
        $pdata = $helper->getPersistentDataHandler();
        $state = [
          "id"          => $id,
          "permission"  => $permission
        ];

        $state = json_encode($state);
        $pdata->set('state', $state);

        if($permission == 1){
            $permissions = ['user_friends','user_posts','user_photos'];
            $loginUrl  = $helper->getReRequestUrl($baseDomain .'/connect_user2', $permissions);
            $loginUrl2 = $helper->getReRequestUrl($baseDomain .'/connect_user_test', $permissions);
        }else
        {
            $permissions = ['public_profile'];
            $loginUrl = $helper->getLoginUrl($baseDomain .'/connect_user2', $permissions);
        }// Optional permissions
        $id_user = 0;
        if(isset($_SESSION['uid']))
            $id_user = $_SESSION['uid'];

        if(isset($_GET['ab']))
          $ab_testing =$_GET['ab'];
        else
          $ab_testing = $this->helper->getAB();

        $all_lang = $this->helper->getActivatedLanguages();
        return $this->view->render($response, 'single.twig', compact('no_ads','ab_testing', 'lang', 'url','id_user','test', 'code', 'all_test', 'permission', 'loginUrl', 'loginUrl2' , 'img_url', 'interface_ui','lang','all_lang'));
        }
}
