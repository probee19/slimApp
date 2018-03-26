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
use Psr7Middlewares\Middleware\ClientIp;
use GrabzItImageOptions;

class LangController extends Controller
{
  public function index($request, $response, $arg){

    //Helper::checkCookies();
    if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL){
      return $response->withStatus(302)->withHeader('Location', $request->getUri()->getBaseUrl());
    }
    $all_langs = Language::selectRaw('code, name, fr_name, status, translated')->orderByRaw('fr_name')->get();
    $active_langs = array();
    foreach ($all_langs as $lang) {
      # code...
      if($lang->status == 1 && $lang->code != "fr")
        $active_langs[] = [
          "code"      =>  $lang->code,
          "name"      =>  $lang->name,
          "fr_name"   =>  $lang->fr_name
        ];
    }
    $ui_translations = InterfaceUiTranslations::where("lang","fr")->get();
    $language = Helper::getLangBrowser();
    return $this->view->render($response, 'lang.twig', compact('all_langs','active_langs','ui_translations'));
  }

  public function updateLangConfig()
  {
    $langs = (array) json_decode($_POST['langs']);
    $langs_to_active = Language::whereIn('code',$langs)->get();

    foreach ($langs_to_active as $lang) {
        // Traduire l'interface pour cette langue
        if($lang->translated == 0)
            self::translateInterface($lang->code);
        // Activer cette langue
        Language::where('code',$lang->code)->update(['status' => 1, 'translated' => 1]);
    }
    // Desactiver les langues non choisies
    Language::whereNotIn('code',$langs)->update(['status' => 0]);
  }

  public function updateTranslations()
  {
    $translations = (array) json_decode($_POST['translations']);
    $lang = $_POST['lang'];
    Helper::debug($lang);
    Helper::debug($translations);
    foreach ($translations as $interface_ui_code => $interface_ui) {
        $maj = InterfaceUiTranslations::where([["lang","$lang"],["interface_ui_code",$interface_ui_code]])->update(['interface_ui' => $interface_ui]);
    }
  }

  public static function translateInterface($lang)
  {
      $interface_uis = InterfaceUi::all();
      foreach ($interface_uis as $ui) {
        if($lang == "fr")
          $new_label = $ui->default_label_name;
        else
          $new_label = Helper::GoogleTranslate($lang, $ui->default_label_name,"fr");

        $data = [
          "interface_ui_id"   => $ui->id,
          "interface_ui_code" => $ui->label_code,
          "interface_ui"      => $new_label,
          "lang"              => $lang
        ];
        $new = InterfaceUiTranslations::insertGetId($data);
      }
  }

  public static function translateTests($lang)
  {
    # code...
  }


  public static function translateOneTest($lang, $test)
  {
    # code...
  }


  public static function translateUi($ui_id, $ui_label_code, $ui_default_label_name)
  {
    $active_langs = Language::selectRaw('code, name')->where('status', 1)->get();
    foreach ($active_langs as $lang) {
        if($lang->code == "fr")
          $new_label = $ui_default_label_name;
        else
          $new_label = Helper::GoogleTranslate($lang->code, $ui_default_label_name,"fr");
        $data = [
          "interface_ui_id"   => $ui_id,
          "interface_ui_code" => $ui_label_code,
          "interface_ui"      => $new_label,
          "lang"              => $lang->code
        ];
        $new = InterfaceUiTranslations::insertGetId($data);
    }
  }

  // Obtenir les traductions des élémenets de l'interface en une langue
  public function showUi($request, $response, $arg)
  {
    $code_lang = $_GET['code'];
    $ui_translations = InterfaceUiTranslations::where("lang","$code_lang")->get();
    return $this->view->render($response, 'ajaxviews/showUiTranslations.twig', compact('ui_translations'));
  }


  public function addUi($request, $response, $arg)
  {
    $new_ui = [
      "label_code"            =>  $_POST['label_code'],
      "default_label_name"    =>  $_POST['default_label_name']
    ];
    $new_ui_id = InterfaceUi::insertGetId($new_ui);
    self::translateUi($new_ui_id, $new_ui["label_code"], $new_ui["default_label_name"]);
  }

  public function UpgradeJsonFile($request, $response, $arg)
  {
          $langs = Language::where([['status','=','1'],['translated','=','1']])->get();
          foreach ($langs as $lang) {
              $tests = Highlights::selectRaw('highlights.id_test AS id_test, highlights.statut AS statut, test_info.titre_test AS titre_test, highlights.url_image_test AS url_image_test, highlights.codes_countries AS codes_countries ')
                        ->join('test_info','test_info.id_test','highlights.id_test')
                        ->where([['highlights.statut','=','1'],['test_info.lang','=',$lang->code]])
                        ->get();
               echo '<pre>';
                var_dump($lang->code);
               echo '</pre>';
               echo '<pre>';
              //var_dump($tests->id_test);
              echo '</pre>';
            //  Helper::debug($tests);

              $all_tests = array();
              foreach ($tests as $test) {
                # code...
                $all_tests[] = [
                  "id_test"           => $test->id_test,
                  "id_theme"          => $test->id_theme,
                  "id_rubrique"       => $test->id_rubrique,
                  "statut"            => $test->statut,
                  "titre_test"        => stripslashes("$test->titre_test"),
                  "unique_result"     => $test->unique_result,
                  "url_image_test"    => $test->url_image_test,
                  "codes_countries"   => $test->codes_countries
                ];
              }
              $all_tests = json_encode($all_tests, JSON_PRETTY_PRINT);

              $json = fopen("ressources/views/json_files/".$lang->code."_highlights.json", "w+");

              fputs($json, $all_tests);
            }
    exit ;
  }

  // Création des informations générales dans la langue par défaut du test
  public function upgradeLang($request, $response, $args)
  {
    $tests = Test::where('if_translated','=','0')->get();
    //$data = array();
    foreach ($tests as $test) {
      $test_id = TestInfo::where('id_test','=',$test->id_test)->first();
      if(!$test_id)
        $data = [
          "id_test"       => $test->id_test,
          "titre_test"    => $test->titre_test,
          "test_description"  => $test->test_description,
          "lang"        => "fr"
        ];
        TestInfo::insert($data);
        echo '<pre>';
        print_r($test->id_test);
        echo '</pre>';
    }

    //TestInfo::insert($data);

    //Helper::debug($data);
    //echo count($tests);
    exit;

  }



}
