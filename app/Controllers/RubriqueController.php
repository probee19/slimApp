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

class RubriqueController extends Controller
{
    public function index($request, $response, $arg)
    {
        $url = $this->helper->detectLang($request, $response);
        if($url != "") return $response->withStatus(302)->withHeader('Location', $url );

        $lang = $this->helper->getLangSubdomain($request);

        $rubrique = $arg['rubrique'];
        $rubrique_name = $arg['name'];

        if($_GET['pays'] && $_GET['pays'] !=''){
            $country_code = strtoupper($_GET['pays']);
        }else{
            $helper = new Helper();
            $country_code = $helper->getCountryCode($request);
        }
        $helper = new Helper();

        if($_GET['utm'] && $_GET['utm'] !='')
            $helper->setUTM($_GET['utm'],"home");

        $helper = new Helper();
        $cookie = $helper->createCookie();

        $pagecount = $this->test_per_page;

        //
        if(isset($lang) && $lang!= 'fr'){
          $alltest = Test::on('reader')->where([
              ['if_translated', '=','1'],
              ['statut', '=','1'],
              ['id_rubrique', '=',$rubrique],
              ['codes_countries', 'LIKE', "%$country_code%"]
          ])->orWhere([
              ['if_translated', '=','1'],
              ['statut', '=','1'],
              ['id_rubrique', '=',$rubrique],
              ['codes_countries', '=', '']
          ])->count();
          $prefixe_page = $rubrique."_".$lang;
        }
        else {
          $alltest = Test::on('reader')->where([
              ['default_lang', '=', 'fr'],
              ['statut', '=', '1'],
              ['id_rubrique', '=',$rubrique],
              ['codes_countries', 'LIKE', "%$country_code%"]
          ])->orWhere([
              ['default_lang', '=', 'fr'],
              ['statut', '=', '1'],
              ['id_rubrique', '=',$rubrique],
              ['codes_countries', '=', '']
          ])->count();
          $prefixe_page = $rubrique."_fr";
        }
        $pagecount = intval(ceil($alltest/$pagecount));

        if($arg['pageid'])
          $pageid = $arg['pageid'];
        else
          $pageid = 1;
        $name_session_page = $prefixe_page.'_page_'.$pageid;

        if(isset($_SESSION[$name_session_page]) && !empty($_SESSION[$name_session_page]) ){
          $include = $_SESSION[$name_session_page];
          $tests = Test::on('reader')->selectRaw('tests.titre_test AS titre_test_fr, tests.id_test AS id_test, tests.url_image_test AS url_image_test, test_info.lang AS lang, test_info.titre_test AS titre_test')
                  ->join('test_info','test_info.id_test','tests.id_test')
                  ->where([['test_info.lang','=',$lang],['tests.id_rubrique', '=',$rubrique]])->whereIn('test_info.id_test', $include)->get()->sortBy(function($item, $index) use($include){
                    $arrayToSortBy = array_flip($include);
                    return $arrayToSortBy[$item->id_test];
                  });
        }
        else {
          if($alltest == count($_SESSION["seen"]) || $alltest <= count($_SESSION["seen"])) $_SESSION["seen"] = array();
          $exclude = array();
          if(isset($_SESSION['seen']))
            $exclude = $_SESSION['seen'];

          $tests = Test::on('reader')->selectRaw('tests.titre_test AS titre_test_fr, tests.id_test AS id_test, tests.url_image_test AS url_image_test, test_info.lang AS lang, test_info.titre_test AS titre_test')
                     ->join('test_info','test_info.id_test','tests.id_test')
                     ->where(function($q) use ($exclude, $country_code,$lang,$rubrique){ $q->where([['tests.statut', '=', '1'],['tests.id_rubrique', '=',$rubrique],['tests.codes_countries', 'LIKE', "%$country_code%"],['test_info.lang','=',$lang]])->whereNotIn('tests.id_test', $exclude); })
                     ->orWhere(function($q) use ($exclude,$lang,$rubrique){ $q->where([['tests.statut', '=', '1'],['tests.id_rubrique', '=',$rubrique],['tests.codes_countries', '=', ''],['test_info.lang','=',$lang]])->whereNotIn('tests.id_test', $exclude);  })
                     ->orderByRAw('RAND()')->take($this->test_per_page)->get();
           $page_tests = array();
           foreach ($tests as $test) {
             if(!in_array($test->id_test, $exclude, true)) array_push($exclude, $test->id_test);
             array_push($page_tests, $test->id_test);
           }
           $_SESSION['seen'] = $exclude;
           $_SESSION[$name_session_page] = $page_tests;

        }
        // Traduction des éléments de l'interface
        //$interface_ui = $this->helper->getUiLabels($this->helper->getLangSubdomain($request));
        $all_lang = $this->helper->getActivatedLanguages();
        $interface_ui = $this->helper->getUiLabels($lang);
        return $this->view->render($response, 'rubrique.twig', compact('lang', 'tests', 'rubrique', 'rubrique_name', 'pagecount', 'pageid', 'mode','interface_ui','all_lang'));
    }
}
