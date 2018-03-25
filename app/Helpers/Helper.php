<?php
/**
 * Created by PhpStorm.
 * User: probee
 * Date: 31/08/2017
 * Time: 14:36
 */

namespace App\Helpers;

use App\Helpers\DBIP;
use App\Helpers\Browser;
use App\Helpers\RandomStringGenerator;
use App\Models\Test;
use App\Models\User;
use App\Models\UserTest;
use App\Models\Highlights;
use App\Models\Visitors;
use App\Models\Countries;
use App\Models\PageTrackings;
use App\Models\Language;
use App\Models\InterfaceUi;
use App\Models\InterfaceUiTranslations;
use App\Models\TestInfo;

class Helper
{
    public static function getCountry($ip){
        if(isset($_COOKIE['countryCode']) && isset($_COOKIE['countryName'])){
            $country = [
                'countryName'   =>  $_COOKIE['countryName'],
                'countryCode'   =>  $_COOKIE['countryCode']
            ];
            //return $country;
        }

        // Instanciate a new DBIP object with the database connection
        // Instanciate a new DBIP object with the database connection
        $db = new \PDO("mysql:host=". $_SERVER['RDS_HOSTNAME'] .";dbname=". $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD']);
        $dbip = new DBIP($db);



        $inf = $dbip->Lookup($ip);
        //self::debug($inf);

        if($inf){
            $countryBD = Countries::where('alpha2', '=', "$inf->country")->first();
            $countryCode = $inf->country;
            $countryname = $countryBD->langFR;
            setcookie("countryCode", $countryCode, time()+3600*24*30);
            setcookie("countryName", $countryname, time()+3600*24*30);
        }
        else {
            $data = json_decode(file_get_contents('http://geoplugin.net/json.gp?ip='.$ip));
            $countryname = $data->geoplugin_countryName;
            $countryCode = $data->geoplugin_countryCode;
            if($data){
                setcookie("countryCode", $countryCode, time()+3600*24*30);
                setcookie("countryName", $countryname, time()+3600*24*30);
            }
        }


        $country = [
            'countryName'   =>  $countryname,
            'countryCode'   =>  $countryCode
        ];
        //self::debug($country);

        return $country;
    }

    public static function debug($var){
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }

    public static function cleanUrl($url){
        $transliterationTable = ['á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja'];
        $url = str_replace(array_keys($transliterationTable), array_values($transliterationTable), $url);

        $url = str_replace(' ', '-', $url); // Replaces all spaces with hyphens.
        $url = preg_replace('/[^A-Za-z0-9\-]/', '', $url); // Removes special chars.
        $url = strtolower(trim($url, '-'));
        return preg_replace('/-+/', '-', $url);
    }

    public function getCountryCode(){
        $country = self::getCountry($this->getRealUserIp());
        return $country['countryCode'];
    }

    public function createCookie(){
        //Generate unique code number for the cookie's visitor
        $stringen = new RandomStringGenerator(implode(range(0, 9)));
        $code = $stringen->generate(15);
        $cookie = null;
        if(!isset($_COOKIE["visitor"]) || $_COOKIE["visitor"]==""){
            setcookie("visitor", $code, time()+86400);

            $browser = new Browser();
            $navigateur = $browser->getBrowser();

            $data = [
                'cookie_code'     =>   "$code",
                'ip_address'      =>   $this->getRealUserIp(),
                'browser'         =>   "$navigateur",
                'country_code'    =>   $this->getCountryCode()
            ];


            $cookie = Visitors::create($data);
        }

        //return $data;
    }

    public static function getUrlTest($titre_test, $id, $lang)
    {
      if($lang == 'ar'){
        $test_info = TestInfo::where([['id_test','=',$id],['lang','=','en']])->first();
        return $test_info->titre_test;
      }
      else
        return $titre_test;

    }

    public function setUTM($utm, $page, $test = 0){
        if($utm && $utm !=''){
            $data_utm = [
                "utm"    => $utm,
                "page"   => $page,
                "test_id"   => $test
            ];
            $set_utm = PageTrackings::create($data_utm);
        }
    }

    public function getRelatedTest($request, $id, $user, $limit, $insight_theme = null){
        $tested = [$id];
        $count = 0;
        $countryCode = $this->getCountryCode($request);
        $test = Test::where('id_test', '=', $id)->first();
        //self::debug($test);
        $testUser = User::where('facebook_id', "$user")->with('usertests')->first();
        //self::debug($testUser->usertests);
        foreach($testUser->usertests as $user){
            $tested [] = $user->test_id;
        }
        if($insight_theme != null){
            $hightlights = Test::where('id_theme', '=', $insight_theme)->select('id_test', 'titre_test', 'url_image_test')->get();
            $count = Test::where('id_theme', '=', $insight_theme)->count();
            self::debug($hightlights);
            foreach ($hightlights as $highlight){
                $tested [] = $highlight->id_test;
            }
        }
        $take = $limit - $count;
        if($take > 0){
            $all_test = Test::where([
                    ['statut', '=', '1'],
                    ['codes_countries', '=', '']
                ]
            )->orWhere([
                ['statut', '=', '1'],
                ['codes_countries', 'LIKE', "%$countryCode%"]
            ])->orWhere([
                ['statut', '=', '1'],
                ['codes_countries', 'LIKE', "%$test->codes_countries%"]
            ])->whereNotIn('id_test', $tested)->orderByRaw('RAND()')->take($take)->select('id_test', 'titre_test', 'url_image_test')->get();
        }
        self::debug($all_test);
        $all_test = array_merge($hightlights, $all_test);

        self::debug($all_test);
        $tests = [];
        /*self::debug($tested);
        foreach($all_test as $test){
            $tests [] = $test->id_test;
        }
        self::debug($tests);*/

    }

    public function getRealUserIp($default = NULL, $filter_options = 12582912) {
        $HTTP_X_FORWARDED_FOR = getenv('HTTP_X_FORWARDED_FOR');
        $HTTP_CLIENT_IP = getenv('HTTP_CLIENT_IP');
        $HTTP_CF_CONNECTING_IP = getenv('HTTP_CF_CONNECTING_IP');
        $REMOTE_ADDR = isset($_SERVER)?$_SERVER["REMOTE_ADDR"]:getenv('REMOTE_ADDR');
        //$ip = filter_var($REMOTE_ADDR, FILTER_VALIDATE_IP, $filter_options);

        $all_ips = explode(",", "$HTTP_X_FORWARDED_FOR,$HTTP_CLIENT_IP,$HTTP_CF_CONNECTING_IP,$REMOTE_ADDR");
        foreach ($all_ips as $ip) {
            if ($ip = filter_var($ip, FILTER_VALIDATE_IP, $filter_options))
                break;
        }
        return $ip?$ip:$default;
    }

    public function getRelatedCountryTest($countryCode, $exclude, $count){
        $relatedCountryTests = Test::where([
            ['statut', '=', '1'],
                ['codes_countries', 'like', "%$countryCode%"]
        ]
            )->whereNotIn('id_test', $exclude)
            ->orderByRaw('RAND()')
            ->select('url_image_test', 'id_test', 'titre_test')
            ->take($count)
            ->get();

        return $relatedCountryTests;
    }

    public function getRelatedThemeTest($theme_id, $countryCode, $exclude, $count){
        $relatedThemeTests = Test::whereNotIn('id_test', $exclude)
            ->where([
                    ['statut', '=', '1'],
                    ['id_theme', '=', "$theme_id"],
                    ['codes_countries', 'like', "%$countryCode%"]
                ]
        )
            ->orWhere([
                    ['statut', '=', '1'],
                    ['id_theme', '=', "$theme_id"],
                    ['codes_countries', 'like', ""]
                ]
            )
            ->orderByRaw('RAND()')
            ->select('url_image_test', 'id_test', 'titre_test')
            ->take($count)
            ->get();

        return $relatedThemeTests;
    }

    public function getRandomTest($exclude, $count){
        $randomTests = Test::where([
                ['statut', '=', '1'],
                ['codes_countries', '=', '']
        ])->whereNotIn('id_test', $exclude)
            ->orderByRaw('RAND()')
            ->take($count)
            ->select('url_image_test', 'id_test', 'titre_test')
            ->get();

        return $randomTests;
    }

    public function relatedTests($countryCode, $exclude, $lang, $total = 24){
        $alltests= []; $besttests= []; $new_tests = [];
        // Selection d'un test parmi les 5 denières créations
        $new_tests = self::getLastTests($countryCode, $exclude, $lang, 5);

        $choosen_new_tests_1 = array_slice($new_tests, 0, 1);
        foreach ($choosen_new_tests_1 as $new_test)
          $exclude[] = $new_test['id_test'];

        $choosen_new_tests_2 = array_slice($new_tests, 1, 2);
        foreach ($choosen_new_tests_2 as $new_test)
          $exclude[] = $new_test['id_test'];


        $local_tests = self::getLocalTests($countryCode, $exclude, $lang, 5);
        if(count($local_tests) > 0)
          $choosen_local_tests_1 = array_slice($local_tests, 0, 1);
        else
          $choosen_local_tests_1 = array();

        foreach ($choosen_local_tests_1 as $local_test)
          $exclude[] = $local_test['id_test'];
        //Helper::debug($choosen_local_tests_1);

        // Selection de 6 tests parmi les meilleurs partages sur les 7 dernires jours
        $alltests0 = self::getLovedTests($countryCode, $exclude, $lang, 6);
        foreach ($alltests0 as $test) {
          $besttests [] = [
            'url_image_test' => $test["url_image_test"],
            'id_test'        => $test["id_test"],
            'titre_test'     => $test["titre_test"]
          ];
          $exclude[] = $test["id_test"];
        }
        shuffle($besttests);
        $besttests   = array_merge($choosen_new_tests_1, $besttests);

        $besttests   = array_merge($besttests, $choosen_new_tests_2);

        $besttests   = array_merge($besttests, $choosen_local_tests_1);

        // Selection de tests mis en avant pour completer la liste des tests à découvrir
        $alltests2 = self::getHighlightsFromJson($lang);
        foreach ($alltests2 as $test) {
          // Si le test n'est pas dans les exclus ($exclude) et est soit un test universel ou local
          if(!in_array($test["id_test"], $exclude, true) && ($test["codes_countries"] == "" || strpos($test["codes_countries"], $countryCode) != false))
            $alltests [] = [
                'url_image_test' => $test["url_image_test"],
                'id_test'        => $test["id_test"],
                'titre_test'     => $test["titre_test"]
            ];
        }
        shuffle($alltests);

        $alltests   = array_merge($besttests, $alltests);
        $alltests_total = array_slice($alltests, 0, $total);

        return $alltests_total;
    }

    public function relatedTests_test($countryCode, $exclude, $lang, $total = 24){
          // Bests Tests to discover
          //$best_test = array(256,254,249,165,207,171,240,251);
          /*
          $best_test = array(281,280,278,274,256,254,249,165,240,251);
          $alltests0 = Test::selectRaw('tests.titre_test AS titre_test_fr, tests.id_test AS id_test, tests.url_image_test AS url_image_test, test_info.lang AS lang, test_info.titre_test AS titre_test')
                    ->join('test_info','test_info.id_test','tests.id_test')
                    ->where('test_info.lang','=',$lang)
                    ->whereNotIn('tests.id_test', $exclude)
                    ->whereIn('tests.id_test',$best_test)->get();
          $exclude   = array_merge($exclude, $best_test);
          */
          //Helper::debug($lang);
          //Helper::debug($exclude);
          //Helper::debug($alltests0);
          // Bests Tests to discover

          $alltests= []; $besttests= []; $new_tests = [];
          // Selection d'un test parmi les 5 denières créations
          $alltests1 = Test::selectRaw('tests.titre_test AS titre_test_fr, tests.id_test AS id_test, tests.url_image_test AS url_image_test, test_info.lang AS lang, test_info.titre_test AS titre_test')
              ->join('test_info','test_info.id_test','tests.id_test')
              ->where([['test_info.lang','=',$lang],['tests.statut','=',1],['tests.codes_countries', 'like', "%$countryCode%"]])
              ->orwhere([['test_info.lang','=',$lang],['tests.statut','=',1],['tests.codes_countries', 'like', ""]])
              ->whereNotIn('tests.id_test', $exclude)
              ->orderBy('tests.created_at','DESC')
              ->take(5)->get();
              $alltests= []; $besttests= []; $new_tests = [];

          foreach ($alltests1 as $new_test) {
            $new_tests[] = [
              'url_image_test' => $new_test->url_image_test,
              'id_test'        => $new_test->id_test,
              'titre_test'     => $new_test->titre_test
            ];
            $exclude[] = $new_test->id_test;
          }
          shuffle($new_tests);
          $choosen_new_tests_1 = array_slice($new_tests, 0, 1);

          // Selection de 6 tests parmi les meilleurs partages sur les 7 dernires jours
          $alltests0 = self::getLovedTests($countryCode, $exclude, $lang, 6);

          foreach ($alltests0 as $test) {
            $besttests [] = [
              'url_image_test' => $test["url_image_test"],
              'id_test'        => $test["id_test"],
              'titre_test'     => $test["titre_test"]
            ];
            $exclude[] = $test["id_test"];
          }
          shuffle($besttests);
          $besttests   = array_merge($choosen_new_tests_1, $besttests);

          $choosen_new_tests_2 = array_slice($new_tests, 1, 2);

          $besttests   = array_merge($besttests, $choosen_new_tests_2);

          // Selection de tests mis en avant pour completer la liste des tests à découvrir
          $alltests2 = self::getHighlightsFromJson($lang);
          foreach ($alltests2 as $test) {
            // Si le test n'est pas dans les exclus ($exclude) et est soit un test universel ou local
            if(!in_array($test["id_test"], $exclude, true) && ($test["codes_countries"] == "" || strpos($test["codes_countries"], $countryCode) != false))
              $alltests [] = [
                  'url_image_test' => $test["url_image_test"],
                  'id_test'        => $test["id_test"],
                  'titre_test'     => $test["titre_test"]
              ];
          }
          shuffle($alltests);

          $alltests   = array_merge($besttests, $alltests);
          $alltests_total = array_slice($alltests, 0, $total);

          return $alltests_total;
    }

    public function relatedTests2($countryCode, $exclude, $total = 24, $debug = false){
        $alltests1 = Highlights::whereNotIn('id_test', $exclude)
            ->where([
                    ['statut', '=', '1'],
                    ['codes_countries', 'like', "%$countryCode%"]
                ]
            )
            ->select('url_image_test', 'id_test', 'titre_test')
            ->take($total)
            ->get();

        $alltests2 = Highlights::whereNotIn('id_test', $exclude)
            ->where([
                    ['statut', '=', '1'],
                    ['codes_countries', 'like', ""]
                ]
            )
            ->select('url_image_test', 'id_test', 'titre_test')
            ->take($total)
            ->get();

        $alltests= [];

        foreach ($alltests1 as $test) {
           $alltests [] = [
               'url_image_test' => $test->url_image_test,
               'id_test'        => $test->id_test,
               'titre_test'     => $test->titre_test
           ];
        }
        foreach ($alltests2 as $test) {
           $alltests [] = [
               'url_image_test' => $test->url_image_test,
               'id_test'        => $test->id_test,
               'titre_test'     => $test->titre_test
           ];
        }
        $alltests_total = array_slice($alltests, 0, $total);
        foreach ($alltests_total as $oneTest) {
            Test::where('id_test', '=', $oneTest['id_test'])->increment('affichage_discover_count');
        }
        shuffle($alltests_total);



        return $alltests_total;

    }

    public static function getLovedTests($countryCode, $exclude, $lang, $total = 3){
      $file = "ressources/views/json_files/best_tests/".$lang."_best_tests.json";
      $jsondata = file_get_contents($file);
      $arr_data = json_decode($jsondata);
      $alltests = array();

      foreach ($arr_data as $test)
        if(($test->codes_countries == "" || strpos($test->codes_countries, $countryCode) != false ) && !in_array($test->id_test, $exclude, true) )
          $alltests [$test->id_test] = [
            "id_test"           => $test->id_test,
            "id_theme"          => $test->id_theme,
            "id_rubrique"       => $test->id_rubrique,
            "statut"            => $test->statut,
            "titre_test"        => stripslashes("$test->titre_test"),
            "unique_result"     => $test->unique_result,
            "url_image_test"    => $test->url_image_test,
            "codes_countries"   => $test->codes_countries
          ];
      if(count($alltests) > 0)
        shuffle($alltests);
      $alltests_total = array_slice($alltests, 0, $total);

      return $alltests_total;
    }

    // Obtention des derniers tests créés
    public static function getLastTests($countryCode, $exclude, $lang, $total = 5){
      // Récuperation des tests pour langue $lang;
      $tests_from_json = self::getAllTestJson($lang);
      krsort($tests_from_json);
      $nb_taken = 0;
      foreach ($tests_from_json as $test) {
        if(!in_array($test['id_test'], $exclude, true) && ($test['codes_countries'] == "" || strpos($test['codes_countries'], $countryCode) != false ) && ++$nb_taken <= $total){
          $tests[$test['id_test']] = [
            'url_image_test' => $test['url_image_test'],
            'id_test'        => $test['id_test'],
            'titre_test'     => $test['titre_test']
          ];
        }
      }
      shuffle($tests);
      return $tests;
    }

    // Initialisation des variables sessions nécessaires pour la gestion des langues
    public static function initSessionsLang($lang){
      $_SESSION['lang'] = $lang;
      $_SESSION['lang_LANG'] = $lang.'_'.strtoupper($lang);

    }

    // Obtention des tests locaux
    public static function getLocalTests($countryCode, $exclude, $lang, $total = 5)
    {
    	$tests = [];
      // Récuperation des tests pour langue $lang;
      $tests_from_json = self::getAllTestJson($lang);
      //krsort($tests_from_json);
      $nb_taken = 0;
      foreach ($tests_from_json as $test) {
        if(!in_array($test['id_test'], $exclude, true) && (strpos($test['codes_countries'], $countryCode) != false ) && ++$nb_taken <= $total){
          $tests[$test['id_test']] = [
            'url_image_test' => $test['url_image_test'],
            'id_test'        => $test['id_test'],
            'titre_test'     => $test['titre_test']
          ];
        }
      }
      if(count($tests) > 0)
        shuffle($tests);
      return $tests;
    }
    // Obtention des noms des éléments de l'interface dans la langue choisie
    public static function getUiLabels($lang=""){
      $language = self::getLangBrowser($lang);
      $labels = InterfaceUiTranslations::selectRaw("interface_ui_code,interface_ui")->where("lang",$language)->get();
      $data = [ ];
      $data ["code_lang"] = $lang;

      $data ["lang"] = $lang.'_'.strtoupper($lang);
      foreach ($labels as $label) {
        $data[$label->interface_ui_code] = $label->interface_ui;
      }
      $log_data = self::logUsersFromPeru('PE');
      return $data;

    }
    // Obtention de la liste des langues activées
    public static function getActivatedLanguages()
    {
      $all_lang = Language::where('status','=',1)->get();
      return $all_lang;
    }
    // Obtention de la langue par défaut du Navigateur
    public static function getLangBrowser($lang=""){
      if($lang == ""){
        $language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $language = $language{0}.$language{1};
      }
      else {
        $language = $lang;
      }

      $language_info = Language::selectRaw("status")->where("code",$language)->first();
      if(isset($language_info->status) &&  $language_info->status == 0)
        $language = "en";
      return $language;
    }

    public static function logUsersFromPeru($lang=""){
        //Generate unique code number for the cookie's visitor
        $helper = new Helper();
        $country_code = $helper->getCountryCode();
        $data = array();
        if($country_code == $lang){
          $stringen = new RandomStringGenerator(implode(range(0, 9)));
          $code = $stringen->generate(15);

          $browser = new Browser();
          $navigateur = $browser->getBrowser();

          $data = [
              'cookie_code'     =>   "$code",
              'ip_address'      =>   $helper->getRealUserIp(),
              'browser'         =>   "$navigateur",
              'country_code'    =>   $helper->getCountryCode()
          ];
          $log = fopen("ressources/views/log_peru_users.txt", "a+");

          $data_log = "\n".date('d/m/Y H:i:s')." -> IP : ".$data['ip_address']."\n";
          $data_log .= "Browser : ".$data['browser']."\n";
          $data_log .= "country_code : ".$data['country_code']."\n";
          fputs($log, $data_log);
        }

        return $data;
    }

    public static function getLangSubdomain($request){
      $host = $request->getUri()->getHost();
      //  Helper::debug($_SERVER['REQUEST_URI']);

      $lang = str_replace("www","",$host);
      $lang = str_replace("funizi.com","",$lang);
      $lang = str_replace(".","",$lang);
      return $lang;
    }

    public static function detectLang($request, $response){
      //$host = $request->getUri()->getHost();
      $server = $_SERVER["HTTP_X_FORWARDED_PROTO"];
      $lang = self::getLangSubdomain($request);
      if($lang == "" || $server === 'http'){
          if($lang == "")
            $lang = self::getLangBrowser();
        $url = "https://".$lang.".funizi.com".$_SERVER['REQUEST_URI'];
        //$url = "https://".$lang.".weasily.com".$_SERVER['REQUEST_URI'];
        return $url;
      }
      return "";
    }

    public static function getTestFromJson($file = "ressources/views/all_test.json"){
      //Get data from existing json file
  	   $jsondata = file_get_contents($file);
  	   // converts json data into array
  	   $arr_data = json_decode($jsondata);
       $alltest = array();
       foreach ($arr_data as $test) {
         # code...
         $alltest [$test->id_test] = [
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

       return $alltest;
    }

    public static function getAllTestJson($lang){
      //Get data from existing json file
      $file = "ressources/views/json_files/all_tests/".$lang."_all_test.json";
  	  $jsondata = file_get_contents($file);
  	   // converts json data into array
  	   $arr_data = json_decode($jsondata);
       $alltest = array();
       foreach ($arr_data as $test) {
         # code...
         $alltest [$test->id_test] = [
           "id_test"           => $test->id_test,
           "id_theme"          => $test->id_theme,
           "id_rubrique"       => $test->id_rubrique,
           "statut"            => $test->statut,
           "if_translated"     => $test->if_translated,
           "default_lang"      => $test->default_lang,
           "titre_test"        => stripslashes("$test->titre_test"),
           "unique_result"     => $test->unique_result,
           "url_image_test"    => $test->url_image_test,
           "codes_countries"   => $test->codes_countries
         ];
       }

       return $alltest;
    }

    public static function getHighlightsFromJson($lang){
      //Get data from existing json file
  	   $jsondata = file_get_contents("ressources/views/json_files/highlights/".$lang."_highlights.json",true);
  	   // converts json data into array
  	   $arr_data = json_decode($jsondata);
       $alltest = array();
       foreach ($arr_data as $test) {
         # code...
         $alltest [$test->id_test] = [
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

       return $alltest;
    }
}
