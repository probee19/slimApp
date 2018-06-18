<?php


namespace App\Controllers;


use App\Helpers\DBIP;
use App\Helpers\Helper;
use App\Helpers\Browser;
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

  }
    /**
  * @URL register-to-notification
  * Associe un utilisateur à un endpoint de Push Server
  */
  public function registerToNotification($request, $response, $arg){
    $lang = $this->helper->getLangSubdomain($request);
    $country_code = $this->helper->getCountryCode($request);
    $browser = new Browser();
    $navigateur = $browser->getBrowser();

    $token = $_POST['subscription'];
    try{
      $test_token = NotificationSubscriptions::where('token','=',$token)->firstOrFail();
    }catch(\Exception $e){
      NotificationSubscriptions::create([
        'browser'         =>  "$navigateur" ,
        'country_code'    =>  "$country_code" ,
        'lang'            =>  "$lang" ,
        'token'           =>  "$token" ,
        'created_at'      =>  \date("Y-m-d H:i:s"),
        'updated_at'      =>  \date("Y-m-d H:i:s")
      ]);
    }
  }

  public function getNotification($request, $response, $arg)
  {
    $test = NotificationCampaigns::where('status','=','sent')->orWhere('nb_endpoints','=',1)->orderBy('id','DESC')->first();

    $data = array(
      'body'        =>  $test->body,
      'icon'        =>  $test->icon,
      'title'       =>  $test->title,
      'clickUrl'    =>  $test->url,
    );

    return json_encode($data);
  }

  public function saveErrorNotification($request, $response, $arg)
  {

    $data_array = json_decode($_POST['err'], true);
    if($data_array['code'] == "messaging/permission-blocked"){
      $file = file_get_contents("ressources/views/error-notification.txt");
      $count = intval($file);
      $log = fopen("ressources/views/error-notification.txt", "w+");
      $count = $count +1;
      fputs($log, $count);
    }

    $log2 = fopen("ressources/views/error-notification2.txt", "a+");

    $data_log = "\n".date('H:i:s')." Erreur: ".$data_array['code']."\n";
    fputs($log2, $data_log);

  }

}
