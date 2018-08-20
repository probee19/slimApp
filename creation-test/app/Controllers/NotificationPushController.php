<?php


namespace App\Controllers;


use App\Helpers\DBIP;
use App\Helpers\Helper;
use App\Models\Admin;
use App\Models\TestOwner;
use App\Models\Test;
use App\Models\ThemePerso;
use App\Models\TestInfo;
use App\Models\User;
use App\Models\UserTest;
use App\Models\Countries;
use App\Models\Language;
use App\Models\Highlights;
use App\Models\InterfaceUi;
use App\Models\InterfaceUiTranslations;
use App\Models\NotificationSubscriptions;
use App\Models\NotificationCampaigns;
use Psr7Middlewares\Middleware\ClientIp;
use GrabzItImageOptions;

class NotificationPushController extends Controller
{
  public function index($request, $response, $arg){

    //Helper::checkCookies();
    if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL){
      return $response->withStatus(302)->withHeader('Location', "https://creation.funizi.com" );
    }

    $subscriptions = NotificationSubscriptions::orderBy('id','DESC')->get();
    $campaigns = NotificationCampaigns::orderBy('id','DESC')->get();
    $tests = Test::where('statut','=',1)->orderBy('id_test','DESC')->get();
    $langs = Language::where('status','=','1')->get();
    $countries = Countries::selectRaw('alpha2, langFR')
      ->join('users','country_code','=','alpha2')
      ->distinct()
      ->orderBy('langFR','ASC')
      ->get();

