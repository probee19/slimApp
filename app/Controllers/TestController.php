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
        $this->helper->debug($_SERVER['REQUEST_URI']);
        $this->helper->debug($url);
        if($url != "") return $response->withStatus(302)->withHeader('Location', $url );


        $lang = $this->helper->getLangSubdomain($request);
        $interface_ui = $this->helper->getUiLabels($lang);

        $id = (int) $args['id'];
        $country_code = $this->helper->getCountryCode();

        $code = $request->getParam('ref');
        if($args['code'])
            $code = $args['code'];
        $user_test = UserTest::where('uuid', '=', "$code")->first();
        $img_url = $user_test->img_url;
        $test = Test::selectRaw('tests.titre_test AS titre_test_fr, tests.permissions AS permissions, tests.id_test AS id_test, tests.url_image_test AS url_image_test, test_info.lang AS lang, test_info.titre_test AS titre_test')
              ->join('test_info','test_info.id_test','tests.id_test')
              ->where([['tests.id_test', '=', $id],['test_info.lang','=',$lang]])->first();
              //->with('themeInfo')
        $permission = $test->permissions;
        if(! $test){
            $result_url = $this->router->pathFor('accueil' );
            $this->flash->addMessage('invalid_test', $interface_ui['label_notif_no_test']);
            return $response->withStatus(302)->withHeader('Location', $result_url );
        }

        if($_GET['utm'] && $_GET['utm'] !='')
            $this->helper->setUTM($_GET['utm'], "test", $id);

        $exclude = [$id];
        if(!empty($_SESSION['uid'])){
            //$sandbox->getRelatedTest( $request,31, $_SESSION['uid'], 9, 2);
            $testUser = User::where('facebook_id', '=', $_SESSION['uid'])
                ->with('usertests')->first();
            foreach($testUser->usertests as $user){
                $exclude [] = $user->test_id;
            }
        }

        $all_test = $this->helper->relatedTests($country_code, $exclude, $lang);
        // For Facebook connect
        $helper = $this->fb->getRedirectLoginHelper();
        if($permission == 1){
            $permissions = ['user_friends','user_posts','user_photos'];
            $loginUrl  = $helper->getReRequestUrl($request->getUri()->getBaseUrl().'/connect_user2?id='.$id.'&permission='.$permission, $permissions);
            $loginUrl2 = $helper->getReRequestUrl($request->getUri()->getBaseUrl().'/connect_user_test?id='.$id.'&permission='.$permission, $permissions);
        }else
        {
            $permissions = ['public_profile'];
            $loginUrl = $helper->getLoginUrl($request->getUri()->getBaseUrl().'/connect_user2?id='.$id.'&permission='.$permission, $permissions);
        }// Optional permissions
        //$helper = new Helper();
        //$sandbox->createCookie();
        $id_user = 0;
        if(isset($_SESSION['uid']))
          $id_user = $_SESSION['uid'];

        //$uuid_str = new RandomStringGenerator('0123456789');
        //$uuid = 'fun_'.$uuid_str->generate(10);
        //$url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

        $all_lang = $this->helper->getActivatedLanguages();
        return $this->view->render($response, 'single.twig', compact('lang', 'url','uuid','id_user','test', 'code', 'all_test', 'new_con', 'permission', 'loginUrl', 'loginUrl2' , 'test_owner', 'img_url', 'interface_ui','lang','all_lang'));
    }
}
