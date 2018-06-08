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
    public function devEnv($request, $response, $arg){
        //$maint = time();
        //var_dump($maint);
        $pagecount = $this->test_per_page;
        $alltest = Test::where('statut', '1')->count();

        $pagecount = intval(ceil($alltest/$pagecount));
        if($arg['pageid']){
            $pageid = $arg['pageid'];
            $tests = Test::where('statut', '1')->orderBy('id_test', 'desc')->skip($this->test_per_page*($pageid - 1))->take(6)->get();
        }else{
            $tests = Test::where('statut', '1')->orderBy('id_test', 'desc')->take($this->test_per_page)->get();
            $pageid = 1;
        }
        return $this->view->render($response, 'home.twig', compact('tests', 'pagecount', 'pageid'));
    }
    public function logout($request, $response){

        session_destroy();
        session_unset();
        session_start();
        $_SESSION['user_has_disconnected'] = 'yes';
        // Suppression du fichier cookie
        unset($_COOKIE['id_user']);
        //unset($_COOKIE['email_user']);
        unset($_COOKIE['nom_user']);
        unset($_COOKIE['prenom_user']);
        unset($_COOKIE['url_photo_user']);
        setcookie('id_user', null, -1);
        //setcookie('email_user', null, -1);
        setcookie('nom_user', null, -1);
        setcookie('prenom_user', null, -1);
        setcookie('url_photo_user', null, -1);



        $result_url = $this->router->pathFor('accueil');
        return $response->withStatus(302)->withHeader('Location', $result_url );
    }
    public function login($request, $response){
        $id = $request->getParam('id');
        $email = $request->getParam('email');
        $first_name = $request->getParam('prenom');
        $last_name = $request->getParam('nom');



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
      // code...
      $matchs = AirtableController::getAllMatchs();
      Helper::debug($matchs);

      $matchs_records = json_decode($matchs);
      $nb = 1;
      foreach ($matchs_records as $match) {
        // code...
        Helper::debug($match->id_game);
        Helper::debug($match->team_a->french);

        $fields = [
          'game'          =>  $match->id_game,
          'team_a'        =>  $match->team_a->french,
          'team_b'        =>  $match->team_b->french,
          'team_a_flag'   =>  $match->team_a->flag,
          'team_b_flag'   =>  $match->team_b->flag
        ];
        $url = "https://fr.funizi.com/api/start/358";
        $result = self::curl_post($url, $fields );
        $nb++;
        if($nb == 6) break;
      }

    }


    public static function curl_post($url, $fields=[], $headers=false){

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      curl_setopt($ch, CURLOPT_POST, 1);


         if (is_array($headers))
         {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
         }

         $result = curl_exec($ch);

         if (curl_errno($ch)) {
            curl_close ($ch);
             return false;
         }

         curl_close ($ch);
         return $result;

    }



}
