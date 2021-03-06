<?php

namespace App\Controllers;

use App\Helpers\DBIP;
use App\Helpers\Helper;
use App\Controllers\LoadStatsController;
use App\Models\Admin;
use App\Models\TestOwner;
use App\Models\TestInfo;
use App\Models\ThemePerso;
use App\Models\DisabledTest;
use App\Models\Test;
use App\Models\User;
use App\Models\UserTest;
use App\Models\Countries;
use App\Models\Language;
use Psr7Middlewares\Middleware\ClientIp;
use GrabzItImageOptions;

class HomeController extends Controller
{
  public function index($request, $response, $arg){
    //$list_countries = array();
    if(!isset($_COOKIE['id_user'])){
        return $this->view->render($response, 'login.twig');
    }

    $tests = Test::where('statut', 1)->get();
    $countries = Countries::selectRaw('alpha2, langFR')
      ->join('users','country_code','=','alpha2')
      ->distinct()
      ->orderBy('langFR','ASC')
      ->get();

    $langs = Language::where('status','=','1')->get();
      //Helper::debug($countries);
    return $this->view->render($response, 'home.twig', compact( 'tests', 'countries', 'langs'));

  }
  public function createCookies($request, $response, $arg)
  {
      $id_user = $_POST['id'];
      $est_admin = false;
      $admin = Admin::where('id_fb','=',$id_user)->first();
      if($admin){
        setcookie('id_user', $id_user, time() + 7*24*3600, null, null, false, true);
        setcookie('email_user', $_POST['email'], time() + 7*24*3600, null, null, false, true);
        setcookie('nom_user', $_POST['nom'], time() + 7*24*3600, null, null, false, true);
        setcookie('prenom_user', $_POST['prenom'], time() + 7*24*3600, null, null, false, true);
        setcookie('url_photo_user',"https://graph.facebook.com/".$id_user."/picture?height=200", time() + 365*24*3600, null, null, false, true);

        $testOwner =  TestOwner::where('id_test_owner','=',$id_user)->first();
        if(!$testOwner){
          $newTestOwner = TestOwner::create([
            'id_test_owner' =>  $id_user,
            'nom'           =>  $_POST['nom'],
            'prenoms'       =>  $_POST['prenom'],
            'email'         =>  $_POST['email']

          ]);
        }

      }
      else
        echo "Vous n'etes pas autorisé(e) à vous connecter !";

  }
  public function logout($request, $response){

      // Suppression de la valeur du cookie en mémoire dans $_COOKIE
      unset($_COOKIE['id_user']);
      unset($_COOKIE['email_user']);
      unset($_COOKIE['nom_user']);
      unset($_COOKIE['prenom_user']);
      unset($_COOKIE['url_photo_user']);
      // Suppression du fichier cookie
      setcookie('id_user', '', time() - 3600, '/');
      setcookie('email_user', '', time() - 3600, '/');
      setcookie('nom_user', '', time() - 3600, '/');
      setcookie('prenom_user', '', time() - 3600, '/');
      setcookie('url_photo_user', '', time() - 3600, '/');

      // unset cookies
      if (isset($_SERVER['HTTP_COOKIE'])) {
          $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
          foreach($cookies as $cookie) {
              $parts = explode('=', $cookie);
              $name = trim($parts[0]);
              setcookie($name, '', time()-1000);
              setcookie($name, '', time()-1000, '/');
          }
      }
      $disconnected = true;
      return $response->withStatus(302)->withHeader('Location', "http://creation.funizi.com/" );
  }


  public function chunk($request, $response, $args){

    $result = Helper::curl_get_fields("https://creation.funizi.com/action/updatejsonalltests",[]);
    $this->helper->debug($result);

  }
  public static function curlCmf($url_api, $data)
  {
      $curl = curl_init($url_api);
      curl_setopt($curl, CURLOPT_POST,1);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      $resp = curl_exec($curl);
      curl_close($curl);
      return json_decode($resp);
  }

  public function desableSpecificTest($request, $response, $arg)
  {
      $tests = [];
      $tests_to_disable = ThemePerso::selectRaw('id_test ')->where('nb_friends_fb','>',0)->distinct()->with('test')->get();
      foreach ($tests_to_disable as $test) {

        $tests[] =  [
            'id_test' =>  $test->id_test,
            'titre'   =>  $test->test->titre_test
          ];

        DisabledTest::create([
          'id_test'       =>  $test->id_test,
          'objet'         =>  'Bug FB friends list',
          "created_at"    =>  \date("Y-m-d H:i:s"), # \Datetime()
          "updated_at"    =>  \date("Y-m-d H:i:s")  # \Datetime()
        ]);
        Test::where([['id_test',$test->id_test],['statut','=', 1]])->update(['statut' => 0]);
        echo 'Test' . $test->id_test . ' désactivé avec succès !<br>';
      }
      $this->helper->debug($tests);
  }

  public function enableSpecificTest($request, $response, $arg)
  {
    $disabled_tests = DisabledTest::all();

    foreach ($disabled_tests as $test) {
      Test::where([['id_test',$test->id_test],['statut','=', 0]])->update(['statut' => 1]);
      echo 'Test' . $test->id_test .' réactivé avec succès !<br>';
    }


  }


  public function updateVarTestFile($request, $response, $arg)
  {
    $test_id = 2;

    $tests = Test::where([['id_theme','=','4'],['id_test','=','207']])->orderBy('id_test','DESC')->get();
    Helper::debug(count($tests));

    $langs = Language::where('status','=',1)->get();
    $nb_done = 0;

    foreach ($tests as $test) {
      Helper::debug($test->titre_test);

      foreach ($langs as $lang) {
        $test_infos = TestInfo::where([['id_test','=',$test->id_test],['lang','=',$lang->code]])->get();
        foreach ($test_infos as $test_info) {
          Helper::debug($test_info->lang);

            $file = "ressources/views/themes/perso/".$test_info->lang."_file_test_".$test->id_test.".php";
        	  $content_file = file_get_contents($file);

            $texte = "Le test ". $test->id_test ." a été mis à jour pour le ". $test_info->lang;

            if($file){
              Helper::debug($texte);
              $old_var_1 = '';
              $content_file = str_replace('$_GET[', 'urldecode($_GET[', $content_file);
              $content_file = str_replace('];', ']);', $content_file);

              $url_temp_file_php = 'ressources/views/themes/perso/'.$test_info->lang.'_file_test_'.$test->id_test;
              $temp_file_php = fopen($url_temp_file_php.".php", "w+");
              if($temp_file_php==false)
              die("La création du fichier a échoué");

              fputs($temp_file_php, $content_file);

              Helper::debug($content_file);
              $nb_done++;

            }

        }
      }
    }
    Helper::debug($nb_done);

    exit;
  }
}
