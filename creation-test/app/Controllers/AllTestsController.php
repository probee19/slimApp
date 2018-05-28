<?php


namespace App\Controllers;


use App\Helpers\DBIP;
use App\Helpers\Helper;
use App\Models\Admin;
use App\Models\Test;
use App\Models\Resultat;
use App\Models\UserTest;
use App\Models\Share;
use Psr7Middlewares\Middleware\ClientIp;
use GrabzItImageOptions;

class AllTestsController extends Controller
{
  public function index($request, $response, $arg){
    //Helper::checkCookies();
    if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL){
      return $response->withStatus(302)->withHeader('Location', "http://creation.funizi.com" );
    }
    $test_owner = $_COOKIE['id_user'];
    $btn_delete_test_admin = 0;

    $dataTest = array();
    if($_COOKIE['prenom_user'] == 'Pedre')
    $tests = Test::where('statut','!=',-1)
      ->with('defaultLangInfo')
      ->orderBy('id_test','DESC')
      //->take(120)
      ->get();
    else
    $tests = Test::where('statut','!=',-1)
      ->with('defaultLangInfo')
      ->orderBy('id_test','DESC')
      //->take(60)
      ->get();

    foreach ($tests as $test) {
      $btn_delete_test_admin = 0; $if_translated = "Non";
      $link = 'http://'.$test->default_lang.'.funizi.com/test/'.Helper::cleanUrl($test->titre_test).'/'.$test->id_test;

      $admin_id = UserTest::selectRaw('user_id')
        ->join('users','users.id','users_tests.user_id')
        ->where([['test_id','=', $test->id_test],['facebook_id','=',$test_owner]])
        ->first();

      if($admin_id != NULL){
        $btn_delete_test_admin = 1;
        $user_admin_id = $admin_id->user_id;
      }
      if($test->if_translated == 1) $if_translated = "Oui";

      $dataTest []= [
        "id_test"               => $test->id_test,
        "statut"                => $test->statut,
        "titre_test"            => $test->titre_test,
        "lang"                  => $test->defaultLangInfo->name,
        "if_translated"         => $if_translated,
        "url_test"              => $link,
        "highlight"             => $test->highlight,
        "btn_delete_test_admin" => $btn_delete_test_admin,
        "created_at"            => $test->created_at
      ];

    }

