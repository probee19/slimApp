<?php

namespace App\Controllers;

use App\Helpers\DBIP;
use App\Helpers\Helper;

use App\Helpers\SandBox;
use App\Helpers\RandomStringGenerator;
use App\Models\Resultat;
use App\Models\ThemePerso;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

use App\Helpers\Browser;
use App\Models\Admin;
use App\Models\Test;
use App\Models\TestInfo;
use App\Models\User;
use App\Models\UserTest;
use App\Models\Visitors;
use App\Models\Language;
use Psr7Middlewares\Middleware\ClientIp;
use GrabzItImageOptions;

class HomeController extends Controller
{
    public function index($request, $response, $arg) {
      //die();

      $url = $this->helper->detectLang($request, $response);
      if($url != "") return $response->withStatus(302)->withHeader('Location', $url );
      $lang = $this->helper->getLangSubdomain($request);
      $country_code = $this->helper->getCountryCode();


      if(isset($_GET['utm']) && !empty($_GET['utm']))
          $this->helper->setUTM($_GET['utm'],"home");

      $cookie = $this->helper->createCookie();
      $pagecount = $this->test_per_page;

      // Récuperation des tests pour langue $lang;
      $tests_from_json = $this->helper->getAllTestJson($lang);

      // Calcul du nombre total de tests
      foreach ($tests_from_json as $test) {
        if($test['codes_countries'] == "" || strpos($test['codes_countries'], $country_code) != false ){
          $tests_json[] = [
            'url_image_test' => $test['url_image_test'],
            'id_test'        => $test['id_test'],
            'titre_test'     => $test['titre_test']
          ];
        }
      }
      $alltest = count($tests_json);

      // Nombre de pages
      $pagecount = (int)ceil($alltest / $pagecount);

      if(!empty($arg['pageid']))
        $pageid = $arg['pageid'];
      else
        $pageid = 1;
      $name_session_page = $lang.'_tests_page_'.$pageid;

      // Récuperation des tests au top
      $tests_on_top = array();
      if($pageid == 1){
        //$first_tests = array(321, 319, 318, 317, 316, 306, 290, 286, 287 );
        $first_tests = array(363, 324, 323, 317, 316, 315, 306 );
        shuffle($first_tests);
        $first_tests = array_slice($first_tests,0,3);
        foreach ($first_tests as $test) {
          $tests_on_top[$test] = [
            'url_image_test' => $tests_from_json[$test]['url_image_test'],
            'id_test'        => $tests_from_json[$test]['id_test'],
            'titre_test'     => $tests_from_json[$test]['titre_test']
          ];
        }
      }

      // Si cette page a été déjà ouverte et en session
      if(isset($_SESSION[$name_session_page]) && !empty($_SESSION[$name_session_page]) ){
        $include = $_SESSION[$name_session_page];
        foreach ($tests_from_json as $test) {
          if(in_array($test['id_test'], $include, true)){
            $tests[$test['id_test']] = [
              'url_image_test' => $test['url_image_test'],
              'id_test'        => $test['id_test'],
              'titre_test'     => $test['titre_test']
            ];
          }
        }
        $tests = array_replace(array_flip($include), $tests);
      }
      else {// Si cette page n'est pas en session

        if($alltest == count($_SESSION["seen"]) || $alltest <= count($_SESSION["seen"]))
        	$_SESSION["seen"] = array();
        $exclude = array();
        if(isset($_SESSION['seen']))
          $exclude = $_SESSION['seen'];
          shuffle($tests_from_json);
          $nb_taken = 0;
          $page_tests = array();
          foreach ($tests_from_json as $test) {
            if(($test['codes_countries'] == "" || strpos($test['codes_countries'], $country_code) != false ) && !in_array($test['id_test'], $exclude, true) && ++$nb_taken <= $this->test_per_page){
              $tests[$test['id_test']] = [
                'url_image_test' => $test['url_image_test'],
                'id_test'        => $test['id_test'],
                'titre_test'     => $test['titre_test']
              ];
              if(!in_array($test['id_test'], $exclude, true)) $exclude[] = $test['id_test'];
              $page_tests[] = $test['id_test'];
            }
          }

          $_SESSION['seen'] = $exclude;
          $_SESSION[$name_session_page] = $page_tests;
      }

      // Traduction des éléments de l'interface
      $interface_ui = $this->helper->getUiLabels($lang);
      $all_lang = $this->helper->getActivatedLanguages();
      //$this->helper->debug($all_lang);
      if($_GET['debug'] && $_GET['debug'] == true)
        $this->helper->debug($tests);
      return $this->view->render($response, 'home.twig', compact('tests_on_top', 'lang', 'tests', 'pagecount', 'pageid', 'interface_ui', 'all_lang'));

    }

    public function privacyPolicy($request, $response, $arg){
      $url = $this->helper->detectLang($request, $response);
      if($url != "") return $response->withStatus(302)->withHeader('Location', $url );

      $lang = $this->helper->getLangSubdomain($request);

      $interface_ui = $this->helper->getUiLabels($lang);
      $all_lang = $this->helper->getActivatedLanguages();
      return $this->view->render($response, 'privacypolicy.twig', compact('interface_ui','all_lang'));
    }

    public function devEnv($request, $response, $arg){
        //$maint = time();
        //var_dump($maint);
        $pagecount = $this->test_per_page;
        $alltest = Test::where('statut', '1')->count();

        $pagecount = (int) ceil($alltest/$pagecount);
        if($arg['pageid']){
            $pageid = $arg['pageid'];
            $tests = Test::where('statut', '1')->orderBy('id_test', 'desc')->skip($this->test_per_page*($pageid - 1))->take(6)->get();
        }else{
            $tests = Test::where('statut', '1')->orderBy('id_test', 'desc')->take($this->test_per_page)->get();
            $pageid = 1;
        }
        return $this->view->render($response, 'home.twig', compact('tests', 'pagecount', 'pageid'));
    }

