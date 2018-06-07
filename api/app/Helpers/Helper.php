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

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

class Helper
{
    public static function getCountry($ip)
    {
        if(isset($_COOKIE['countryCode']) && isset($_COOKIE['countryName'])){
            $country = [
                'countryName'   =>  $_COOKIE['countryName'],
                'countryCode'   =>  $_COOKIE['countryCode']
            ];
            //return $country;
        }

        // Instanciate a new DBIP object with the database connection
        $db = new \PDO("mysql:host=localhost;dbname=funizi_store", "funizi_systemi", "fWOahOSH{%]2");

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


    public function createCookie()
    {
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
        $HTTP_X_FORWARDED_FOR = isset($_SERVER)? $_SERVER["HTTP_X_FORWARDED_FOR"]:getenv('HTTP_X_FORWARDED_FOR');
        $HTTP_CLIENT_IP = isset($_SERVER)?$_SERVER["HTTP_CLIENT_IP"]:getenv('HTTP_CLIENT_IP');
        $HTTP_CF_CONNECTING_IP = isset($_SERVER)?$_SERVER["HTTP_CF_CONNECTING_IP"]:getenv('HTTP_CF_CONNECTING_IP');
        $REMOTE_ADDR = isset($_SERVER)?$_SERVER["REMOTE_ADDR"]:getenv('REMOTE_ADDR');

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

    public function relatedTests2($countryCode, $exclude, $theme_id, $count, $total = 24, $debug = false){
        $customTests = $this->getRelatedThemeTest(4, $countryCode, $exclude, $count);
        $numb = 0;
        foreach($customTests as $customTest){
            $exclude [] = (string) $customTest['id_test'];
            $numb ++;
        }
        $newTests = $this->getRelatedThemeTest(3, $countryCode, $exclude, $count);
        foreach($newTests as $newTest){
            $exclude [] = (string) $newTest['id_test'];
            $numb ++;
        }
        $pays = $this->getRelatedCountryTest($countryCode, $exclude, $count);

        foreach($pays as $pay){
            $exclude [] = (string) $pay['id_test'];
            $numb ++;
        }
        $themes = $this->getRelatedThemeTest($theme_id, $countryCode, $exclude, $count);
        foreach($themes as $theme){
            $exclude [] = (string) $theme['id_test'];
            $numb ++;
        }
        $limit = $total - $numb;
        if($debug == true){
            Helper::debug($numb);
            Helper::debug($total);
        }
        if($limit > 0){
            $randoms = $this->getRandomTest($exclude, $limit);
            $alltests = $customTests->toBase()->merge($newTests)->merge($pays)->merge($themes)->merge($randoms);
        }else{
            $alltests = $customTests->toBase()->merge($newTests)->merge($pays)->merge($themes);
        }

        return $alltests;
    }


    public function relatedTests($countryCode, $exclude, $total = 24, $debug = false)
    {
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



    public function uploadToS3($fileURL, $folder){
        // AWS Info

        $bucketName = 'funiziuploads';
        $IAM_KEY = $_SERVER['FUNUPLOADER_KEY'];
        $IAM_SECRET = $_SERVER['FUNUPLOADER_SECRET'];

        //echo $IAM_KEY . '<br>' . $IAM_SECRET;
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
}
