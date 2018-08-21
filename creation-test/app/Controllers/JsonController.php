<?php


namespace App\Controllers;


use App\Helpers\DBIP;
use App\Helpers\Helper;
use App\Models\Admin;
use App\Models\TestOwner;
use App\Models\Test;
use App\Models\Citation;
use App\Models\CitationInfo;
use App\Models\ThemePerso;
use App\Models\TestInfo;
use App\Models\User;
use App\Models\UserTest;
use App\Models\Countries;
use App\Models\Language;
use App\Models\Share;
use App\Models\Highlights;
use App\Models\InterfaceUi;
use App\Models\InterfaceUiTranslations;
use App\Models\PlayBuzz;
use Psr7Middlewares\Middleware\ClientIp;
use GrabzItImageOptions;

class JsonController extends Controller
{
  public function index($request, $response, $arg){


  }

  // Création des fichiers JSON des tests les plus partagés (%P > 25%) pour chaque langue activée
  public function setLovedTestJSON($request, $response, $arg){
    $start = date_create($_GET['start']);
    $start = date_format($start, 'Y-m-d H:i:s');
    $end = date_create($_GET['end']);
    $end = date_format($end, 'Y-m-d H:i:s');
    // Data For Best Tests
    $best_tests_col = UserTest::selectRaw('test_id, tests.default_lang AS default_lang, tests.if_translated AS if_translated, tests.codes_countries AS codes_countries, tests.url_image_test AS url_image_test, tests.unique_result AS unique_result, tests.statut AS statut, tests.id_theme AS id_theme, tests.id_rubrique AS id_rubrique, COUNT(users_tests.id) AS nb_test_done, COUNT(DISTINCT user_id) AS nb_test_unique_done, tests.titre_test AS titre_test')
          ->join('tests','tests.id_test','=','users_tests.test_id')
          ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"] ])
          ->groupBy('test_id')
          ->orderBy('test_id','ASC')
          ->get();

      $langs = Language::where([['status','=','1'],['translated','=','1']])->get();
      foreach ($langs as $lang) {
        $best_tests = array();
        foreach ($best_tests_col as $data_bests) {
          if($data_bests->if_translated == 1 || $data_bests->default_lang == $lang->code ){
              $best_shares_col = Share::selectRaw('SUM(shares.partages_count) AS nb_share, COUNT(DISTINCT shares.user_id, shares.test_id) AS nb_share_unique, test_info.titre_test AS titre_test')
                  ->join('test_info','test_info.id_test','=','shares.test_id')
                  ->where([['shares.created_at',">=","$start"], ['shares.created_at',"<=","$end"],['shares.test_id','=',$data_bests->test_id], ['test_info.lang','LIKE',"%$lang->code%"]])
                  ->groupBy('shares.test_id')
                  ->first();
              if(round(($best_shares_col->nb_share/$data_bests->nb_test_done*100), 2) >= 25){
                  $best_tests [] = [
                    "id_test"               =>  $data_bests->test_id,
                    "id_theme"              =>  $data_bests->id_theme,
                    "id_rubrique"           =>  $data_bests->id_rubrique,
                    "statut"                =>  $data_bests->statut,
                    "unique_result"         =>  $data_bests->unique_result,
                    "url_image_test"        =>  $data_bests->url_image_test,
                    "codes_countries"       =>  $data_bests->codes_countries,
                    "nb_test_done"          =>  $data_bests->nb_test_done,
                    "nb_test_unique_done"   =>  $data_bests->nb_test_unique_done,
                    "titre_test"            =>  $best_shares_col->titre_test,
                    "nb_share"              =>  intval($best_shares_col->nb_share),
                    "nb_share_unique"       =>  intval($best_shares_col->nb_share_unique),
                    "taux_share"            =>  round(($best_shares_col->nb_share/$data_bests->nb_test_done*100), 2),
                    "taux_share_unique"     =>  round(($best_shares_col->nb_share_unique/$data_bests->nb_test_unique_done*100), 2)
                  ];
              }
            }
          }
        $data_best_tests = Helper::array_msort($best_tests, array('taux_share'=>SORT_DESC, 'nb_test_done'=>SORT_DESC));
        $filepath = "../ressources/views/json_files/best_tests/".$lang->code."_best_tests.json";
        $json = fopen($filepath, "w+");
        $data_json = json_encode($data_best_tests, JSON_PRETTY_PRINT);
        fputs($json, $data_json);
        $this->helper->uploadToS3($filepath, 'json_files/best_tests/');
      }

      return 'Fichiers mis à jours avec succès!';
  }

