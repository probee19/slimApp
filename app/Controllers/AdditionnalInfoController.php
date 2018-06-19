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
use App\Models\AdditionnalInfos;
use App\Models\TestAdditionnalInfos;
use App\Models\TeamCDM;
use Psr7Middlewares\Middleware\ClientIp;
use GrabzItImageOptions;

class AdditionnalInfoController extends Controller
{
    public function index($request, $response, $arg)
    {
      $url = $this->helper->detectLang($request, $response);
      if($url != "") return $response->withStatus(302)->withHeader('Location', $url );

      $lang = $this->helper->getLangSubdomain($request);
      $interface_ui = $this->helper->getUiLabels($lang);

      $id_test = (int) $arg['id'];

      $test = TestInfo::where([['id_test','=',$id_test],['lang','=',$lang]])->first();

      $additionnal_infos = TestAdditionnalInfos::where([['id_test','=',$id_test],['lang','=',$lang]])->with('additionalInfos')->get();

      foreach ($additionnal_infos as $info) {
        if($info->additionalInfos->typeinput == 'gallery_fb_profile'){ // La sélection d'une image de profil est demandée
          $this->helper->debug($_SESSION['fb_access_token']);
          $photos_profile['photos'] = SandBox::getPhotosProfile($_SESSION['uid'], $_SESSION['fb_access_token']);
          $photos_profile['label'] = $info->label;
          $this->helper->debug($photos_profile['photos']);
        }
        elseif ($info->additionalInfos->typeinput == 'input_text') { // Un texte est demandé
          $input_text = [
            'label'     => $info->label,
          ];
        }
        elseif ($info->additionalInfos->typeinput == 'input_gender') { // Le genre de l'uitilisateur est demandé

          $input_gender = [
            'label'     => $info->label,
          ];
        }
        elseif ($info->additionalInfos->typeinput == 'team_wc') {
          // code...


          $teams = TeamCDM::all();

          foreach ($teams as $team) {
              $team_array []=[
                'cc'        =>  $team->cc,
                'french'    =>  $team->french,
                'english'   =>  $team->english,
                'flag'      =>  $this->storage_base."/api/flags_big/".$team->cc.".png"
              ];
          }
          $input_list_team = [
            'label'     =>  '',
            'teams'     => $team_array
          ];


        }
      }



      $country_code = $this->helper->getCountryCode();
      $exclude = [$id_test];
      if(!empty($_SESSION['uid'])){
          $testUser = User::where('facebook_id', '=', $_SESSION['uid'])
              ->with('usertests')->first();
          if(count($testUser->usertests) > 0)
            foreach($testUser->usertests as $user){
                $exclude [] = $user->test_id;
            }
      }

      $all_test = $this->helper->relatedTests($country_code, $exclude, $lang);

      //$all_test = $this->helper->relatedTests($country_code, $exclude, $lang);
      //User Id
      $id_user = 0;
      if(isset($_SESSION['uid']))
        $id_user = $_SESSION['uid'];

      // Traduction des éléments de l'interface
      $interface_ui = $this->helper->getUiLabels($lang);
      $all_lang = $this->helper->getActivatedLanguages();

      return $this->view->render($response, 'additionnalInfos.twig', compact('photos_profile', 'input_text', 'input_gender', 'input_list_team', 'id_test', 'test', 'lang', 'url', 'all_test', 'interface_ui', 'lang', 'all_lang'));

    }




}