    public function logout($request, $response){

        session_destroy();
        session_unset();
        session_start();
        $_SESSION['user_has_disconnected'] = 'yes';
        // Suppression du fichier cookie
        unset($_COOKIE['id_user']);
        //unset($_COOKIE['email_user']);
        unset($_COOKIE['nom_user']);
        unset($_COOKIE['prenom_user']);
        unset($_COOKIE['url_photo_user']);
        setcookie('id_user', null, -1);
        //setcookie('email_user', null, -1);
        setcookie('nom_user', null, -1);
        setcookie('prenom_user', null, -1);
        setcookie('url_photo_user', null, -1);



        $result_url = $this->router->pathFor('accueil');
        return $response->withStatus(302)->withHeader('Location', $result_url );
    }

    public function login($request, $response){
        $id = $request->getParam('id');
        $email = $request->getParam('email');
        $first_name = $request->getParam('prenom');
        $last_name = $request->getParam('nom');

    }

    public function createSession($request, $response){

        $id = $request->getParam('id');
        $name = $request->getParam('first_name');
        $lastname = $request->getParam('last_name');
        //$email = $request->getParam('email');
        $gender = $request->getParam('gender');
        //$picture = $request->getParam('pic');
        if(!isset($_SESSION['user_has_disconnected']) || (isset($_SESSION['user_has_disconnected']) && $_SESSION['user_has_disconnected'] !== 'yes')){
            $_SESSION['uid'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['last_name'] = $lastname;
            //$_SESSION['email'] = $email;
            $_SESSION['gender'] = $gender;
            //$_SESSION['pic'] = $picture;
        }
        $friends = []; $posts = []; $photos = [];
        if(isset($_SESSION['friends'])) $friends = $_SESSION['friends'];
        if(isset($_SESSION['posts']))   $posts = $_SESSION['posts'];
        if(isset($_SESSION['photos']))  $photos = $_SESSION['photos'];

        $data = [$id, $name, $lastname, $gender, $friends, $posts, $photos, $_SESSION['accepted'], $_SESSION['fb_access_token'] ];
        return $response->withStatus(201)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($data));
    }

    private function saveOrUpdate($id, $name, $lastname, $genre, $ip){
        $country = $this->helper->getCountry($ip);
        try{
            $user_in = User::where('facebook_id', $id)->firstOrFail();
        }catch(\Exception $e){
            $user_in = User::create([
                'first_name'    =>  $name,
                'facebook_id'   =>  $id,
                'last_name'     =>  $lastname,
                'genre'         =>  $genre,
                'ip_address'     =>  $ip,
                'country_code'  =>  $country['countryCode'],
                'country_name'  =>  $country['countryName']
            ]);
        }
        return $user_in;
    }

    public function setSessionVar($request, $response, $arg)
    {
      $varName = $request->getParam('varName');
      $value = $request->getParam('value');
      $_SESSION[$varName] = $value;
      return 'Session setted.';
    }

    public function setSessionVarCDM($request, $response, $arg)
    {
      $varName = $request->getParam('varName');
      $data = [
        'cc'  =>  $request->getParam('countryCode'),
        'cn'  =>  $request->getParam('countryName'),
        'cf'  =>  $this->storage_base."/api/flags_big/".$request->getParam('countryCode').".png"
      ];
      $_SESSION[$varName] = json_encode($data);
      return 'Session setted.';
    }



    public function chunk($request, $response, $args){


      $result = json_decode(self::curl_get_fields("https://creation.funizi.com/chunk/jsonalltests",[]));
      $this->helper->debug($result);
      exit;
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
      if($args['code'])
          $code = $args['code'];
      //$user_test = UserTest::where('uuid', '=', "$code")->first();
      //$img_url = $user_test->img_url;
      $img_url = "/uploads/$code.jpg";

      $tests_from_json = $this->helper->getAllTestJson($lang, true);
      $test  = $tests_from_json[$id];
      $this->helper->debug($test);
      $this->helper->debug($tests_from_json);

      $permission = $test['permissions'];
      if((!$test || $test['statut'] != 1 ) && (!isset($_GET['admin'])) ){
          $result_url = $this->router->pathFor('accueil' );
          $this->flash->addMessage('invalid_test', $interface_ui['label_notif_no_test']);
          return $response->withStatus(302)->withHeader('Location', $result_url );
      }

      if(isset($_GET['utm']) && $_GET['utm'] !='')
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

        //
        //$this->helper->getScore($args['id']);
        //exit;
    }

    public function saveSubNewsletter($request, $response, $arg)
    {
      // code...
      $email = $request->getParam('email');

      $fields = [
        "email_address"   =>  $email,
        "status"          =>  "subscribed",
        "merge_fields"    => [
          "FNAME"     => "",
          "LNAME"     =>  ""
        ]
      ];

      //bb5803e8fa
      //https://us18.api.mailchimp.com/3.0/lists/bb5803e8fa/members/

      $headers = array
      (
         'Content-Type: application/json'
      );

      $ch = curl_init();
      curl_setopt( $ch,CURLOPT_URL, 'https://us18.api.mailchimp.com/3.0/lists/bb5803e8fa/members/' );
      curl_setopt( $ch,CURLOPT_POST, true );
      curl_setopt( $ch,CURLOPT_USERPWD, "funizi:4da9d27b280c9e5a686ba3c29799269e-us18" );
      curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
      curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
      curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, true );
      curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
      $result = curl_exec($ch );
      curl_close( $ch );



      $this->helper->debug($result);
      return "Email reçu";
    }


}
