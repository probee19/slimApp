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
    public function index($request, $response, $arg)
    {
      $url = $this->helper->detectLang($request, $response);
      if($url != "") return $response->withStatus(302)->withHeader('Location', $url );
      $lang = $this->helper->getLangSubdomain($request);

      if($_GET['pays'] && $_GET['pays'] !=''){
         // $country_code = strtoupper($_GET['pays']);
      }else{
          $helper = new Helper();
          $country_code = $helper->getCountryCode($request);
      }
      $helper = new Helper();

      if($_GET['utm'] && $_GET['utm'] !='')
          $helper->setUTM($_GET['utm'],"home");

      $cookie = $helper->createCookie();
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
      $pagecount = intval(ceil($alltest/$pagecount));

      if($arg['pageid'])
        $pageid = $arg['pageid'];
      else
        $pageid = 1;
      $name_session_page = $lang.'_page_'.$pageid;
        if($pageid == 1){
            $first_tests = array(290, 305, 286, 287 );
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
        if($alltest == count($_SESSION["seen"]) || $alltest <= count($_SESSION["seen"])) $_SESSION["seen"] = array();
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
              if(!in_array($test['id_test'], $exclude, true)) array_push($exclude, $test['id_test']);
              array_push($page_tests, $test['id_test']);
            }
          }

          $_SESSION['seen'] = $exclude;
          $_SESSION[$name_session_page] = $page_tests;
      }

      // Traduction des éléments de l'interface
      $interface_ui = $this->helper->getUiLabels($lang);
      $all_lang = $this->helper->getActivatedLanguages();

      return $this->view->render($response, 'home.twig', compact('tests_on_top', 'lang', 'tests', 'pagecount', 'pageid', 'mode', 'interface_ui', 'all_lang'));

    }

    public function privacyPolicy($request, $response, $arg)
    {
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

        $pagecount = intval(ceil($alltest/$pagecount));
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
        if(!$_SESSION['user_has_disconnected'] || $_SESSION['user_has_disconnected'] != 'yes'){
            $_SESSION['uid'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['last_name'] = $lastname;
            //$_SESSION['email'] = $email;
            $_SESSION['gender'] = $gender;
            //$_SESSION['pic'] = $picture;
        }
        $data = [$id, $name, $lastname, $gender, $_SESSION['friends'], $_SESSION['posts'], $_SESSION['photos'], $_SESSION['accepted'], $_SESSION['fb_access_token'] ];
        return $response->withStatus(201)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($data));

    }

    private function saveOrUpdate($id, $name, $lastname, $genre, $ip){
        $country = Helper::getCountry($ip);
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

    public function chunk($request, $response, $arg){


        $url = $this->helper->detectLang($request, $response);
        if($url != "") return $response->withStatus(302)->withHeader('Location', $url );
        $lang = $this->helper->getLangSubdomain($request);

        if($_GET['pays'] && $_GET['pays'] !=''){
            $country_code = strtoupper($_GET['pays']);
        }else{
            $helper = new Helper();
            $country_code = $helper->getCountryCode($request);
        }
        $helper = new Helper();

        if($_GET['utm'] && $_GET['utm'] !='')
            $helper->setUTM($_GET['utm'],"home");

        $cookie = $helper->createCookie();
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
        $pagecount = intval(ceil($alltest/$pagecount));

        if($arg['pageid'])
          $pageid = $arg['pageid'];
        else
          $pageid = 1;
        $name_session_page = $lang.'_page_'.$pageid;
        if($pageid == 1){
          $first_tests = array(290, 305, 286, 287 );
          shuffle($first_tests);
          $first_tests = array_slice($first_tests,0,3);
          foreach ($first_tests as $test) {
            $tests_on_top[$test] = [
              'url_image_test' => $tests_from_json[$test]['url_image_test'],
              'id_test'        => $tests_from_json[$test]['id_test'],
              'titre_test'     => $tests_from_json[$test]['titre_test']
            ];
          }
          //Helper::debug($first_tests);
          //Helper::debug($tests_on_top);


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
          if($alltest == count($_SESSION["seen"]) || $alltest <= count($_SESSION["seen"])) $_SESSION["seen"] = array();
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
                if(!in_array($test['id_test'], $exclude, true)) array_push($exclude, $test['id_test']);
                array_push($page_tests, $test['id_test']);
              }
            }

            $_SESSION['seen'] = $exclude;
            $_SESSION[$name_session_page] = $page_tests;
        }
        // Traduction des éléments de l'interface
        $interface_ui = $this->helper->getUiLabels($lang);
        $all_lang = $this->helper->getActivatedLanguages();
        return $this->view->render($response, 'chunk.twig', compact('tests_on_top', 'lang', 'tests', 'pagecount', 'pageid', 'mode', 'interface_ui', 'all_lang'));

    }



}
