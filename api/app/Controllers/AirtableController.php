<?php


namespace App\Controllers;


use App\Helpers\DBIP;
use App\Helpers\Helper;
use App\Helpers\Browser;
use App\Models\Admin;
use App\Models\Test;
use App\Models\User;
use App\Models\UserTest;
use App\Models\Visitors;
use App\Models\Countries;
use Psr7Middlewares\Middleware\ClientIp;
use GrabzItImageOptions;

class AirtableController extends Controller
{
    static $api_key = false;
    static $path_cash = DIR.DS.'public'.DS.'cash'.DS.'airtable'.DS;

    public static function getAllMatchs()
    {
      return self::findInTable("games", [], false);
    }
    public static function findInTable($table_name, $options=[], $cash=true)
    {
          $put_url = self::$path_cash;
          $put_url.="$table_name.txt";


          if ($cash)
             $poster = file_get_contents($put_url);
          else
             $poster = '';

          if (!empty($poster))
            return json_decode($poster);
          else{
            $fields = [];
            $fields = $options;
            $fields['api_key'] = $_SERVER['AIRTABLE_API_KEY'];
            $url = "https://api.airtable.com/v0/appec3rBvyPYpIOAx/$table_name";
            $poster = self::curl_get_fields($url, $fields);

            Helper::debug($fields);
            Helper::debug($url);


            $decode = json_decode($poster);
            if (isset($decode->records))
              file_put_contents($put_url, $poster);

            return $decode;
          }
    }



    public static function curl_get_fields($url,$fields,$header=false){
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
    			 $CURL=curl_init();
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
