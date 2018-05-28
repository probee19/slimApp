<?php


namespace App\Controllers;


use App\Helpers\Helper;
use App\Models\DailyStat;
use App\Models\Resultat;
use App\Models\Share;
use App\Models\Test;
use App\Models\User;
use App\Models\UserTest;
use App\Models\Theme;

class AllResultsController extends Controller
{
    public function index($request, $response, $args){
      //Helper::checkCookies();
      if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL)
        return $response->withStatus(302)->withHeader('Location', "http://creation.funizi.com" );

        $data_users_tests = array();
        $themes = Theme::all();
        $users_tests = UserTest::with('testInfo')->with('userInfo')->orderBy('id','DESC')->take(40)->get();
        foreach ($users_tests as $user_test) {
          $nb_clics = 0; $shared = false;
          $share = Share::where('result_code','=',$user_test->uuid)->first();
          if($share){
            $shared = true;
            $nb_clics = $share->clicks_count;
          }

          $date_test = new \DateTime($user_test->created_at);
          $today =new \DateTime();
          if($today->format("d") == $date_test->format("d")) $jour = " Aujourd'hui";
          else $jour = $date_test->format("d").'/'.$date_test->format("m").'/'.$date_test->format("Y");
          $heure = $date_test->format("H").':'.$date_test->format("i").':'.$date_test->format("s");


          $data_users_tests[] = [
            'img_url'     =>  $user_test->img_url,
            'theme'       =>  $user_test->testInfo->id_theme,
            'titre_test'  =>  $user_test->testInfo->titre_test,
            'rubrique'    =>  $user_test->testInfo->id_rubrique,
            'date_test'   =>  $user_test->created_at,
            'shared'      =>  $shared,
            'day'         =>  $jour,
            'hour'        =>  $heure,
            'nb_clics'    =>  $nb_clics,
            'facebook_id' =>  $user_test->userInfo->facebook_id
          ];
        }

        return $this->view->render($response, 'allResults.twig', compact('themes', 'data_users_tests'));
    }
}
