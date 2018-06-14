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

    public static function getAllGamesDay(){
      $sort = array(
        	array("field" => "game_day",   "direction" => "asc"),
        	array("field" => "idgame",     "direction" => "asc")
      );
      $countries = self::findInTable('countries',[]);
      $games = self::findInTable("games", ["sort" => $sort], false);
       
      if (isset($games->records)){
        $all_games = $games->records;
        $array_games = [];
        foreach ($all_games as $game){
          //$array_games[$game->fields->game_day][] = $game->fields->game_day;

          $recordscountries = $countries->records;
          foreach ($recordscountries as $keycountries => $valcountries){
                if ( $valcountries->id == $game->fields->team_a[0] )
                    $data_team_a = [
                      'country_code'  =>  $valcountries->fields->country_code,
                      'french'        =>  $valcountries->fields->french,
                    ];

                if ( $valcountries->id == $game->fields->team_b[0] )
                    $data_team_b = [
                      'country_code'  =>  $valcountries->fields->country_code,
                      'french'        =>  $valcountries->fields->french,
                    ];
          }

          $array_games[$game->fields->game_day][] = [
            'game_time'    => " - ",
            'team_a'       => $data_team_a,
            'team_b'       => $data_team_b
          ];
        }


      }
      return json_encode($array_games, JSON_PRETTY_PRINT);

    }

    public static function getAllMatchs(){

      $countries = self::findInTable('countries',[]);
      $games = self::findInTable("games", [], false);

      if (isset($games->records)){
          $all_games = $games->records;
          $array_matchs = [];
          foreach ($all_games as $key => $value){
            $recordscountries = $countries->records;
            foreach ($recordscountries as $keycountries => $valcountries){
                  if ( $valcountries->id == $value->fields->team_a[0] )
                      $data_team_a = [
                        'id'            =>  $value->fields->team_a[0],
                        'idcountry'     =>  $valcountries->fields->idcountry,
                        'country_code'  =>  $valcountries->fields->country_code,
                        'french'        =>  $valcountries->fields->french,
                        'flag'          =>  $valcountries->fields->flag
                      ];

                  if ( $valcountries->id == $value->fields->team_b[0] )
                      $data_team_b = [
                        'id'            =>  $value->fields->team_b[0],
                        'idcountry'     =>  $valcountries->fields->idcountry,
                        'country_code'  =>  $valcountries->fields->country_code,
                        'french'        =>  $valcountries->fields->french,
                        'flag'          =>  $valcountries->fields->flag
                      ];
            }

            $array_matchs[] =[
              'id'           => $value->id,
              'id_game'      => $value->fields->idgame,
              'game_day'     => $value->fields->game_day,
              'group'        => $value->fields->group,
              'team_a'       => $data_team_a,
              'team_b'       => $data_team_b
            ];
          }
      }
      return json_encode($array_matchs, JSON_PRETTY_PRINT);
    }

    public static function getPronosticsImg(){
        $pronostics = $_POST['pronostics'];
        foreach ($pronostics as $pronostic) {
            $fields = array(
              'link_picture'      =>  $pronostic->link_picture,
              'team_a_name'       =>  $pronostic->team_a_name,
              'team_b_name'       =>  $pronostic->team_b_name,
              'cca'               =>  $pronostic->cca,
              'ccb'               =>  $pronostic->ccb,
              'teamuser_ps'       =>  $pronostic->teamuser_ps
            );
            $url = "https://fr.funizi.com/api/start/359";
            $result = $this->helper->curlPost($url, $fields );
        }


    }

    public static function findInTable($table_name, $options=[], $cash=true){
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

    public static function addToObject($data,$added=array()){
       $obj = new  \StdClass();
        if(is_object($data))
        {
          foreach ($data as $key => $value)
              $obj->$key = $value;

          if(!empty($added) && is_array($added)){
            $obj->$added[0] = $added[1];
            return $obj;
          }else
            return false;
        }else
          return false;
    }

}
