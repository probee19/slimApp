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
          "prix"      =>  "100 FCFA",
          "validite"  =>  "le même jour à 23h59"
        ],
        [
          "forfait"   =>  "Forfait Journalier",
          "volume"    =>  "20 Mo",
          "code"      =>  "*103*225#",
          "prix"      =>  "225 FCFA",
          "validite"  =>  "jusqu'au lendemain à 23h59"
        ],
        [
          "forfait"   =>  "Forfait Journalier",
          "volume"    =>  "100 Mo",
          "code"      =>  "*103*525#",
          "prix"      =>  "525 FCFA",
          "validite"  =>  "jusqu'au lendemain à 23h59"
        ],
        [
          "forfait"   =>  "Forfait Journalier",
          "volume"    =>  "500 Mo",
          "code"      =>  "*103*1025#",
          "prix"      =>  "1 025 FCFA",
          "validite"  =>  "jusqu'au lendemain à 23h59"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "5 Mo",
          "code"      =>  "*103*200#",
          "prix"      =>  "200 FCFA",
          "validite"  =>  "7 jours"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "10 Mo",
          "code"      =>  "*103*250#",
          "prix"      =>  "250 FCFA",
          "validite"  =>  "7 jours"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "30 Mo",
          "code"      =>  "*103*500#",
          "prix"      =>  "500 FCFA",
          "validite"  =>  "7 jours"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "400 Mo",
          "code"      =>  "*103*2025#",
          "prix"      =>  "2 025 FCFA",
          "validite"  =>  "7 jours"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "65 Mo",
          "code"      =>  "*103*1000#",
          "prix"      =>  "1 000 FCFA",
          "validite"  =>  "15 jours"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "100 Mo",
          "code"      =>  "*103*1500#",
          "prix"      =>  "1 500 FCFA",
          "validite"  =>  "1 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "150 Mo",
          "code"      =>  "*103*2000#",
          "prix"      =>  "2 000 FCFA",
          "validite"  =>  "1 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "1 Go",
          "code"      =>  "*103*5000#",
          "prix"      =>  "5 000 FCFA",
          "validite"  =>  "1 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "2 Go",
          "code"      =>  "*103*7000#",
          "prix"      =>  "7 000 FCFA",
          "validite"  =>  "1 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "5 Go",
          "code"      =>  "*103*10000#",
          "prix"      =>  "10 000 FCFA",
          "validite"  =>  "1 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "10 Go",
          "code"      =>  "*103*19000#",
          "prix"      =>  "19 000 FCFA",
          "validite"  =>  "2 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "20 Go",
          "code"      =>  "*103*30000#",
          "prix"      =>  "30 000 FCFA",
          "validite"  =>  "3 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "30 Go",
          "code"      =>  "*103*54000#",
          "prix"      =>  "54 000 FCFA",
          "validite"  =>  "6 mois"
        ],
        [
          "forfait"   =>  "Forfait Classique",
          "volume"    =>  "60 Go",
          "code"      =>  "*103*100000#",
          "prix"      =>  "100 000 FCFA",
          "validite"  =>  "1 an"
        ],
        [
          "forfait"   =>  "Forfait Nuit Xtra",
          "volume"    =>  "500 Mo nuit",
          "code"      =>  "*506*500#",
          "prix"      =>  "500 FCFA",
          "validite"  =>  "de 00h à 05h"
        ],
        [
          "forfait"   =>  "Forfait Nuit Xtra",
          "volume"    =>  "1 Go nuit",
          "code"      =>  "*506*1000#",
          "prix"      =>  "1 000 FCFA",
          "validite"  =>  "de 00h à 05h"
        ]
      ];
      $nb = 1;

      $forfaits_yam =  [
        [
         "forfait"   =>  "Son's Yam_1500",
         "volume"    =>  "120min",
         "code"      =>  "*106*1500#",
         "prix"      =>  "1 500 FCFA",
         "validite"  =>  "7 jours"
       ],
       [
         "forfait"   =>  "Son's Yam_1000",
         "volume"    =>  "90min",
         "code"      =>  "*106*1000#",
         "prix"      =>  "1 000 FCFA",
         "validite"  =>  "3 jours"
       ],
       [
         "forfait"   =>  "Son's Yam_700",
         "volume"    =>  "1h",
         "code"      =>  "*106*700#",
         "prix"      =>  "700 FCFA",
         "validite"  =>  "2 jours"
       ],
       [
         "forfait"   =>  "Son's Yam_400",
         "volume"    =>  "30min",
         "code"      =>  "*106*400#",
         "prix"      =>  "400 FCFA",
         "validite"  =>  "1 jour"
       ],
       [
         "forfait"   =>  "Son's Yam_120",
         "volume"    =>  "5min + 5sms <br> + 5Mo",
         "code"      =>  "*106*120#",
         "prix"      =>  "120 FCFA",
         "validite"  =>  "1 jour"
       ],
       [
         "forfait"   =>  "Son's Yam_100",
         "volume"    =>  "3min + 5sms <br> + 5Mo",
         "code"      =>  "*106*100#",
         "prix"      =>  "100 FCFA",
         "validite"  =>  "1 jour"
       ],

       [
         "forfait"   =>  "Son's Yam_500",
         "volume"    =>  "30min + 30sms <br> + 30Mo",
         "code"      =>  "*106*500#",
         "prix"      =>  "500 FCFA",
         "validite"  =>  "1 jour"
       ],
     ];

      for ($i = $arg['begin']; $i < $arg['end']; $i++) {
        if(isset($forfaits_yam[$i])){
          $url = "https://fr.funizi.com/api/start/390";
          $result = $this->helper->curlPost($url, $forfaits_yam[$i]);
          $nb++;
        }
        else
          break;
      }

      $this->helper->debug($nb);
    }
}