    return $this->view->render($response, 'allTests.twig', compact('dataTest','user_admin_id'));

  }



    public function index__($request, $response, $arg){
      //Helper::checkCookies();
      if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL){
        return $response->withStatus(302)->withHeader('Location', "http://creation.funizi.com" );
      }
      $test_owner = $_COOKIE['id_user'];
      $btn_delete_test_admin = 0;

      $dataTest = array();
      $tests = Test::where('statut','!=',-1)
        ->groupBy('id_test')
        ->orderBy('id_test','DESC')
        ->take(40)
        ->get();
      foreach ($tests as $test) {
        $btn_delete_test_admin = 0;
        $link = 'http://fr.funizi.com/test/'.Helper::cleanUrl($test->titre_test).'/'.$test->id_test;

        $admin_id = UserTest::selectRaw('user_id')
          ->join('users','users.id','users_tests.user_id')
          ->where([['test_id','=', $test->id_test],['facebook_id','=',$test_owner]])
          ->first();

        if($admin_id != NULL){
          $btn_delete_test_admin = 1;
          $user_admin_id = $admin_id->user_id;
        }

        $dataTest []= [
          "id_test"               => $test->id_test,
          "statut"                => $test->statut,
          "titre_test"            => $test->titre_test,
          "lang"                  => $test->default_lang,
          "if_translated"         => $test->if_translated,
          "url_test"              => $link,
          "highlight"             => $test->highlight,
          "btn_delete_test_admin" => $btn_delete_test_admin,
          "created_at"            => $test->created_at
        ];

      }
      foreach ($tests as $test) {
        break;
        $btn_delete_test_admin = 0;
          $shares = Share::selectRaw('SUM(partages_count) AS partages_count')
              ->where('test_id',$test->id_test)
              ->groupBy('test_id')
              ->first();
          if($shares)
            $partages_count = $shares->partages_count;
          else
            $partages_count = 0;

          $tested = UserTest::selectRaw('COUNT(*) AS nb_played')
              ->where('test_id',$test->id_test)
              ->groupBy('test_id')
              ->first();
          if($tested){
            $nb_played = $tested->nb_played;
            $taux_share = round(($partages_count/$nb_played*100), 2);
          }
          else{
            $nb_played = 0;
            $taux_share = 0;
          }

          $link = 'http://fr.funizi.com/test/'.Helper::cleanUrl($test->titre_test).'/'.$test->id_test;

          $admin_id = UserTest::selectRaw('user_id')
            ->join('users','users.id','users_tests.user_id')
            ->where([['test_id','=', $test->id_test],['facebook_id','=',$test_owner]])
            ->first();

          if($admin_id != NULL){
            $btn_delete_test_admin = 1;
            $user_admin_id = $admin_id->user_id;
          }

          $dataTest []= [
            "id_test"               => $test->id_test,
            "statut"                => $test->statut,
            "titre_test"            => $test->titre_test,
            "nb_played"             => $nb_played,
            "nb_partage"            => $partages_count,
            "taux_partage"          => $taux_share,
            "nb_showned_discover"   => $test->affichage_discover_count,
            "url_test"              => $link,
            "highlight"             => $test->highlight,
            "btn_delete_test_admin" => $btn_delete_test_admin,
            "created_at"            => $test->created_at
          ];
          //Helper::debug($user_admin_id);
      }

      return $this->view->render($response, 'allTests.twig', compact('dataTest','user_admin_id'));

    }



  public function showMoreTests($request, $response, $arg)
  {

    $test_owner = $_COOKIE['id_user'];
    $btn_delete_test_admin = 0;
    $begin = $_GET['begin'];
    $nb_to_show = $_GET['nb_to_show'];
    //Helper::debug($nb_to_show);

    $dataTest = array(); $to_data_table = array();
    $tests = Test::where('statut','!=',-1)
      ->groupBy('id_test')
      ->orderBy('id_test','DESC')
      ->skip($begin)
      ->take($nb_to_show)
      ->get();
    $begin++;
    foreach ($tests as $test) {
        $btn_delete_test_admin = 0;
        $shares = Share::selectRaw('SUM(partages_count) AS partages_count')
            ->where('test_id',$test->id_test)
            ->groupBy('test_id')
            ->first();
        if($shares)
          $partages_count = $shares->partages_count;
        else
          $partages_count = 0;

        $tested = UserTest::selectRaw('COUNT(*) AS nb_played')
            ->where('test_id',$test->id_test)
            ->groupBy('test_id')
            ->first();
        if($tested){
          $nb_played = $tested->nb_played;
          $taux_share = round(($partages_count/$nb_played*100), 2);
        }
        else{
          $nb_played = 0;
          $taux_share = 0;
        }

        $link = 'http://funizi.com/test/'.Helper::cleanUrl($test->titre_test).'/'.$test->id_test;

        $admin_id = UserTest::selectRaw('user_id')
          ->join('users','users.id','users_tests.user_id')
          ->where([['test_id','=', $test->id_test],['facebook_id','=',$test_owner]])
          ->first();

        if($admin_id != NULL){
          $btn_delete_test_admin = 1;
          $user_admin_id = $admin_id->user_id;
        }
        //$to_data_table [] = [$begin++, "$test->statut", $test->titre_test, $nb_played, $partages_count, $taux_share, $test->affichage_discover_count, 'test'];
        $to_data_table [] = [1,2,4,5,6,7,8,9];

        $dataTest []= [
            $test->id_test,
            $test->statut,
            $test->titre_test,
            $nb_played,
            $partages_count,
            $taux_share,
            $test->affichage_discover_count,
            $link,
            $test->highlight,
            $btn_delete_test_admin,
            $test->created_at
        ];
        //Helper::debug($user_admin_id);
    }
    $test_arr = array();
    $test_arr = [[1,"2","3",4,5,6,"7","8"],[1,"2","3",4,5,6,"7","8"]];
    //$test_arr []= [3,2,3,4,5,6,7,8];

    //Helper::debug($test_arr);

    //return $test_arr;
    //exit;
    return $response->withStatus(200)
        ->write(print_r($test_arr));

    //return $this->view->render($response, 'ajaxviews/moreTests.twig', compact('dataTest','begin','user_admin_id'));

  }


}