  // Mise à jour des fichiers json des tests mis en avant pour chaque langue activée
  public function setHighlightsJSON($request, $response, $arg){
    //$lang = $_GET['lang'];
    $lang = "";
    if($lang != ""){
        $tests = Highlights::selectRaw('highlights.id_test AS id_test, highlights.statut AS statut, test_info.titre_test AS titre_test, highlights.url_image_test AS url_image_test, highlights.codes_countries AS codes_countries ')
                  ->join('test_info','test_info.id_test','highlights.id_test')
                  ->where([['highlights.statut','=','1'],['test_info.lang','=',$lang]])
                  ->get();

        $all_tests = array();
        foreach ($tests as $test) {
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

        $filepath = "../ressources/views/json_files/highlights/".$lang."_highlights.json";
        $json = fopen($filepath, "w+");
        fputs($json, $all_tests);
        $this->helper->uploadToS3($filepath, 'json_files/highlights/');
    }
    else {
      $langs = Language::where([['status','=','1'],['translated','=','1']])->get();
      foreach ($langs as $lang) {
        $tests = Highlights::selectRaw('highlights.id_test AS id_test, highlights.unique_result AS unique_result, highlights.id_theme AS id_theme, highlights.id_rubrique AS id_rubrique, highlights.statut AS statut, test_info.titre_test AS titre_test, highlights.url_image_test AS url_image_test, highlights.codes_countries AS codes_countries ')
                  ->join('test_info','test_info.id_test','highlights.id_test')
                  ->where([['highlights.statut','=',1],['test_info.lang','=',$lang->code]])
                  ->orderBy('highlights.id_test','DESC')
                  ->get();
        $all_tests = array();
        foreach ($tests as $test) {
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
        $filepath = "../ressources/views/json_files/highlights/".$lang->code."_highlights.json";
        $json = fopen($filepath, "w+");
        fputs($json, $all_tests);
        $this->helper->uploadToS3($filepath, 'json_files/highlights/');
      }
    }
    return 'Fichiers des tests promus mis à jours avec succès!';
  }

  // Création des fichiers JSON des tests les plus effectués pour chaque langue activée
  public function setLovedTestJSONForCountry($request, $response, $arg){
    //$start = date_create('2018-03-21');
    //$end = date_create('2018-06-06');
    $start = date_create($_GET['start']);
    $start = date_format($start, 'Y-m-d H:i:s');
    $end = date_create($_GET['end']);
    $end = date_format($end, 'Y-m-d H:i:s');

    $country_get = $_GET['cc'];

    // Data For Best Tests
      $tests = UserTest::selectRaw('users.country_code AS countryCode, tests.id_test AS test_id, tests.default_lang AS default_lang, tests.if_translated AS if_translated, tests.if_additionnal_info AS if_additionnal_info, tests.codes_countries AS codes_countries, tests.url_image_test AS url_image_test, tests.unique_result AS unique_result, tests.statut AS statut, tests.id_theme AS id_theme, tests.id_rubrique AS id_rubrique, tests.titre_test AS titre_test, COUNT(users_tests.id) AS nb_test_done, COUNT(DISTINCT user_id) AS nb_test_unique_done')
        ->join('users','users.id','=','users_tests.user_id')
        ->join('tests','tests.id_test','=','users_tests.test_id')
        ->where([['users_tests.created_at',">=","$start"],['users_tests.created_at',"<=","$end"],['users.country_code','=',$country_get]])
        ->groupBy('users_tests.test_id')
        ->orderBy('nb_test_done','DESC')
        ->get();

      $langs = Language::where([['status','=','1'],['translated','=','1']])->get();
      foreach ($langs as $lang) {
        $most_tested = []; $nb_test_total = 0;
        foreach ($tests as $test) {
          if($test->if_translated == 1 || $test->default_lang == $lang->code ){
            $info_test = TestInfo::where([['id_test','=',$test->test_id],['lang','=',$lang->code]])->first();
            $most_tested [] = [
              "id_test"               =>  $test->test_id,
              "id_theme"              =>  $test->id_theme,
              "id_rubrique"           =>  $test->id_rubrique,
              "statut"                =>  $test->statut,
              "unique_result"         =>  $test->unique_result,
              "if_translated"         =>  $test->if_translated,
              "url_image_test"        =>  $test->url_image_test,
              "unique_result"         =>  $test->unique_result,
              "if_additionnal_info"   =>  $test->if_additionnal_info,
              "codes_countries"       =>  $test->codes_countries,
              "nb_test_done"          =>  $test->nb_test_done,
              "nb_test_unique_done"   =>  $test->nb_test_unique_done,
              "titre_test"            =>  $info_test->titre_test,
            ];
          }
          $nb_test_total += $test->nb_test_done;
          $country = $test->countryCode;
        }
        $filepath = "../ressources/views/json_files/countries/".$lang->code."_".$country."_most_tested.json";
        $json = fopen($filepath, "w+");
        $data_json = json_encode($most_tested, JSON_PRETTY_PRINT);
        fputs($json, $data_json);
        $this->helper->uploadToS3($filepath, 'json_files/countries/');
      }
      $this->helper->debug(count($tests));
      return 'Fichiers mis à jours avec succès!';
  }
  // Mise à jour des fichiers Json la liste des tests pour chaque langue activée
  public function setTestsJSON($request, $response, $arg){
    $langs = Language::where([['status','=','1'],['translated','=','1']])->get();
    foreach ($langs as $lang) {
      $tests = Test::selectRaw('tests.id_test AS id_test, tests.permissions AS permissions, tests.if_additionnal_info AS if_additionnal_info, tests.has_treatment AS has_treatment, tests.id_theme AS id_theme, tests.default_lang AS default_lang, tests.if_translated AS if_translated, tests.id_rubrique AS id_rubrique, tests.statut AS statut, test_info.titre_test AS titre_test, test_info.test_description AS test_description, tests.unique_result AS unique_result, tests.url_image_test AS url_image_test, tests.codes_countries AS codes_countries')
            ->join('test_info','test_info.id_test','tests.id_test')
            ->where([['tests.statut','!=',-1],['test_info.lang','=',$lang->code]])
            ->orderBy('tests.id_test','DESC')
            ->get();
      $all_tests = array();
      foreach ($tests as $test) {
        $all_tests[] = [
          "id_test"               => $test->id_test,
          "id_theme"              => $test->id_theme,
          "id_rubrique"           => $test->id_rubrique,
          "statut"                => $test->statut,
          "permissions"           => $test->permissions,
          "if_translated"         => $test->if_translated,
          "if_additionnal_info"   => $test->if_additionnal_info,
          "has_treatment"         => $test->has_treatment,
          "default_lang"          => $test->default_lang,
          "titre_test"            => stripslashes("$test->titre_test"),
          "test_description"      => stripslashes("$test->test_description"),
          "unique_result"         => $test->unique_result,
          "url_image_test"        => $test->url_image_test,
          "codes_countries"       => $test->codes_countries
        ];
      }
      $all_tests = json_encode($all_tests, JSON_PRETTY_PRINT);
      $filepath = "../ressources/views/json_files/all_tests/".$lang->code."_all_test_2.json";
      $json = fopen($filepath, "w+");
      fputs($json, $all_tests);
      $this->helper->uploadToS3($filepath, 'json_files/all_tests/');

    }
    return "Mise à jours des fichiers effectuée !";
  }

  // Mise à jour des fichiers Json la liste des citations pour chaque langue activée
  public function setQuotesJSON($request, $response, $arg){
    $langs = Language::where([['status','=','1'],['translated','=','1']])->get();
    foreach ($langs as $lang) {
      $citations_col = CitationInfo::where('lang', '=',$lang->code)->with('citationInfos')->get();
      $all_quotes = [];
      foreach ($citations_col as $citation) {
        if($citation->citationInfos->statut == 1)
          $all_quotes[] = [
            'id_citation'           =>  $citation->id_citation,
            'titre_citation'        =>  $citation->titre_citation,
            'url_image_citation'    =>  $citation->url_image_citation,
            'url_thumb_img_citation'=>  $citation->url_thumbnail_citation,
            "default_lang"          =>  $citation->citationInfos->default_lang,
            "if_translated"         =>  $citation->citationInfos->if_translated,
            "if_personalizable"     =>  $citation->citationInfos->if_personalizable,
            "id_rubrique"           =>  $citation->citationInfos->id_rubrique,
            "statut"                =>  $citation->citationInfos->statut,
            "codes_countries"       =>  $citation->citationInfos->codes_countries
          ];
      }
      $all_quotes = json_encode($all_quotes, JSON_PRETTY_PRINT);
      $this->helper->debug($all_quotes);

      $filepath = "../ressources/views/json_files/all_quotes/".$lang->code."_all_quotes.json";
      $json = fopen($filepath, "w+");
      fputs($json, $all_quotes);
      $this->helper->uploadToS3($filepath, 'json_files/all_quotes/');
    }
  }

  public function setPlayBuzzJSON($request, $response, $arg){
    $langs = Language::where([['status','=','1'],['translated','=','1']])->get();
    foreach ($langs as $lang) {
      $citations_col = PlayBuzz::where('default_lang', '=',$lang->code)->get();
      $all_playbuzz = [];
      foreach ($playbuzz_col as $playbuzz) {
        if($playbuzz->statut == 1)
          $all_playbuzz[] = [
            'id_playbuzz'           =>  $playbuzz->id_playbuzz,
            'titre_playbuzz'        =>  $playbuzz->titre_playbuzz,
            'url_image_playbuzz'    =>  $playbuzz->url_image_playbuzz,
            "default_lang"          =>  $playbuzz->default_lang,
            "statut"                =>  $playbuzz->statut,
            "codes_countries"       =>  $playbuzz->codes_countries,
            "code_playbuzz"         =>  $playbuzz->code_playbuzz,
            "id_rubrique"           =>  $playbuzz->id_rubrique,
          ];
      }
      $all_playbuzz = json_encode($all_playbuzz, JSON_PRETTY_PRINT);
      $this->helper->debug($all_playbuzz);

      $filepath = "../ressources/views/json_files/all_playbuzz/".$lang->code."_all_playbuzz.json";
      $json = fopen($filepath, "w+");
      fputs($json, $all_quotes);
      $this->helper->uploadToS3($filepath, 'json_files/all_playbuzz/');
    }
  }


  public function setLangsJson($request, $response, $arg)
  {
    $lang_col = Language::all();
    $all_lang = [];
    foreach ($lang_col as $lang) {
        $all_lang [] = [
          "id"          =>  $lang->id,
          "code"        =>  $lang->code,
          "name"        =>  $lang->name,
          "fr_name"     =>  $lang->fr_name,
          "status"      =>  $lang->status,
          "translated"  =>  $lang->translated,
          "test_count"  =>  $lang->test_count,
          "created_at"  =>  $lang->created_at,
          "updated_at"  =>  $lang->updated_at
        ];
    }
    $all_lang = json_encode($all_lang, JSON_PRETTY_PRINT);
    $this->helper->debug($all_lang);

    $filepath = "../ressources/views/json_files/all_languages/all_lang.json";
    $json = fopen($filepath, "w+");
    fputs($json, $all_lang);
    $this->helper->uploadToS3($filepath, 'json_files/all_languages/');
  }

}
