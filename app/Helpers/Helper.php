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
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

class Helper
{
    public static function getCountry($ip){
        if(isset($_COOKIE['countryCode'], $_COOKIE['countryName'])){
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
            $countryBD = Countries::where('alpha2', '=', (string)$inf->country)->first();
            $countryCode = $inf->country;
            $countryname = $countryBD->langFR;
            //setcookie("countryCode", $countryCode, time()+3600*24*30);
            //setcookie("countryName", $countryname, time()+3600*24*30);
        }
        else {
            $data = json_decode(file_get_contents('http://geoplugin.net/json.gp?ip='.$ip));
            $countryname = $data->geoplugin_countryName;
            $countryCode = $data->geoplugin_countryCode;
            if($data){
                //setcookie("countryCode", $countryCode, time()+3600*24*30);
                //setcookie("countryName", $countryname, time()+3600*24*30);
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
      $from = [ 'á','Á','à','À','ă','Ă','â','Â','å','Å','ã','Ã','ą','Ą','ā','Ā','ä','Ä','æ','Æ','ḃ','Ḃ','ć','Ć','ĉ','Ĉ','č','Č','ċ','Ċ','ç','Ç','ď','Ď','ḋ','Ḋ','đ','Đ','ð','Ð','é','É','è','È','ĕ','Ĕ','ê','Ê','ě','Ě','ë','Ë','ė','Ė','ę','Ę','ē','Ē','ḟ','Ḟ','ƒ','Ƒ','ğ','Ğ','ĝ','Ĝ','ġ','Ġ','ģ','Ģ','ĥ','Ĥ','ħ','Ħ','í','Í','ì','Ì','î','Î','ï','Ï','ĩ','Ĩ','į','Į','ī','Ī','ĵ','Ĵ','ķ','Ķ','ĺ','Ĺ','ľ','Ľ','ļ','Ļ','ł','Ł','ṁ','Ṁ','ń','Ń','ň','Ň','ñ','Ñ','ņ','Ņ','ó','Ó','ò','Ò','ô','Ô','ő','Ő','õ','Õ','ø','Ø','ō','Ō','ơ','Ơ','ö','Ö','ṗ','Ṗ','ŕ','Ŕ','ř','Ř','ŗ','Ŗ','ś','Ś','ŝ','Ŝ','š','Š','ṡ','Ṡ','ş','Ş','ș','Ș','ß','ť','Ť','ṫ','Ṫ','ţ','Ţ','ț','Ț','ŧ','Ŧ','ú','Ú','ù','Ù','ŭ','Ŭ','û','Û','ů','Ů','ű','Ű','ũ','Ũ','ų','Ų','ū','Ū','ư','Ư','ü','Ü','ẃ','Ẃ','ẁ','Ẁ','ŵ','Ŵ','ẅ','Ẅ','ý','Ý','ỳ','Ỳ','ŷ','Ŷ','ÿ','Ÿ','ź','Ź','ž','Ž','ż','Ż','þ','Þ','µ','а','А','б','Б','в','В','г','Г','д','Д','е','Е','ё','Ё','ж','Ж','з','З','и','И','й','Й','к','К','л','Л','м','М','н','Н','о','О','п','П','р','Р','с','С','т','Т','у','У','ф','Ф','х','Х','ц','Ц','ч','Ч','ш','Ш','щ','Щ','ъ','Ъ','ы','Ы','ь','Ь','э','Э','ю','Ю','я','Я'];
      $to = [ 'a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','ae','AE','ae','AE','b','B','c','C','c','C','c','C','c','C','c','C','d','D','d','D','d','D','dh','Dh','e','E','e','E','e','E','e','E','e','E','e','E','e','E','e','E','e','E','f','F','f','F','g','G','g','G','g','G','g','G','h','H','h','H','i','I','i','I','i','I','i','I','i','I','i','I','i','I','j','J','k','K','l','L','l','L','l','L','l','L','m','M','n','N','n','N','n','N','n','N','o','O','o','O','o','O','o','O','o','O','oe','OE','o','O','o','O','oe','OE','p','P','r','R','r','R','r','R','s','S','s','S','s','S','s','S','s','S','s','S','SS','t','T','t','T','t','T','t','T','t','T','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','ue','UE','w','W','w','W','w','W','w','W','y','Y','y','Y','y','Y','y','Y','z','Z','z','Z','z','Z','th','Th','u','a','a','b','b','v','v','g','g','d','d','e','E','e','E','zh','zh','z','z','i','i','j','j','k','k','l','l','m','m','n','n','o','o','p','p','r','r','s','s','t','t','u','u','f','f','h','h','c','c','ch','ch','sh','sh','sch','sch','','','y','y','','','e','e','ju','ju','ja','ja'];

      $url = str_replace(' ', '-', $url); // Replaces all spaces with hyphens.
      $url = str_replace($from, $to, $url); //
      $url = preg_replace('/[^A-Za-z0-9\-]/', '', $url); // Removes special chars.
      $url = strtolower(trim($url, '-'));
      return preg_replace('/-+/', '-', $url);
    }

    public static function cleanUrl2($url){
        $transliterationTable = ['á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja'];
        $url = str_replace(array(array_keys($transliterationTable), ' '), array(array_values($transliterationTable), '-'), $url); // Replaces all spaces with hyphens.
        $url = preg_replace('/[^A-Za-z0-9\-]/', '', $url); // Removes special chars.
        $url = strtolower(trim($url, '-'));
        return preg_replace('/-+/', '-', $url);
    }
    public function getCountryCode(){
      if(isset($_COOKIE["country_user"]))
          $country = (array) json_decode($_COOKIE['country_user']);
      else {
          $country = $this->getCountry($this->getRealUserIp());
          setcookie("country_user", json_encode($country), time()+3600*24*10);
      }
      //$country = self::getCountry($this->getRealUserIp());
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

    public static function getUrlTest($titre_test, $id, $lang){
      if($lang === 'ar'){
          return TestInfo::where([['id_test','=',$id],['lang','=','en']])->first()->titre_test;
      }
      else
        return $titre_test;

    }

    public static function getUrlCitation($titre_citation, $id, $lang){
      if($lang == 'ar'){
        $citation_info = CitationInfo::where([['id_citation','=',$id],['lang','=','en']])->first();
        return $citation_info->titre_citation;
      }
      else
        return $titre_citation;

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
        $testUser = User::where('facebook_id', (string)$user)->with('usertests')->first();
        //self::debug($testUser->usertests);
        foreach($testUser->usertests as $users){
            $tested [] = $users->test_id;
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

    public static function getTestsWithAdditionnalInfos($countryCode, $exclude, $lang, $total = 1){
      // Récuperation des tests pour langue $lang;
      $tests_from_json = self::getAllTestJson($lang);
      //Helper::debug($tests_from_json);
      //krsort($tests_from_json);
      $nb_taken = 0; $tests = array();
      foreach ($tests_from_json as $test) {
        if(!in_array($test['id_test'], $exclude, true) && ($test['codes_countries'] == "" || strpos($test['codes_countries'], $countryCode) != false ) && ++$nb_taken <= $total && $test['if_additionnal_info'] == 1){
          $tests[$test['id_test']] = [
            'url_image_test' => $test['url_image_test'],
            'id_test'        => $test['id_test'],
            'titre_test'     => $test['titre_test']
          ];
        }
      }
      if(count($tests) > 1)
        shuffle($tests);
      return $tests;
    }

    public static function getTestsWithImgTreatment($countryCode, $exclude, $lang, $total = 1){
      // Récuperation des tests pour langue $lang;
      $tests_from_json = self::getAllTestJson($lang);
      //Helper::debug($tests_from_json);
      //krsort($tests_from_json);
      $nb_taken = 0; $tests = array();
      foreach ($tests_from_json as $test) {
        if(!in_array($test['id_test'], $exclude, true) && ($test['codes_countries'] == "" || strpos($test['codes_countries'], $countryCode) != false ) && ++$nb_taken <= $total && $test['has_treatment'] === 1){
          $tests[$test['id_test']] = [
            'url_image_test' => $test['url_image_test'],
            'id_test'        => $test['id_test'],
            'titre_test'     => $test['titre_test']
          ];
        }
      }
      if(count($tests) > 1)
        shuffle($tests);
      return $tests;
    }

    public function relatedTests($countryCode, $exclude, $lang, $total = 33){
      $alltests= []; $besttests= []; $new_tests = []; $tests_with_add_info = [];

      if(in_array($countryCode, ['SN','CI','FR','CD'], true)){
        $choosen_some_tests = array();
        //$array_tests = array(351, 353, 354, 357, 360, 361, 362, 364, 365, 366, 363, 368, 369);
        $array_tests = array(353, 354, 357, 360, 361, 362, 364, 366, 363, 374, 375);
        $choosen_some_tests = self::getSomeTests($countryCode, $array_tests, $exclude, $lang);
        if(count($choosen_some_tests) >= 1)
          foreach ($choosen_some_tests as $test)
            $exclude[] = $test['id_test'];

          $nb_restant = $total - count($choosen_some_tests);
          $alltests_total = self::getMostTestedCountry($lang, $exclude, $countryCode, $nb_restant);
          //
            $best_local_test = self::getBestLocalTest($lang, $exclude, $countryCode, $nb_restant);
            if(count($best_local_test) >= 1)
              foreach ($best_local_test as $test)
                $exclude[] = $test['id_test'];
            $nb_restant = $nb_restant - count($best_local_test);
            $choosen_some_tests   = array_merge($choosen_some_tests, $best_local_test);
            $alltests_total = self::getMostTestedCountry($lang, $exclude, $countryCode, $nb_restant);
          //
          if($choosen_some_tests != null)
            $alltests_total   = array_merge($choosen_some_tests, $alltests_total);
      }
      else {
        // Selection de quelques tests
        $choosen_some_tests = array();
        //$array_tests = array(207,112);
        $array_tests = array(370, 347, 207, 361, 362, 366, 363, 371);
        $choosen_some_tests = self::getSomeTests($countryCode, $array_tests, $exclude, $lang);
        if(count($choosen_some_tests) >= 1)
          foreach ($choosen_some_tests as $test)
            $exclude[] = $test['id_test'];

        //Selection d'un test demandant des informatsions additionnelles
        //$choosen_tests_with_img_treatment = self::getTestsWithImgTreatment($countryCode, $exclude, $lang, 3);
        //if(count($choosen_tests_with_img_treatment) >= 1)
          //foreach ($choosen_tests_with_img_treatment as $test)
            //$exclude[] = $test['id_test'];

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

        $tests_to_discover = array();
        if($choosen_some_tests != null)
          $tests_to_discover   = $choosen_some_tests;

        //if($choosen_tests_with_img_treatment != null)
          //$tests_to_discover   = array_merge($tests_to_discover, $choosen_tests_with_img_treatment);

        $tests_to_discover   = array_merge($tests_to_discover, $choosen_new_tests_1);

        $tests_to_discover   = array_merge($tests_to_discover, $besttests);

        $tests_to_discover   = array_merge($tests_to_discover, $choosen_new_tests_2);

        $tests_to_discover   = array_merge($tests_to_discover, $choosen_local_tests_1);

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

        $alltests   = array_merge($tests_to_discover, $alltests);
        $alltests_total = array_slice($alltests, 0, $total);
      }

      return $alltests_total;
    }

    public static function getLovedTests($countryCode, $exclude, $lang, $total = 3){
      //$file = "ressources/views/json_files/best_tests/".$lang."_best_tests.json";
      $file = $_SERVER['STORAGE_BASE'] . "/json_files/best_tests/" . $lang . "_best_tests.json";
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
            'url_image_test'        => $test['url_image_test'],
            'id_test'               => $test['id_test'],
            'titre_test'            => $test['titre_test']
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

    public static function getSomeTests($countryCode, $array_tests, $exclude, $lang){
      // Récuperation des tests pour langue $lang;
      $tests_from_json = self::getAllTestJson($lang);
      //krsort($tests_from_json);
      foreach ($tests_from_json as $test) {
        if(in_array($test['id_test'], $array_tests, true) && !in_array($test['id_test'], $exclude, true) && ($test['codes_countries'] == "" || strpos($test['codes_countries'], $countryCode) != false ) ){
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

    // Obtention des tests locaux
    public static function getLocalTests($countryCode, $exclude, $lang, $total = 5){
      // Récuperation des tests pour langue $lang;
      $tests_from_json = self::getAllTestJson($lang);
      //krsort($tests_from_json);
      $nb_taken = 0;
      shuffle($tests_from_json);
      $tests = [];
      foreach ($tests_from_json as $test) {
        if(!in_array($test['id_test'], $exclude, true) && (strpos($test['codes_countries'], $countryCode) != false ) && ++$nb_taken <= $total){
          $tests[$test['id_test']] = [
            'url_image_test'    => $test['url_image_test'],
            'id_test'           => $test['id_test'],
            'titre_test'        => $test['titre_test'],
            "id_theme"          => $test['id_theme'],
            "id_rubrique"       => $test['id_rubrique'],
            "statut"            => $test['statut'],
            "unique_result"     => $test['unique_result'],
            "codes_countries"   => $test['codes_countries']
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
    public static function getActivatedLanguages(){
      //$all_lang = Language::where('status','=',1)->get();
      $file = $_SERVER['STORAGE_BASE'] . "/json_files/all_languages/all_lang.json";

  	  $jsondata = file_get_contents($file);
  	   // converts json data into array
  	   $arr_data = json_decode($jsondata);
       $all_lang = array();
       foreach ($arr_data as $lang) {
         if($lang->status == 1)
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

      return $all_lang;
    }
    public static function getActivatedLanguages2(){
      $file = $_SERVER['STORAGE_BASE'] . "/json_files/all_languages/all_lang.json";

  	  $jsondata = file_get_contents($file);
  	   // converts json data into array
  	   $arr_data = json_decode($jsondata);
       $alllang = array();
       foreach ($arr_data as $lang) {
         if($lang->status == 1)
         $alllang [] = [
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

       return $alllang;
    }

    public static function getAllLanguages()
    {
      $file = $_SERVER['STORAGE_BASE'] . "/json_files/all_languages/all_lang.json";

  	  $jsondata = file_get_contents($file);
  	   // converts json data into array
  	   $arr_data = json_decode($jsondata);
       $alllang = array();
       foreach ($arr_data as $lang) {
         $alllang [] = [
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

       return $alllang;
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
              'cookie_code'     =>   $code,
              'ip_address'      =>   $helper->getRealUserIp(),
              'browser'         =>   $navigateur,
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
      //Helper::debug($_SERVER['REQUEST_URI']);

        return str_replace(array("www", $_SERVER['SERVER_DOMAIN'], "."), "", $host);
    }

    public static function detectLang($request, $response){
      //$host = $request->getUri()->getHost();
      $server = $_SERVER["HTTP_X_FORWARDED_PROTO"];
      $lang = self::getLangSubdomain($request);
      if($lang == ""){
          $lang = self::getLangBrowser();
          //$url = "https://".$lang.".funizi.com".$_SERVER['REQUEST_URI'];
        return "https://". $lang . '.' . $_SERVER['SERVER_DOMAIN'] . $_SERVER['REQUEST_URI'];
      }
      self::setNbSeenPage($request, $response);
      return "";
    }

    public static function setNbSeenPage($request, $response){
      if(isset($_SESSION['count_seen_page']))
        $_SESSION['count_seen_page'] = $_SESSION['count_seen_page'] + 1;
      else
        $_SESSION['count_seen_page'] = 1;
    }

    public static function getTestFromJson($file = "ressources/views/all_test.json"){
      //Get data from existing json file
       //$file = $_SERVER['STORAGE_BASE'] . "/json_files/all_test.json";
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
           "titre_test"        => stripslashes((string)$test->titre_test),
           "unique_result"     => $test->unique_result,
           "url_image_test"    => $test->url_image_test,
           "codes_countries"   => $test->codes_countries
         ];
       }

       return $alltest;
    }

    public static function getAllTestJson($lang, $get_all = false){
      //Get data from existing json file
      //$file = "ressources/views/json_files/all_tests/".$lang."_all_test.json";
      $file = $_SERVER['STORAGE_BASE'] . "/json_files/all_tests/" . $lang . "_all_test_2.json";

      $jsondata = file_get_contents($file);
       // converts json data into array
       $arr_data = json_decode($jsondata);
       $alltest = array();
       foreach ($arr_data as $test) {
         if($get_all == false ){
           if($test->statut == 1)
             $alltest [$test->id_test] = [
               "id_test"              => $test->id_test,
               "id_theme"             => $test->id_theme,
               "id_rubrique"          => $test->id_rubrique,
               "statut"               => $test->statut,
               'permissions'          => $test->permissions,
               'if_additionnal_info'  => $test->if_additionnal_info,
               "if_translated"        => $test->if_translated,
               "has_treatment"        => $test->has_treatment,
               "default_lang"         => $test->default_lang,
               "titre_test"           => stripslashes((string)$test->titre_test),
               "unique_result"        => $test->unique_result,
               "url_image_test"       => $test->url_image_test,
               "codes_countries"      => $test->codes_countries
             ];
         }
         else
           $alltest [$test->id_test] = [
             "id_test"              => $test->id_test,
             "id_theme"             => $test->id_theme,
             "id_rubrique"          => $test->id_rubrique,
             "statut"               => $test->statut,
             'permissions'          => $test->permissions,
             'if_additionnal_info'  => $test->if_additionnal_info,
             "if_translated"        => $test->if_translated,
             "has_treatment"        => $test->has_treatment,
             "default_lang"         => $test->default_lang,
             "titre_test"           => stripslashes((string)$test->titre_test),
             "unique_result"        => $test->unique_result,
             "url_image_test"       => $test->url_image_test,
             "codes_countries"      => $test->codes_countries
           ];
       }

       return $alltest;
    }

    public static function getAllTestJson2($lang){
      //Get data from existing json file
      //$file = "ressources/views/json_files/all_tests/".$lang."_all_test.json";
      $file = $_SERVER['STORAGE_BASE'] . "/json_files/all_tests/" . $lang . "_all_test.json";

  	  $jsondata = file_get_contents($file);
  	   // converts json data into array
  	   $arr_data = json_decode($jsondata);
       $alltest = array();
       foreach ($arr_data as $test) {
         # code...
         $alltest [$test->id_test] = [
           "id_test"              => $test->id_test,
           "id_theme"             => $test->id_theme,
           "id_rubrique"          => $test->id_rubrique,
           "statut"               => $test->statut,
           'permissions'          => $test->permissions,
           'if_additionnal_info'  => $test->if_additionnal_info,
           "if_translated"        => $test->if_translated,
           "has_treatment"        => $test->has_treatment,
           "default_lang"         => $test->default_lang,
           "titre_test"           => stripslashes((string)$test->titre_test),
           "unique_result"        => $test->unique_result,
           "url_image_test"       => $test->url_image_test,
           "codes_countries"      => $test->codes_countries
         ];
       }

       return $alltest;
    }

    public static function getAllCitationJson($lang){
      //Get data from existing json file
      //$file = "ressources/views/json_files/all_tests/".$lang."_all_test.json";
      $file = $_SERVER['STORAGE_BASE'] . "/json_files/all_quotes/" . $lang . "_all_quotes.json";

      $jsondata = file_get_contents($file);
       // converts json data into array
       $arr_data = json_decode($jsondata);
       $allcitation = array();
       foreach ($arr_data as $citation) {
         $allcitation [$citation->id_citation] = [
           "id_citation"           => $citation->id_citation,
           "id_rubrique"           => $citation->id_rubrique,
           "statut"                => $citation->statut,
           "if_translated"         => $citation->if_translated,
           "if_personalizable"     => $citation->if_personalizable,
           "default_lang"          => $citation->default_lang,
           "titre_citation"        => stripslashes((string)$citation->titre_citation),
           "url_image_citation"    => $citation->url_image_citation,
           "codes_countries"       => $citation->codes_countries
         ];
       }

       return $allcitation;
    }

    public function getBestLocalTest($lang, $exclude, $countryCode, $total = 24){
      if(strlen($lang) > 2) $lang = 'en'; //
      //$file = "ressources/views/json_files/countries/".$lang."_".$countryCode."_most_tested.json";
      $file = $_SERVER['STORAGE_BASE'] . "/json_files/countries/" . $lang ."_".$countryCode."_most_tested.json";
      $jsondata = file_get_contents($file);
       // converts json data into array
       $arr_data = json_decode($jsondata);
       $most_tested = array();
       $nb_taken = 0;
       foreach ($arr_data as $test) {
         if(!in_array($test->id_test, $exclude, true) && (strpos($test->codes_countries, $countryCode) != false ) && ++$nb_taken <= $total){
           $most_tested[$test->id_test] = [
             'url_image_test' => $test->url_image_test,
             'id_test'        => $test->id_test,
             'titre_test'     => stripslashes("$test->titre_test")
           ];
           $exclude[] = $test->id_test;
         }
       }
       shuffle($most_tested);
      $data = [
        'exclude'       =>  $exclude,
        'most_tested'  =>  $most_tested
      ];

      //return $data;
      return $data['most_tested'];
    }

    public function getMostTestedCountry($lang, $exclude, $countryCode, $total = 24){
      if(strlen($lang) > 2) $lang = 'en'; //
      //$file = "ressources/views/json_files/countries/".$lang."_".$countryCode."_most_tested.json";
      $file = $_SERVER['STORAGE_BASE'] . "/json_files/countries/" . $lang ."_".$countryCode."_most_tested.json";
      $jsondata = file_get_contents($file);
       // converts json data into array
       $arr_data = json_decode($jsondata);
       $most_tested = array();
       $nb_taken = 0;
       foreach ($arr_data as $test) {
         if(!in_array($test->id_test, $exclude, true) && ($test->codes_countries == "" || strpos($test->codes_countries, $countryCode) != false ) && ++$nb_taken <= $total){
           $most_tested[$test->id_test] = [
             'url_image_test' => $test->url_image_test,
             'id_test'        => $test->id_test,
             'titre_test'     => stripslashes("$test->titre_test")
           ];
           $exclude[] = $test->id_test;
         }
       }
       shuffle($most_tested);
      $data = [
        'exclude'       =>  $exclude,
        'most_tested'  =>  $most_tested
      ];

      //return $data;
      return $data['most_tested'];
    }

    public static function getHighlightsFromJson($lang){
      //Get data from existing json file
       $file = $_SERVER['STORAGE_BASE'] . "/json_files/highlights/" . $lang . "_highlights.json";
       $jsondata = file_get_contents($file, true);
       //$jsondata = file_get_contents("ressources/views/json_files/highlights/".$lang."_highlights.json",true);
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
           "titre_test"        => stripslashes((string)$test->titre_test),
           "unique_result"     => $test->unique_result,
           "url_image_test"    => $test->url_image_test,
           "codes_countries"   => $test->codes_countries
         ];
       }

       return $alltest;
    }

    public function uploadToS3($fileURL, $folder){
        // AWS Info

        $bucketName = 'funiziuploads';
        $IAM_KEY = $_SERVER['FUNUPLOADER_KEY'];
        $IAM_SECRET = $_SERVER['FUNUPLOADER_SECRET'];

        echo $IAM_KEY . '<br>' . $IAM_SECRET;
        // Connect to AWS
        try {
            // You may need to change the region. It will say in the URL when the bucket is open
            // and on creation. us-east-2 is Ohio, us-east-1 is North Virgina

            $s3 = new S3Client(
                array(
                    'credentials' => array(
                        'key' => $IAM_KEY,
                        'secret' => $IAM_SECRET
                    ),
                    'version' => 'latest',
                    'region'  => 'us-east-2'
                )
            );
        } catch (\Exception $e) {
            // We use a die, so if this fails. It stops here. Typically this is a REST call so this would
            // return a json object.
            //die("Error: " . $e->getMessage());
            $res['error'] = $e->getMessage();
            return $res;
        }

          // Change this
        // For this, I would generate a unqiue random string for the key name. But you can do whatever.
        $keyName = $folder . basename($fileURL);
        $pathInS3 = 'https://s3.us-east-2.amazonaws.com/' . $bucketName . '/' . $keyName;
        // Add it to S3
        try {
            // You need a local copy of the image to upload.
            // My solution: http://stackoverflow.com/questions/21004691/downloading-a-file-and-saving-it-locally-with-php
            if (!file_exists('/tmp/tmpfile')) {
                mkdir('/tmp/tmpfile');
            }

            $tempFilePath = '/tmp/tmpfile/' . basename($fileURL);
            $tempFile = fopen($tempFilePath, "w") or die("Error: Unable to open file.");
            $fileContents = file_get_contents($fileURL);
            $tempFile = file_put_contents($tempFilePath, $fileContents);
            $res = $s3->putObject(
                array(
                    'Bucket'=>$bucketName,
                    'Key' =>  $keyName,
                    'SourceFile' => $tempFilePath,
                    'StorageClass' => 'REDUCED_REDUNDANCY',
                    'ACL'           => 'public-read',

                )
            );
            return $res;
            // WARNING: You are downloading a file to your local server then uploading
            // it to the S3 Bucket. You should delete it from this server.
            // $tempFilePath - This is the local file path.
        } catch (S3Exception $e) {
            //die('Error:' . $e->getMessage());
            $res['error'] = $e->getMessage();
        } catch (\Exception $e) {
            //die('Error:' . $e->getMessage());
            $res['error'] = $e->getMessage();
        }
        return $res;

    }

    public function getScore($team)
    {
      //$idTeam = $arg['id'];
      self::debug($team);
      $result = json_decode(self::curl_get_fields("https://wizili.com/worldcupru/teamfeed/$team",[]));
      self::debug($result);

      $data = [
        "score_a" =>  $result->localteam_score,
        "score_b" =>  $result->visitorteam_score,
        "cca"     =>  $result->localteam,
        "ccb"     =>  $result->visitor,
        "timer"   =>  $result->timer,
        "date"    =>  $result->match_date,
        "time"    =>  $result->match_time,
      ];
      self::debug(json_encode($data));

    }


    public static function curl_get_fields($url, $fields, $header=false){
				$get_array = [];
				if ( is_array($fields) ) {
					 foreach ($fields as $key => $value) {
						   $value = str_replace("'", "%27", $value);
							 $value = str_replace(' ', '%20', $value);
					 	   $get_array[] = "$key=$value";
					 }
					 $soo =  implode('&', $get_array);
					 $url .= "?$soo";
				}
			 // Tableau contenant les options de téléchargement
			 $options=array(
			       CURLOPT_URL            => $url,     // Url cible (l'url la page que vous voulez télécharger)
			       CURLOPT_RETURNTRANSFER => true,    // Retourner le contenu téléchargé dans une chaine (au lieu de l'afficher directement)
			       CURLOPT_HEADER         => $header // Ne pas inclure l'entête de réponse du serveur dans la chaine retournée
			 );
			 ////////// MAIN
			 // Création d'un nouvelle ressource cURL
			 $CURL = curl_init();
			       // Configuration des options de téléchargement
			       curl_setopt_array($CURL,$options);
			       // Exécution de la requête
			       $content=curl_exec($CURL);      // Le contenu téléchargé est enregistré dans la variable $content. Libre à vous de l'afficher.
						 if (curl_errno($CURL)) {
		 					 curl_close($CURL);
		 						return false;
		 				}
		 			curl_close ($CURL);
		 		 return $content;
			 // Fermeture de la session cURL
    }

}
