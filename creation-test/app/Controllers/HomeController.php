<?php


namespace App\Controllers;


use App\Helpers\DBIP;
use App\Helpers\Helper;
use App\Controllers\LoadStatsController;
use App\Models\Admin;
use App\Models\TestOwner;
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
    //Helper::setFileTest();
    Helper::setHighlightsJSON();
    //Helper::UpdateTranslationTest();
    //Helper::debug($data_line_chart);
    //exit;
    exit;

    return $this->view->render($response, 'chunk.twig', compact('data_pie'));


  }
}
