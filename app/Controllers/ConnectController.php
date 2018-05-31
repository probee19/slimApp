<?php


namespace App\Controllers;
use App\Helpers\Helper;
use App\Models\Test;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class ConnectController extends Controller
{

    public function index($request, $response){
        $id = $request->getParam('id');
        $name = $request->getParam('prenom');
        $lastname = $request->getParam('nom');
        //$email = $request->getParam('email');
        $gender = $request->getParam('genre');

        $friends = $request->getParam('friends');
        $photos = $request->getParam('photos');
        $posts = $request->getParam('posts');


        $_SESSION['uid'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['last_name'] = $lastname;

        if($friends != ''){
            $_SESSION['friends'] = $friends;
        }
        if($photos != ''){
            $_SESSION['photos'] = $photos;
        }
        if($posts != ''){
            $_SESSION['posts'] = $posts;
        }


        if(!empty($friends) || !empty($photos) || !empty($posts)){
            $_SESSION['accepted'] = true ;
        }
        else {
            $_SESSION['accepted'] = false ;
        }

        //$posts_json =  json_decode($_SESSION['posts']);

        //$friends_json = json_decode($_SESSION['friends']);
        //$photos_json[0]->from->name
        //$_SESSION['email'] = $email;
        $_SESSION['gender'] = $gender;
        $data = [$id, $name, $lastname, $gender, $_SESSION['friends'], $_SESSION['photos'], $_SESSION['posts'], $_SESSION['fb_access_token'] ];
        return $response->withStatus(201)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($data));
    }

    public function connexionForTest($request, $response, $arg)
    {
        $help = new Helper();
        $state = json_decode($_GET['state']);
        $permission_test = $state->permission;
        $id = $state->id;
        //$lang = $request->getParam('lang');
        $lang = Helper::getLangSubdomain($request);

        $helper = $this->fb->getRedirectLoginHelper();

        $_SESSION['FBRLH_state'] = $_GET['state'];

        $maxFriends_per_list = 30;
        $name = '';
        $error = ''; $permissions_Ok = true;
        $test = Test::selectRaw('test_info.titre_test AS titre_test, tests.if_additionnal_info AS if_additionnal_info,  tests.permissions AS permissions, tests.id_test AS id_test')
          ->join('test_info','test_info.id_test','tests.id_test')
          ->Where([['tests.id_test', '=', $id],['test_info.lang','=',$lang]])->first();
        $permisions_test = $test->permissions;
        $if_additionnal_info = $test->if_additionnal_info;
        $result_url = $this->router->pathFor('single', [ 'id' => $test->id_test, 'name' => Helper::cleanUrl($test->titre_test)  ] );
        try {
          $accessToken = $helper->getAccessToken();

        } catch(FacebookResponseException $e) {
          // When Graph returns an error
          $error .= 'Graph returned an error: ' . $e->getMessage();
          //exit;
          $log = fopen("ressources/views/log_fb_connect_error.txt", "a+");
          $data_log = "\n".date('d/m/Y H:i:s')." -> Erreur : ".$error."\n";
          $data_log .= "Langue : ".$lang."\n";
          $data_log .= "Test : ".$test->id_test."\n";
          fputs($log, $data_log);

        } catch(FacebookSDKException $e) {
          // When validation fails or other local issues
          $error .= 'Facebook SDK returned an error: ' . $e->getMessage();
          //exit;
          $log = fopen("ressources/views/log_fb_connect_error.txt", "a+");
          $data_log = "Erreur : ".$error."\n";
          fputs($log, $data_log);
        }
        if(isset($accessToken)) {
            //$help->debug($accessToken->getValue());

            // Logged in!
            $this->fb->setDefaultAccessToken($accessToken);
            try {
              // Returns a `Facebook\FacebookResponse` object


              //$accessToken->getValue()
              $response_fb_user = $this->fb->get('/me?fields=id,name,first_name,last_name,gender', $accessToken->getValue());

            } catch(FacebookResponseException $e) {
              $error .= 'Graph returned an error: ' . $e->getMessage();
              exit;
            } catch(FacebookSDKException $e) {
              $error .= 'Facebook SDK returned an error: ' . $e->getMessage();
              exit;
            }

            $user = $response_fb_user->getGraphUser();
            $name = $user->getFirstName();

            $_SESSION['uid'] = $user->getId();
            $_SESSION['name'] = $user->getFirstName();
            $_SESSION['last_name'] = $user->getLastName();
            $_SESSION['gender'] = $user->getGender();


            // Obtention des permissions
            if($permission_test == 1 && $permisions_test == 1){
                try {
                    // Check permissions
                    $response_fb = $this->fb->get('me/permissions', $accessToken->getValue());
                    $permissions = $response_fb->getDecodedBody();
                    $all_permissions = $permissions['data'];
                    for ($i=0, $iMax = count($all_permissions); $i < $iMax; $i++) {
                        if(($all_permissions[$i]['permission'] == 'user_friends' || $all_permissions[$i]['permission'] == 'user_photos' || $all_permissions[$i]['permission'] == 'user_posts' ) && $all_permissions[$i]['status'] == 'declined' ){
                           $permissions_Ok = false;
                       }
                    }
                    if($permissions_Ok){
                      // Get friends from  user_friends
                        $response_friends = $this->fb->get('me/friends?fields=id,first_name,last_name,gender', $accessToken->getValue());
                        $all_friends = $response_friends->getDecodedBody();
                        $friends = $all_friends['data']; $user_friends = [];
                        foreach ($friends as $key => $value) {
                            $this_friend = [
                                "id" => $friends[$key]['id'],
                                "first_name" => $friends[$key]['first_name'],
                                "last_name" => $friends[$key]['last_name'],
                                "gender" => $friends[$key]['gender']
                            ];
                            $user_friends[$value['id']] = $this_friend;
                        }

                     // Get friends from user_posts
                        $response_posts = $this->fb->get('me/posts?fields=reactions{id,name}', $accessToken->getValue());
                        $pagesEdge = $response_posts->getGraphEdge();
                        $friendCount = 0;
                        $user_posts = [];
                        do {
                          foreach ($pagesEdge as $page) {
                            if (isset($page['reactions'])  && $friendCount < $maxFriends_per_list  ) {
                                $reactions = $page['reactions'];
                                foreach ($reactions as $key => $value) {
                                    if($friendCount < $maxFriends_per_list && $value['id'] != $_SESSION['uid']){
                                        $k = array_search($value['id'], array_column($user_posts, 'id'));
                                        if (!$k) {
                                            $this_reaction = [
                                                "id" => $value['id'],
                                                "name" => $value['name'],
                                                "freq" => 1
                                            ];
                                            $user_posts[$value['id']] = $this_reaction;
                                            $friendCount++;
                                        }
                                        else {
                                            $freq = $user_posts[$value['id']]["freq"] + 1;
                                            $user_posts[$value['id']]["freq"] = $freq;
                                        }
                                    }
                                    if($friendCount >= $maxFriends_per_list) break;
                                }
                            }
                          }
                        } while ($friendCount < $maxFriends_per_list && $pagesEdge = $this->fb->next($pagesEdge));

                        // Get friends from user_photos
                        $response_photos = $this->fb->get('me/photos?fields=from{id,first_name,last_name},reactions{id,name}', $accessToken->getValue());
                        $pagesEdge = $response_photos->getGraphEdge();
                        $friendCount = 0;
                        $user_photos = [];
                        do {
                          foreach ($pagesEdge as $page) {
                            if ($page['from']['id'] == $_SESSION['uid']  && isset($page['reactions']) && $friendCount < $maxFriends_per_list  ) {
                                $reactions = $page['reactions'];
                                foreach ($reactions as $key => $value) {
                                    if($friendCount < $maxFriends_per_list && $value['id'] != $_SESSION['uid']){
                                        $k = array_search($value['id'], array_column($user_photos, 'id'));
                                        if (!$k) {
                                            $this_reaction = [
                                                "id" => $value['id'],
                                                "name" => $value['name'],
                                                "freq" => 1
                                            ];
                                            $user_photos[$value['id']] = $this_reaction;
                                            $friendCount++;
                                        }
                                        else {
                                            $freq = $user_photos[$value['id']]["freq"] + 1;
                                            $user_photos[$value['id']]["freq"] = $freq;
                                        }
                                    }
                                    if($friendCount >= $maxFriends_per_list) break;
                                }
                            }
                          }
                        } while ($friendCount < $maxFriends_per_list && $pagesEdge = $this->fb->next($pagesEdge));


                        if(!empty($user_friends)){
                            $_SESSION['friends'] = $user_friends;
                        }
                        if(!empty($user_photos)){
                            $_SESSION['photos'] = $user_photos;
                        }
                        if(!empty($user_posts)){
                            $_SESSION['posts'] = $user_posts;
                        }
                            $_SESSION['accepted'] = true ;
                    }
                    else {
                        //
                        $_SESSION['accepted'] = false ;
                        $this->flash->addMessage('fberror', 'Les autorisations suivantes sont nécessaires pour effectuer  ce test : Liste d\'amis, Publications, Photos . Veuillez accorder les autorisations pour continuer.');
                        return $response->withStatus(302)->withHeader('Location', $result_url );
                        //$help->debug($result_url);
                        exit;
                    }
                } catch(FacebookResponseException $e) {
                  $error .= 'Graph returned an error: ' . $e->getMessage();
                  exit;
                } catch(FacebookSDKException $e) {
                  $error .= 'Facebook SDK returned an error: ' . $e->getMessage();
                  exit;
                }
            }

            if($if_additionnal_info == 0)
              $url = 'https://'.$lang.'.'.$this->base_domain.'/start/'.$id;
            else
              $url = 'https://'.$lang.'.'.$this->base_domain.'/start/1/'.$id;



            $_SESSION['fb_access_token'] = (string) $accessToken;

        }
        elseif ($helper->getError()) {
           // The user denied the request
           $this->flash->addMessage('fberror', 'La connexion à Facebook est necessaire pour effectuer ce test. Veuillez accorder les autorisations pour continuer.');
           return $response->withStatus(302)->withHeader('Location', $result_url );
           exit;
          }
        //$help->debug($url);

        return $response->withStatus(302)->withHeader('Location', $url  );

    }

    public function test($request, $response, $arg){



    }


}
