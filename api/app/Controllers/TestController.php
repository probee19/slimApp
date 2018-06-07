<?php


namespace App\Controllers;


use App\Helpers\Helper;
use App\Models\Test;
use App\Models\User;
use App\Models\UserTest;

class TestController extends Controller
{

    public function index($request, $response, $args){
        $sandbox = new Helper();
        if($_GET['pays'] && $_GET['pays'] !=''){
            $country_code = strtoupper($_GET['pays']);
        }else{
            $country_code = $sandbox->getCountryCode();
        }
        if($_GET['con'] && $_GET['con'] === 'new')
            $new_con = true;
        $id = $args['id'];
        $code = $request->getParam('ref');
        $user_test = UserTest::where('uuid', '=', "$code")->first();
        $img_url = $user_test->img_url;
        //Helper::debug($country_code);
        $test = Test::where('id_test', '=', $id)->with('themeInfo')->with('testAdminInfo')->with('testOwnerInfo')->first();
        $permission = $test->permissions;
        if(!$test->testAdminInfo && $test->testOwnerInfo){
            $test_owner = [
                "facebook_id" => $test->testOwnerInfo->facebook_id,
                "first_name" => $test->testOwnerInfo->first_name,
                "last_name" => $test->testOwnerInfo->last_name
            ];
        }
        if(! $test){
            $result_url = $this->router->pathFor('accueil' );
            $this->flash->addMessage('invalid_test', 'Test introuvable ou supprimé');
            return $response->withStatus(302)->withHeader('Location', $result_url );
        }
        //$tested = [0];
        $exclude = ["$id"];
        if(!empty($_SESSION['uid'])){
            //$sandbox->getRelatedTest( $request,31, $_SESSION['uid'], 9, 2);
            $testUser = User::where('facebook_id', '=', $_SESSION['uid'])
                ->with('usertests')->first();
            foreach($testUser->usertests as $user){
                $exclude [] = $user->test_id;
            }
        }

        if($test->codes_countries != ''){
            $all_test = $sandbox->relatedTests($country_code, $exclude);

        }else{
            $all_test = $sandbox->relatedTests($country_code, $exclude);
        }
        // For Facebook connect
        $helper = $this->fb->getRedirectLoginHelper();
        if($permission == 1){
            $permissions = ['user_friends','user_posts','user_photos'];
            $loginUrl = $helper->getReRequestUrl('http://www.funizi.com/connect_user2?id='.$id.'&permission='.$permission, $permissions);
            $loginUrl2 = $helper->getReRequestUrl('http://www.funizi.com/connect_user_test?id='.$id.'&permission='.$permission, $permissions);
        }else
        {
            $permissions = ['public_profile'];
            $loginUrl = $helper->getLoginUrl('http://www.funizi.com/connect_user2?id='.$id.'&permission='.$permission, $permissions);
        }// Optional permissions


        //$helper = new Helper();
        $sandbox->createCookie();

        return $this->view->render($response, 'single.twig', compact('test', 'code', 'all_test', 'new_con', 'permission', 'loginUrl', 'loginUrl2' , 'test_owner', 'img_url'));
    }
}
