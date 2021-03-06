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
use App\Models\Share;
use App\Models\UserTest;
use App\Models\Highlights;
use App\Models\Visitors;
use App\Models\Language;
use App\Models\Countries;
use App\Models\TestInfo;
use App\Models\ThemePerso;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

use Google\Cloud\Translate\TranslateClient;

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
      $from = [ 'á','Á','à','À','ă','Ă','â','Â','å','Å','ã','Ã','ą','Ą','ā','Ā','ä','Ä','æ','Æ','ḃ','Ḃ','ć','Ć','ĉ','Ĉ','č','Č','ċ','Ċ','ç','Ç','ď','Ď','ḋ','Ḋ','đ','Đ','ð','Ð','é','É','è','È','ĕ','Ĕ','ê','Ê','ě','Ě','ë','Ë','ė','Ė','ę','Ę','ē','Ē','ḟ','Ḟ','ƒ','Ƒ','ğ','Ğ','ĝ','Ĝ','ġ','Ġ','ģ','Ģ','ĥ','Ĥ','ħ','Ħ','í','Í','ì','Ì','î','Î','ï','Ï','ĩ','Ĩ','į','Į','ī','Ī','ĵ','Ĵ','ķ','Ķ','ĺ','Ĺ','ľ','Ľ','ļ','Ļ','ł','Ł','ṁ','Ṁ','ń','Ń','ň','Ň','ñ','Ñ','ņ','Ņ','ó','Ó','ò','Ò','ô','Ô','ő','Ő','õ','Õ','ø','Ø','ō','Ō','ơ','Ơ','ö','Ö','ṗ','Ṗ','ŕ','Ŕ','ř','Ř','ŗ','Ŗ','ś','Ś','ŝ','Ŝ','š','Š','ṡ','Ṡ','ş','Ş','ș','Ș','ß','ť','Ť','ṫ','Ṫ','ţ','Ţ','ț','Ț','ŧ','Ŧ','ú','Ú','ù','Ù','ŭ','Ŭ','û','Û','ů','Ů','ű','Ű','ũ','Ũ','ų','Ų','ū','Ū','ư','Ư','ü','Ü','ẃ','Ẃ','ẁ','Ẁ','ŵ','Ŵ','ẅ','Ẅ','ý','Ý','ỳ','Ỳ','ŷ','Ŷ','ÿ','Ÿ','ź','Ź','ž','Ž','ż','Ż','þ','Þ','µ','а','А','б','Б','в','В','г','Г','д','Д','е','Е','ё','Ё','ж','Ж','з','З','и','И','й','Й','к','К','л','Л','м','М','н','Н','о','О','п','П','р','Р','с','С','т','Т','у','У','ф','Ф','х','Х','ц','Ц','ч','Ч','ш','Ш','щ','Щ','ъ','Ъ','ы','Ы','ь','Ь','э','Э','ю','Ю','я','Я'];
      $to = [ 'a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','ae','AE','ae','AE','b','B','c','C','c','C','c','C','c','C','c','C','d','D','d','D','d','D','dh','Dh','e','E','e','E','e','E','e','E','e','E','e','E','e','E','e','E','e','E','f','F','f','F','g','G','g','G','g','G','g','G','h','H','h','H','i','I','i','I','i','I','i','I','i','I','i','I','i','I','j','J','k','K','l','L','l','L','l','L','l','L','m','M','n','N','n','N','n','N','n','N','o','O','o','O','o','O','o','O','o','O','oe','OE','o','O','o','O','oe','OE','p','P','r','R','r','R','r','R','s','S','s','S','s','S','s','S','s','S','s','S','SS','t','T','t','T','t','T','t','T','t','T','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','ue','UE','w','W','w','W','w','W','w','W','y','Y','y','Y','y','Y','y','Y','z','Z','z','Z','z','Z','th','Th','u','a','a','b','b','v','v','g','g','d','d','e','E','e','E','zh','zh','z','z','i','i','j','j','k','k','l','l','m','m','n','n','o','o','p','p','r','r','s','s','t','t','u','u','f','f','h','h','c','c','ch','ch','sh','sh','sch','sch','','','y','y','','','e','e','ju','ju','ja','ja'];

      $url = str_replace(' ', '-', $url); // Replaces all spaces with hyphens.
      $url = str_replace($from, $to, $url); //
      $url = preg_replace('/[^A-Za-z0-9\-]/', '', $url); // Removes special chars.
      $url = strtolower(trim($url, '-'));
      return preg_replace('/-+/', '-', $url);
    }

    public function getCountryCode(){
        $country = self::getCountry($this->getRealUserIp());
        return $country['countryCode'];
    }

    // Obtention de la langue par défaut du Navigateur
    public static function getLangBrowser()
    {
      $language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
      $language = $language{0}.$language{1};
      return $language;
    }

    // Traduction de $text en la langue $lang en utilisant l'API Google Translation
    public static function GoogleTranslate($lang, $text, $source = "fr")
    {
      $projectId = 'AIzaSyChSazTi8FrbvsjpKrffzHVDhrsL5R2nTI';
      if($lang == $source) return $text;
      $handle = curl_init();
      if (FALSE === $handle)
         throw new Exception('failed to initialize');

      curl_setopt($handle, CURLOPT_URL,'https://www.googleapis.com/language/translate/v2');
      curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($handle, CURLOPT_POSTFIELDS, array('key'=> $projectId, 'q' => $text, 'source' => $source, 'target' => $lang));
      curl_setopt($handle, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: GET'));
      $response = curl_exec($handle);
      $data = json_decode($response);
        //Helper::debug($data->data->translations[0]->translatedText);
        $text_translated = $data->data->translations[0]->translatedText;
        $text_translated = str_replace('&quot;','"',$text_translated) ;
        $text_translated = str_replace('\u00e0','à',$text_translated) ;
        $text_translated = str_replace('\u00e8','è',$text_translated) ;
        $text_translated = str_replace('\u00e9','é',$text_translated) ;
        $text_translated = str_replace('\u00c0','À',$text_translated) ;
        $text_translated = str_replace('&#39;','\'',$text_translated) ;

      return $text_translated;
    }

    // TEST Création du fichier du test pour une langue donnnée
    public function setFileTest($lang, $php )
    {
      $lang = $_GET['lang'];
      $php = "{%t {?user_name?} Tu auras une nouvelle voiture comme cadeau.  t%} et {%t Tu auras des vacances à Miami. t%} .";
      $nbOccurences = preg_match_all('#{%t(.*)t%}#Uis', $php, $m);
      if ($nbOccurences > 0)
        Helper::debug($m[1]);

      foreach ($m[1] as $value) {
        $php = str_replace($value, self::GoogleTranslate($lang, $value),$php);
      }
      $php = str_replace("{%t", "",$php);
      $php = str_replace("t%}", "",$php);
      Helper::debug($php);
      return $php;
          //for ($i = 0; $i < $nbOccurences; $i++) {
              //echo $m[1][$i] . '<br/>';
          //}
    }

    // Traduit le texte entres les tags {%t t%} dans $text dans la langue $lang puis retourne sans les tags
    public static function translateWithTags($lang, $text)
    {
      $nbOccurences = preg_match_all('#{%t(.*)t%}#Uis', $text, $m);
      if($lang != "en" && $lang != "fr" && $nbOccurences > 0)
        foreach ($m[1] as $value) {
          $text = str_replace($value, addslashes(self::GoogleTranslate($lang, stripslashes($value), "en")),$text);
        }
      $text = str_replace("{%t", "",$text);
      $text = str_replace("t%}", "",$text);

      $text = str_replace("{? ", "{?",$text);
      $text = str_replace(" ?}", "?}",$text);
      return $text;
    }

    // Traduit le titre et le texte de pargate du test en toutes les langues activées puis effectue la sauvegarde dans la BD
    public static function translateInfoTestAndSave($id_test, $titre, $test_description, $default_lang, $if_translated, $lang_to_update="")
    {
      // Le test est traduit pour toutes les langues activées
      if($if_translated == 1){
          $nb_translations_test = TestInfo::where("id_test",$id_test)->count();
          //si le test est en modification
          if($nb_translations_test >= 1){
            // Si on modifie pour toutes les langues activées
              if($lang_to_update == "fr"){
                $titre_en = self::toEn($titre, false);
                $test_for_share_en = self::toEn($test_description, false);
                $langs = Language::selectRaw('code')->where('status',1)->get();
                foreach ($langs as $lang) {
                  if($lang->code == $default_lang){
                    $data = [
                      "titre_test"        =>  $titre,
                      "test_description"  =>  $test_description
                    ];
                  }
                  else {
                    $new_titre = self::GoogleTranslate($lang->code, stripslashes($titre_en), "en");
                    $new_test_description = self::GoogleTranslate($lang->code, stripslashes($test_for_share_en), "en");
                    $data = [
                      "titre_test"        =>  $new_titre,
                      "test_description"  =>  $new_test_description
                    ];
                  }
                  TestInfo::where([["id_test", $id_test],["lang", $lang->code]])->update($data);
                }
              }
              else { // On modifie pour une seule langue $lang_to_update
                $data_lang = [
                  "titre_test"        =>  $titre,
                  "test_description"  =>  $test_description
                ];
                TestInfo::where([["id_test", $id_test],["lang", $lang_to_update]])->update($data_lang);
              }
          }
          else { // Le test est en création
              $data = array();
              $titre_en = self::toEn($titre, false);
              $test_for_share_en = self::toEn($test_description, false);
              $langs = Language::selectRaw('code')->where('status',1)->get();

              foreach ($langs as $lang) {
                if($lang->code == $default_lang){
                  $data[] = [
                    "id_test"           =>  $id_test,
                    "titre_test"        =>  $titre,
                    "test_description"  =>  $test_description,
                    "lang"              =>  $lang->code,
                    "created_at"        =>  \date("Y-m-d H:i:s"), # \Datetime()
                    "updated_at"        =>  \date("Y-m-d H:i:s")  # \Datetime()
                  ];
                }
                else {
                  $new_titre = addslashes(self::GoogleTranslate($lang->code, stripslashes($titre_en), "en"));
                  $new_test_description = addslashes(self::GoogleTranslate($lang->code, stripslashes($test_for_share_en), "en"));
                  $data[] = [
                    "id_test"           =>  $id_test,
                    "titre_test"        =>  $new_titre,
                    "test_description"  =>  $new_test_description,
                    "lang"              =>  $lang->code,
                    "created_at"        =>  \date("Y-m-d H:i:s"), # \Datetime()
                    "updated_at"        =>  \date("Y-m-d H:i:s")  # \Datetime()
                  ];
                }
              }
              TestInfo::insert($data);
          }
      }
      else { // Le test est disponible pour une seule langue $default_lang
        $nb_translations_test = TestInfo::where("id_test",$id_test)->count();
        //si le test est en modification
        if($nb_translations_test > 0){
          $data_lang = [
            "titre_test"        =>  $titre,
            "test_description"  =>  $test_description
          ];
          TestInfo::where([["id_test", $id_test],["lang", $default_lang]])->update($data_lang);
        }
        else { // Le test est en création
          $data = [
            "id_test"           =>  $id_test,
            "titre_test"        =>  $titre,
            "test_description"  =>  $test_description,
            "lang"              =>  $default_lang,
            "created_at"        =>  \date("Y-m-d H:i:s"), # \Datetime()
            "updated_at"        =>  \date("Y-m-d H:i:s")  # \Datetime()
          ];
          TestInfo::insert($data);
        }

      }



    }

    // Traduit le texte $texte en anglais (avec ou sans tags)
    public static function toEn($texte, $tags = true)
    {
      if($tags){
        $nbOccurences = preg_match_all('#{%t(.*)t%}#Uis', $texte, $m);
        if($nbOccurences > 0)
          foreach ($m[1] as $value) {
            $texte = str_replace($value, addslashes(self::GoogleTranslate("en", stripslashes($value))),$texte);
          }
      }
      else {
        $texte = addslashes(self::GoogleTranslate("en", stripslashes($texte)));
      }
      return $texte;
    }

    // Crée le fichier php à exécuter pour capturer l'image d'une citation
    public static function getUrlCitationFile($lang, $citation_id, $path, $php, $css, $js, $head, $bottom)
    {
      // Create a temporary file for execute php code
      $url_temp_file_php = $lang.'_file_citation_'.$citation_id;
      $temp_file_php = fopen($path . $url_temp_file_php.".php", "w+");
      if($temp_file_php==false)
      die("La création du fichier a échoué");

      //
      $php = str_replace('{%additionnal_input_text%}', '$_GET[\'additionnal_input_text\']', $php );
      //
      // Traduction dans la langue $lang
      //if($lang != 'fr')
      $php = self::translateWithTags($lang, $php);

      // changement de tags pour le code php
      $code_php = $php;
      $code_php = str_replace('{%', '$_GET[\'', $code_php );
      $code_php = str_replace('%}', '\']', $code_php );

      // changement de tags pour les variables
      $code_php = str_replace('{?', '\'.$_GET[\'', $code_php );
      $code_php = str_replace('?}', '\'].\'', $code_php );

      // changement de tags pour le code html
      $code_php = str_replace('{{', '<?php echo $_GET[\'', $code_php );
      $code_php = str_replace('}}', '\']; ?>', $code_php );
      $begin_gabarit = "
          <!DOCTYPE html>
          <html lang='".$lang."'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              ".$head."
              <title>Theme 4</title>
              <style>
                  body{font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;}
                  .main{
                      padding:0;
                      margin:0;
                      width: 800px;
                      height:420px;
                      position: relative;
                      overflow: hidden;
                  }
              .texte2{
                width: 200px;
              }
              ".$css."
              </style>
              <script src='../../../src/js/jquery.js'></script>
              <script>
                  $(document).ready(function(){
                var autoSizeText;
                autoSizeText = function() {
                  var el, elements, _i, _len, _results;
                  elements = $('.texte2');
                  console.log(elements);
                  if (elements.length < 0) {
                    return;
                  }
                  _results = [];
                  for (_i = 0, _len = elements.length; _i < _len; _i++) {
                    el = elements[_i];
                    _results.push((function(el) {
                      var resizeText, _results1;
                      resizeText = function() {
                        var elNewFontSize;
                        elNewFontSize = (parseInt($(el).css('font-size').slice(0, -2)) - 1) + 'px';
                        return $(el).css('font-size', elNewFontSize);
                      };
                      _results1 = [];
                      while (el.scrollHeight > el.offsetHeight) {
                        _results1.push(resizeText());
                      }
                      return _results1;
                    })(el));
                  }
                  return _results;
                };
                autoSizeText();
                  ".$js."

                  });
              </script>
          </head>
          <body style='width: 800px; height:420px; margin:0; padding:0; overflow: hidden;'>
          <div class='main'>
      ";

      $end_gabarit = "
        </div>
        ".$bottom."
        </body>
        </html>
      ";

      fputs($temp_file_php, $begin_gabarit. "\n" . $code_php . "\n" . $end_gabarit);
      //fputs($temp_file_php, $begin_gabarit. "<style>".$css."</style> \n" . "<script>".$js."</script> \n" . $code_php . $end_gabarit);
      self::uploadToS3($path . $url_temp_file_php.".php", 'quotes_files_php/');
      return $path . $url_temp_file_php . '.php';
    }
    // Crée le fichier du test dans la langue $lang pour le test $test_id
    public static function getUrlTempFile($lang, $test_id, $path, $php, $css, $js, $head, $bottom)
    {
      // Create a temporary file for execute php code
      $url_temp_file_php = $lang.'_file_test_'.$test_id;
      $temp_file_php = fopen($path . $url_temp_file_php.".php", "w+");
      if($temp_file_php==false)
      die("La création du fichier a échoué");

      //
      $php = str_replace('{%additionnal_input_text%}', '$_GET[\'additionnal_input_text\']', $php );
      //
      // Traduction dans la langue $lang
      //if($lang != 'fr')
        $php = self::translateWithTags($lang, $php);

      // changement de tags pour le code php
      $code_php = str_replace('{%', '$_GET[\'', $php );
      $code_php = str_replace('%}', '\']', $code_php );

      // changement de tags pour les variables
      $code_php = str_replace('{?', '\'.$_GET[\'', $code_php );
      $code_php = str_replace('?}', '\'].\'', $code_php );

      // changement de tags pour le code html
      $code_php = str_replace('{{', '<?php echo $_GET[\'', $code_php );
      $code_php = str_replace('}}', '\']; ?>', $code_php );
      $begin_gabarit = "
          <!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              ".$head."
              <title>Theme 4</title>
              <style>
                  body{font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;}
                  .main{
                      padding:0;
                      margin:0;
                      width: 800px;
                      height:420px;
                      position: relative;
                      overflow: hidden;
                  }
              .texte2{
                width: 200px;
              }
              ".$css."
              </style>
              <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
              <script>
                  $(document).ready(function(){
                var autoSizeText;
                autoSizeText = function() {
                  var el, elements, _i, _len, _results;
                  elements = $('.texte2');
                  console.log(elements);
                  if (elements.length < 0) {
                    return;
                  }
                  _results = [];
                  for (_i = 0, _len = elements.length; _i < _len; _i++) {
                    el = elements[_i];
                    _results.push((function(el) {
                      var resizeText, _results1;
                      resizeText = function() {
                        var elNewFontSize;
                        elNewFontSize = (parseInt($(el).css('font-size').slice(0, -2)) - 1) + 'px';
                        return $(el).css('font-size', elNewFontSize);
                      };
                      _results1 = [];
                      while (el.scrollHeight > el.offsetHeight) {
                        _results1.push(resizeText());
                      }
                      return _results1;
                    })(el));
                  }
                  return _results;
                };
                autoSizeText();
                  ".$js."

                  });
              </script>
          </head>
          <body style='width: 800px; height:420px; margin:0; padding:0; overflow: hidden;'>
          <div class='main'>
      ";

      $end_gabarit = "
        </div>
        ".$bottom."
        </body>
        </html>
      ";

      fputs($temp_file_php, $begin_gabarit. "\n" . $code_php . "\n" . $end_gabarit);
      //fputs($temp_file_php, $begin_gabarit. "<style>".$css."</style> \n" . "<script>".$js."</script> \n" . $code_php . $end_gabarit);
      self::uploadToS3($path . $url_temp_file_php.".php", 'tests_files_php/');
      return $url_temp_file_php;
    }

    public function createCookie()
    {
        $id_user = $_POST['id'];
        $est_admin = false;
        $admin = Admin::where('id_fb','=',$id_user)->first();
        if($admin){
          setcookie('id_user', $id_user, time() + 7*24*3600, null, null, false, true);
          setcookie('email_user', $_POST['email'], time() + 7*24*3600, null, null, false, true);
          setcookie('nom_user', $_POST['nom'], time() + 7*24*3600, null, null, false, true);
          setcookie('prenom_user', $_POST['prenom'], time() + 7*24*3600, null, null, false, true);
          setcookie('url_photo_user',"https://graph.facebook.com/".$id_user."/picture?height=200", time() + 365*24*3600, null, null, false, true);

          $testOwner =  TestOwner::where('id_test_owner','=',$id_user)->first();
          if(!$testOwner){
            $newTestOwner = TestOwner::create([
              'id_test_owner' =>  $id_user,
              'nom'           =>  $_POST['nom'],
              'prenoms'       =>  $_POST['prenom'],
              'email'         =>  $_POST['email']

            ]);
          }

        }
        else
          echo "Vous n'etes pas autorisé(e) à vous connecter !";
    }

    public static function checkCookies()
    {
      if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL){
        return $response->withStatus(302)->withHeader('Location', "http://creation.funizi.com" );
      }


        setcookie('id_user', $_COOKIE['id_user'], time() + 24*3600, null, null, false, true);
        setcookie('email_user', $_COOKIE['email_user'], time() + 24*3600, null, null, false, true);
        setcookie('nom_user', $_COOKIE['nom_user'], time() + 24*3600, null, null, false, true);
        setcookie('prenom_user', $_COOKIE['prenom_user'], time() + 24*3600, null, null, false, true);
        setcookie('url_photo_user', $_COOKIE['url_photo_user'], time() + 24*3600, null, null, false, true);

    }

    public static function array_msort($array, $cols)
    {
        $colarr = array();
        foreach ($cols as $col => $order) {
            $colarr[$col] = array();
            foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
        }
        $eval = 'array_multisort(';
        foreach ($cols as $col => $order) {
            $eval .= '$colarr[\''.$col.'\'],'.$order.',';
        }
        $eval = substr($eval,0,-1).');';
        eval($eval);
        $ret = array();
        foreach ($colarr as $col => $arr) {
            foreach ($arr as $k => $v) {
                $k = substr($k,1);
                if (!isset($ret[$k])) $ret[$k] = $array[$k];
                $ret[$k][$col] = $array[$k][$col];
            }
        }
        return $ret;

    }

    public static function getNameContry($country_code)
    {
      # code...
      $names = Countries::where("alpha2",$country_code)->first();
      $data = [
        "fr"  =>  $names->langFR,
        "en"  =>  $names->langEN,
        "es"  =>  $names->langES
      ];
      return $data;
    }

    public static function UpdateTranslationTest($lang = 'en')
    {
      $data_test_info = array();
      $data_themes_perso = array();
      $tests = Test::selectRaw('tests.default_lang AS default_lang, tests.id_test AS id_test, tests.titre_test AS titre_test, tests.test_description AS test_description,
          themes_perso.code_php AS code_php, themes_perso.code_css AS code_css, themes_perso.code_js AS code_js, themes_perso.code_head AS code_head,
          themes_perso.code_bottom AS code_bottom, themes_perso.nb_friends_fb AS nb_friends_fb, themes_perso.max_friends AS max_friends, themes_perso.best_friends AS best_friends')
        ->join('themes_perso','themes_perso.id_test','tests.id_test')
        ->where('tests.if_translated','=','1')
        ->where('themes_perso.lang','=','fr')
        //->with('themePersoInfo')
        ->get();

      foreach ($tests as $test) {
        $test_info_lang = TestInfo::where([['id_test','=',$test->id_test],['lang','=',$lang]])->count();
        if($test_info_lang == 0){
          // Informations générales du test
          $titre_en = self::toEn($test->titre_test, false);
          $test_for_share_en = self::toEn($test->test_description, false);

          $new_titre = addslashes(self::GoogleTranslate($lang, stripslashes($titre_en), "en"));
          $new_test_description = addslashes(self::GoogleTranslate($lang, stripslashes($test_for_share_en), "en"));
          $data_test_info[] = [
            "id_test"           =>  $test->id_test,
            "titre_test"        =>  $new_titre,
            "test_description"  =>  $new_test_description,
            "lang"              =>  $lang,
            "created_at"        =>  \date("Y-m-d H:i:s"), # \Datetime()
            "updated_at"        =>  \date("Y-m-d H:i:s")  # \Datetime()
          ];

        }

        $theme_perso_lang = ThemePerso::where([['id_test',$test->id_test],['lang','=',$lang]])->count();
        if($theme_perso_lang == 0){
          // Information du thème personnalisé
          Helper::debug($test->default_lang);
          $code_php = self::toEn($test->code_php);
          Helper::debug($lang);

          /*
          $url_temp_file_php_ = self::getUrlTempFile(
            $lang,
            $test->id_test,
            "ressources/views/themes/perso/",
            $code_php,
            $test->code_css,
            $test->code_js,
            $test->code_head,
            $test->code_bottom
          );
          */


          $data_themes_perso[] = [
            'id_test'       =>  $test->id_test,
            'lang'          =>  $lang,
            'code_php'      =>  self::translateWithTags($lang,$code_php),
            'code_css'      =>  $test->code_css   ,
            'code_js'       =>  $test->code_js   ,
            'code_head'     =>  $test->code_head   ,
            'code_bottom'   =>  $test->code_bottom   ,
            'nb_friends_fb' =>  $test->nb_friends_fb   ,
            'max_friends'   =>  $test->max_friends   ,
            'best_friends'  =>  $test->best_friends,
            "created_at"    =>  \date("Y-m-d H:i:s"), # \Datetime()
            "updated_at"    =>  \date("Y-m-d H:i:s")  # \Datetime()s
          ];

        }

      }
      Helper::debug($data_test_info);
      //Helper::debug($data_themes_perso);

      //TestInfo::insert($data_test_info);
      //ThemePerso::insert($data_themes_perso);





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