    $nb_block = self::getErrors();
    return $this->view->render($response, 'pushInterface.twig', compact('campaigns','subscriptions','tests','langs','countries','nb_block'));
  }

  public static function getErrors()
  {
    $file = file_get_contents("../ressources/views/error-notification.txt");
    return intval($file);

  }

  public function getInfoTest($request, $response, $arg)
  {
    $countries = json_decode($_POST['countries']);
    $countries_filter = array();
    foreach ($countries as $country_code => $country_name) {
        $countries_filter []= $country_code;
    }
    if(isset($_POST['test']) && $_POST['test'] != 0 && $_POST['test'] != -1) {
      $test = Test::where('id_test','=',$_POST['test'])->first();
      $data_test = [
        'test_id'     =>  $test->id_test,
        'title'       =>  $test->titre_test,
        'body'        =>  $test->titre_test,
        'url_img'     =>  $test->url_image_test,
        'countries'   =>  $countries_filter
      ];
    }
    elseif(isset($_POST['test']) && $_POST['test'] == 0)
      $data_test = [
        'test_id'     =>  "0",
        'title'       =>  "Jeu concours Funizi",
        'body'        =>  "Gagne des lots en faisant des tests fun !",
        'url_img'     =>  "",
        'countries'   =>  $countries_filter
      ];
    elseif(isset($_POST['test']) && $_POST['test'] == -1)
      $data_test = [
        'test_id'     =>  "-1",
        'title'       =>  "Des tests pour toi sur Funizi",
        'body'        =>  "Découvre notre séléction de tests funs !",
        'url_img'     =>  "",
        'countries'   =>  $countries_filter
      ];

    return json_encode($data_test);
  }

  public function sendToAdmin($request, $response, $arg)
  {
    // Get subscribers to send campaign

    if($_POST['mode_admin'] == 1){
      if($_POST['test'] != 0 && $_POST['test'] != -1)
        $url = 'https://fr.funizi.com/test/'.Helper::cleanUrl($_POST['title']).'/'.$_POST['test'].'?utm_source=notification&utm_medium=push&utm_campaign=funizi_push_notifitication_'.date("Y-m-d").'&utm_content=test_'.$_POST['test'];
      elseif($_POST['test'] == 0)
        $url = 'https://fr.funizi.com/games?utm_source=notification&utm_medium=push&utm_campaign=funizi_push_notifitication_'.date("Y-m-d").'&utm_content=game';
      elseif($_POST['test'] == -1)
        $url = 'https://fr.funizi.com/discover?utm_source=notification&utm_medium=push&utm_campaign=funizi_push_notifitication_'.date("Y-m-d").'&utm_content=discover_page';

      $countries = json_decode($_POST['countries']);
      $countries_filter = array(); $data_countries = '';
      foreach ($countries as $country_code => $country_name) {
          $countries_filter []= $country_code;
          $data_countries .=  $country_code . ' ';
      }


      $subscriptions = NotificationSubscriptions::whereIn('id',[520])->get();
      foreach ($subscriptions as $endpoint) {
        $registrationIds []= $endpoint->token;
      }
      // Prepare the bundle
      $msg = array
      (
          'notification'  =>  array(
            'title' =>  ' ',
            'body'  =>  ' ',
            'icon'  =>  ' ',
          )
      );

      $fields = array
      (
      	'registration_ids' 	=> $registrationIds,
      	'data'			=> $msg
      );

      $headers = array
      (
        'Authorization: key=' . 'AAAAgnRGv2I:APA91bGSxdHdJtNjKSRCSfd8PuPzcKkIokdLVroaSlprMpxdmbIShmdXf1C3Aj7mwyQqKQKGagGaaOUtAuZjaarG2-POmW7b7nmOdP9pVSbYBvjGz3dkPHVHTOt-Ozs4REbDd7B5euIC',
      	'Content-Type: application/json'
      );

      try{
        $draft = NotificationCampaigns::where([['status','=','draft'],['created_by','=',$_COOKIE['id_user']]])->firstOrFail();
        $notif = $draft->id;
        $data_update_a = [
          'test_id'       =>  $_POST['test'],
          'body'          =>  $_POST['body'],
          'icon'          =>  $_POST['icon'],
          'title'         =>  $_POST['title'],
          'countries'     =>  $data_countries,
          'url'           =>  $url,
          'nb_endpoints'  =>  count($registrationIds),
          'nb_success'    =>  0,
          'nb_fails'      =>  0
        ];
        NotificationCampaigns::where('id','=',$notif)->update($data_update_a);

        //
      }catch(\Exception $e){
        $notif = NotificationCampaigns::insertGetId([
          'test_id'       =>  $_POST['test'],
          'body'          =>  $_POST['body'],
          'icon'          =>  $_POST['icon'],
          'title'         =>  $_POST['title'],
          'countries'     =>  $data_countries,
          'url'           =>  $url,
          'created_by'    =>  $_COOKIE['id_user'],
          'status'        =>  'draft',
          'nb_endpoints'  =>  count($registrationIds),
          'nb_success'    =>  0,
          'nb_fails'      =>  0,
          'created_at'    =>  \date("Y-m-d H:i:s"),
          'updated_at'    =>  \date("Y-m-d H:i:s")
        ]);
      }
      if($_POST['test'] != 0 && $_POST['test'] != -1)
        $new_url = 'http://fr.funizi.com/test/'.Helper::cleanUrl($_POST['title']).'/'.$_POST['test'].'?utm_source=notification&utm_medium=push&utm_campaign=funizi_push_notifitication_'.date("Y-m-d").'_'.$notif.'&utm_content=test_'.$_POST['test'];
      elseif($_POST['test'] == 0)
        $new_url = 'https://fr.funizi.com/games?utm_source=notification&utm_medium=push&utm_campaign=funizi_push_notifitication_'.date("Y-m-d").'&utm_content=game';
      elseif($_POST['test'] == -1)
        $new_url = 'https://fr.funizi.com/discover?utm_source=notification&utm_medium=push&utm_campaign=funizi_push_notifitication_'.date("Y-m-d").'&utm_content=discover_page';

      NotificationCampaigns::where('id','=',$notif)->update(['url'=>$new_url]);

      $ch = curl_init();
      curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
      curl_setopt( $ch,CURLOPT_POST, true );
      curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
      curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
      curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
      curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
      $result = curl_exec($ch );
      curl_close( $ch );


      $stats = json_decode($result, true);
      $data_result = [
        'id_campaign'   => $notif,
        'success'       => $stats['success'],
        'failure'       => $stats['failure'],
      ];
      return json_encode($data_result);

    }
  }

  public function sendCampaign($request, $response, $arg)
  {
    if($_POST['test'] != 0 && $_POST['test'] != -1)
      $url = 'http://fr.funizi.com/test/'.Helper::cleanUrl($_POST['title']).'/'.$_POST['test'].'?utm_source=notification&utm_medium=push&utm_campaign=funizi_push_notifitication_'.date("Y-m-d").'&utm_content=test_'.$_POST['test'];
    elseif($_POST['test'] == 0)
      $url = 'https://fr.funizi.com/games?utm_source=notification&utm_medium=push&utm_campaign=funizi_push_notifitication_'.date("Y-m-d").'&utm_content=game';
    elseif($_POST['test'] == -1)
      $url = 'https://fr.funizi.com/discover?utm_source=notification&utm_medium=push&utm_campaign=funizi_push_notifitication_'.date("Y-m-d").'&utm_content=discover_page';

    // Configure countries's filter
    $countries = json_decode($_POST['countries']);
    $countries_filter = array(); $data_countries = '';
    foreach ($countries as $country_code => $country_name) {
        $countries_filter []= $country_code;
        $data_countries .=  $country_code . ' ';
    }
    // Get subscribers to send campaign

    if(!isset($_POST['countries']) || $data_countries == '' )
      $subscriptions = NotificationSubscriptions::orderByRaw('RAND()')->take(1000)->get();
      //$subscriptions = NotificationSubscriptions::whereIn('id',[54,56,57,58])->get();
    else
      $subscriptions = NotificationSubscriptions::whereIn('country_code',$countries_filter)->orderByRaw('RAND()')->take(1000)->get();

    foreach ($subscriptions as $endpoint) {
      $registrationIds []= $endpoint->token;
    }
    // Prepare the bundle
    $msg = array
    (
        'notification'  =>  array(
          'title' =>  ' ',
          'body'  =>  ' ',
          'icon'  =>  ' ',
        )
    );

    $fields = array
    (
    	'registration_ids' 	=> $registrationIds,
    	'data'			=> $msg
    );

    $headers = array
    (
      'Authorization: key=' . 'AAAAgnRGv2I:APA91bGSxdHdJtNjKSRCSfd8PuPzcKkIokdLVroaSlprMpxdmbIShmdXf1C3Aj7mwyQqKQKGagGaaOUtAuZjaarG2-POmW7b7nmOdP9pVSbYBvjGz3dkPHVHTOt-Ozs4REbDd7B5euIC',
    	'Content-Type: application/json'
    );

    // Save campaign on DB
    try{
      $draft = NotificationCampaigns::where([['status','=','draft'],['created_by','=',$_COOKIE['id_user']],['test_id','=',$_POST['test']]])->firstOrFail();
      $notif = $draft->id;
      $data_update_a = [
          'test_id'       =>  $_POST['test'],
          'body'          =>  $_POST['body'],
          'icon'          =>  $_POST['icon'],
          'title'         =>  $_POST['title'],
          'countries'     =>  $data_countries,
          'url'           =>  $url,
          'nb_endpoints'  =>  count($registrationIds),
          'nb_success'    =>  0,
          'nb_fails'      =>  0
        ];
        NotificationCampaigns::where('id','=',$notif)->update($data_update_a);
    }catch(\Exception $e){
      $notif = NotificationCampaigns::insertGetId([
        'test_id'       =>  $_POST['test'],
        'body'          =>  $_POST['body'],
        'icon'          =>  $_POST['icon'],
        'title'         =>  $_POST['title'],
        'countries'     =>  $data_countries,
        'url'           =>  $url,
        'created_by'    =>  $_COOKIE['id_user'],
        'status'        =>  'draft',
        'nb_endpoints'  =>  count($registrationIds),
        'nb_success'    =>  0,
        'nb_fails'      =>  0,
        'created_at'    =>  \date("Y-m-d H:i:s"),
        'updated_at'    =>  \date("Y-m-d H:i:s")
      ]);
    }
    if($_POST['test'] != 0 && $_POST['test'] != -1)
      $new_url = 'http://fr.funizi.com/test/'.Helper::cleanUrl($_POST['title']).'/'.$_POST['test'].'?utm_source=notification&utm_medium=push&utm_campaign=funizi_push_notifitication_'.date("Y-m-d").'_'.$notif.'&utm_content=test_'.$_POST['test'];
    elseif($_POST['test'] == 0)
      $new_url = 'https://fr.funizi.com/games?utm_source=notification&utm_medium=push&utm_campaign=funizi_push_notifitication_'.date("Y-m-d").'&utm_content=game';
    elseif($_POST['test'] == -1)
      $new_url = 'https://fr.funizi.com/discover?utm_source=notification&utm_medium=push&utm_campaign=funizi_push_notifitication_'.date("Y-m-d").'&utm_content=discover_page';

    NotificationCampaigns::where('id','=',$notif)->update(['url'=>$new_url]);

    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch );
    curl_close( $ch );

    $stats = json_decode($result, true);
    $data_result = [
      'id_campaign'   => $notif,
      'success'       => $stats['success'],
      'failure'       => $stats['failure'],
    ];
    return json_encode($data_result);
  }


  public function saveStatsCampaign($request, $response, $arg)
  {
      $stats = json_decode($_POST['stats'],true);

      $data_update = [
        'status'        =>  'sent',
        'nb_success'    =>  $stats['success'],
        'nb_fails'      =>  $stats['failure']
      ];
      Helper::debug($data_update);

      NotificationCampaigns::where('id','=',$stats['id_campaign'])->update($data_update);
  }


}
