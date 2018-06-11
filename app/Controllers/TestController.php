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

        $code = $request->getParam('ref');
        if($args['code'])
            $code = $args['code'];
        $user_test = UserTest::where('uuid', '=', "$code")->first();
        $img_url = $user_test->img_url;
        $test = Test::selectRaw('tests.statut AS statut, tests.id_rubrique AS id_rubrique, tests.titre_test AS titre_test_fr, tests.if_additionnal_info AS if_additionnal_info, tests.permissions AS permissions, tests.id_test AS id_test, tests.url_image_test AS url_image_test, test_info.lang AS lang, test_info.titre_test AS titre_test')
            ->join('test_info','test_info.id_test','tests.id_test')
            ->where([['tests.id_test', '=', $id],['test_info.lang','=',$lang]])->first();
        //->with('themeInfo')
        $permission = $test->permissions;
        if((!$test || $test->statut != 1 ) && (!isset($_GET['admin'])) ){
            $result_url = $this->router->pathFor('accueil' );
            $this->flash->addMessage('invalid_test', $interface_ui['label_notif_no_test']);
            return $response->withStatus(302)->withHeader('Location', $result_url );
        }

        if($_GET['utm'] && $_GET['utm'] !='')
            $sandbox->setUTM($_GET['utm'], "test", $id);

        $exclude = [$id];
        if(!empty($_SESSION['uid'])){
            //$sandbox->getRelatedTest( $request,31, $_SESSION['uid'], 9, 2);
            $testUser = User::where('facebook_id', '=', $_SESSION['uid'])
                ->with('usertests')->first();
            if(count($testUser->usertests) > 0)
                foreach($testUser->usertests as $user){
                    $exclude [] = $user->test_id;
                }
        }

        $all_test = $sandbox->relatedTests($country_code, $exclude, $lang);

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

        $all_lang = $this->helper->getActivatedLanguages();
        return $this->view->render($response, 'single.twig', compact('no_ads', 'lang', 'url','id_user','test', 'code', 'all_test', 'permission', 'loginUrl', 'loginUrl2' , 'img_url', 'interface_ui','lang','all_lang'));
    }
}
