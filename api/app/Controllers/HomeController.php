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
      $list_countries = array();

      $tests = Test::where('statut', 1)->get();
      $countries = Countries::orderBy('langFR','ASC')->with('users')->take(10)->get();
      $pageid = 1;
      $pagecount = 5;

    return $this->view->render($response, 'home.twig');

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
      foreach ($matchs_records as $match) {

        $fields = array(
          'game'                  =>  $match->id_game,
          'team_a'                =>  $match->team_a->french,
          'team_b'                =>  $match->team_b->french,
          'team_a_flag'           =>  $match->team_a->flag,
          'team_a_country_code'   =>  strtolower($match->team_a->country_code),
          'team_b_flag'           =>  $match->team_b->flag,
          'team_b_country_code'   =>  strtolower($match->team_b->country_code),
          'time'                  =>  '17:00'
        );
        $url = "https://fr.funizi.com/api/start/358";
        $result = $this->helper->curlPost($url, $fields );
        $nb++;
        if($nb == 6) break;
      }
    }

    public function createGameDays($request, $response, $arg)
    {
      // code...
      $game_days = json_decode(AirtableController::getAllGamesDay());
      //$this->helper->debug($game_days);

      foreach ($game_days as $key => $day) {
        $fields = array(
          'games'   =>  $day,
          'day'     =>  $key
        );
        $this->helper->debug($fields);
        $url = "https://fr.funizi.com/api/start/358";
        $result = $this->helper->curlPost($url, $fields );
        $this->helper->debug($result);

      }



    }





}
