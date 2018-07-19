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
use App\Controllers\AirtableController;
use Psr7Middlewares\Middleware\ClientIp;
use GrabzItImageOptions;

class HomeController extends Controller
{
    public function index($request, $response, $arg){
      $data = [
        'text' => "Merci d'avoir partagé, reviens demain pour de nouveaux pronostics et augmenter ton nombre de points !",
      ];

      $lang = $this->helper->getLangSubdomain($request);
      $interface_ui = $this->helper->getUiLabels($lang);
      return $this->view->render($response, 'home.twig', compact('data','lang','interface_ui'));

    }

    public function createSession($request, $response){
        $id = $request->getParam('id');
        $name = $request->getParam('first_name');
        $lastname = $request->getParam('last_name');
        //$email = $request->getParam('email');
        $gender = $request->getParam('gender');
        //$picture = $request->getParam('pic');
        if(!$_SESSION['user_has_disconnected'] || $_SESSION['user_has_disconnected'] != 'yes'){
            $_SESSION['uid'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['last_name'] = $lastname;
            //$_SESSION['email'] = $email;
            $_SESSION['gender'] = $gender;
            //$_SESSION['pic'] = $picture;
        }
        $data = [$id, $name, $lastname, $gender, $_SESSION['friends'], $_SESSION['posts'], $_SESSION['photos'], $_SESSION['accepted'],$_SESSION['tags']];
        return $response->withStatus(201)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($data));

    }

    public function createPicMatch($request, $response, $arg)
    {
      $matchs = AirtableController::getAllMatchs();

      $matchs_records = json_decode($matchs);
      $nb = 1;
      $nb = 1;
      foreach ($matchs_records as $match) {

        $fields = array(
          'game'                  =>  $match->id_game,
          'team_a'                =>  $match->team_a->french,
          'team_b'                =>  $match->team_b->french,
          'team_a_flag'           =>  $match->team_a->flag,
          'team_a_country_code'   =>  strtolower($match->team_a->country_code),
          'team_b_flag'           =>  $match->team_b->flag,
          'team_b_country_code'   =>  strtolower($match->team_b->country_code),
          'time'                  =>  $match->game_time
        );
        $url = "https://fr.funizi.com/api/start/358";
        $result = $this->helper->curlPost($url, $fields );

        $nb++;
        if($nb == 6) break;
      }
    }

    public function createGameDays($request, $response, $arg)
    {
      $game_days = json_decode(AirtableController::getAllGamesDay());
      foreach ($game_days as $key => $day) {
        $fields = [];
        $nb_games = 0;
        foreach ($day as $value) {
          $nb_games++;
          $fields ["a".$nb_games]     = $value->team_a->french;
          $fields ["b".$nb_games]     = $value->team_b->french;
          $fields ["cca".$nb_games]   = $value->team_a->country_code;
          $fields ["ccb".$nb_games]   = $value->team_b->country_code;
          $fields ["time".$nb_games]  = $value->game_time;
          $fields ["date"]            = $value->game_date;
        }
        $fields ["nb_games"] = $nb_games;
        $fields ["day"] = $key;
        $this->helper->debug($fields);

        $url = "https://fr.funizi.com/api/start/358";
        $result = $this->helper->curlPost($url, $fields );
        $this->helper->debug($result);
      }
    }

    public function createForfaitImgOrange($request, $response, $arg)
    {
      $forfaits = [
        [
          "forfait"   =>  "Forfait Journalier",
          "volume"    =>  "5 Mo",
          "code"      =>  "*103*100#",
          "validite"  =>  "le même jour à 23h59"
        ],
        [
          "forfait"   =>  "Forfait Journalier",
          "volume"    =>  "20 Mo",
          "code"      =>  "*103*225#",
          "validite"  =>  "jusqu'au lendemain à 23h59"
        ],
        [
          "forfait"   =>  "Forfait Journalier",
          "volume"    =>  "100 Mo",
          "code"      =>  "*103*525#",
          "validite"  =>  "jusqu'au lendemain à 23h59"
        ],
        [
          "forfait"   =>  "Forfait Journalier",
          "volume"    =>  "500 Mo",
          "code"      =>  "*103*1025#",
          "validite"  =>  "jusqu'au lendemain à 23h59"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "5 Mo",
          "code"      =>  "*103*200#",
          "validite"  =>  "7 jours"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "10 Mo",
          "code"      =>  "*103*250#",
          "validite"  =>  "7 jours"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "30 Mo",
          "code"      =>  "*103*500#",
          "validite"  =>  "7 jours"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "400 Mo",
          "code"      =>  "*103*2025#",
          "validite"  =>  "7 jours"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "65 Mo",
          "code"      =>  "*103*1000#",
          "validite"  =>  "15 jours"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "100 Mo",
          "code"      =>  "*103*1500#",
          "validite"  =>  "1 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "150 Mo",
          "code"      =>  "*103*2000#",
          "validite"  =>  "1 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "1 Go",
          "code"      =>  "*103*5000#",
          "validite"  =>  "1 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "2 Go",
          "code"      =>  "*103*7000#",
          "validite"  =>  "1 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "5 Go",
          "code"      =>  "*103*10000#",
          "validite"  =>  "1 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "10 Go",
          "code"      =>  "*103*19000#",
          "validite"  =>  "2 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "20 Go",
          "code"      =>  "*103*30000#",
          "validite"  =>  "3 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "30 Go",
          "code"      =>  "*103*54000#",
          "validite"  =>  "6 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "60 Go",
          "code"      =>  "*103*100000#",
          "validite"  =>  "1 an"
        ],
        [
          "forfait"   =>  "Forfait Nuit Xtra",
          "volume"    =>  "500 Mo nuit",
          "code"      =>  "*506*500#",
          "validite"  =>  "de 00h à 05h"
        ],
        [
          "forfait"   =>  "Forfait Nuit Xtra",
          "volume"    =>  "1 Go nuit",
          "code"      =>  "*506*1000#",
          "validite"  =>  "de 00h à 05h"
        ]
      ];
      $nb = 1;

      foreach ($forfaits as $key => $value) {
        $url = "https://fr.funizi.com/api/start/390";
        $result = $this->helper->curlPost($url, $value );
        $nb++;
        if($nb == 10) break;
      }

      $this->helper->debug($nb);
    }
}
