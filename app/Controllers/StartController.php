<?php
namespace App\Controllers;
use App\Helpers\Helper;
use App\Helpers\SandBox;
use App\Helpers\RandomStringGenerator;
use App\Models\Resultat;
use App\Models\Test;
use App\Models\User;
use App\Models\UserTest;
use App\Models\ThemePerso;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use GrabzItImageOptions;

class StartController extends Controller
{

    /**
     * @param $request
     * @param $response
     * @param $arg
     * @return mixed
     */
    public function index($request, $response, $arg){
        $url = $this->helper->detectLang($request, $response);
        //if($url != "" ) return $response->withStatus(302)->withHeader('Location', $url );

        $lang =$this->helper->getLangSubdomain($request);

        //Helper::debug($_COOKIE);
        if(isset($_GET['next']) && $_GET['next'] == 'on'){
            $next_result = true;
            //Helper::debug($next_result);
        }
        //$ipadd = $request->getAttribute('ip_address');
        $ipadd = $this->helper->getRealUserIp();
        $test_id = $arg['ref'];
        if(isset($_GET['ref']))
          $test_id = intval($_GET['ref']);
        //$country = $arg['country'];
        if($_SESSION['name'] && $_SESSION['name'] !='')
            $name = $_SESSION['name'];
        if($_SESSION['uid'] && $_SESSION['uid'] != '')
            $user_id  = $_SESSION['uid'];
        if($_SESSION['gender'] && $_SESSION['gender'] != '')
        $genre  = $_SESSION['gender'];
        if($_SESSION['last_name'] && $_SESSION['last_name'] != '')
            $last_name = $_SESSION['last_name'];

        //$_SESSION['pic'] = $profile['picture']['url'];
        $_SESSION['user_has_disconnected'] = null;
        //echo $_SESSION['name'];
        $name = $_SESSION['name'];
        $last_name = $_SESSION['last_name'];
        $full_name = $name.' '.$last_name;
        $user_id  = $_SESSION['uid'];
        $genre  = $_SESSION['gender'];
        $tags = array();
        $tags['user_name'] = $name;
        $tags['full_user_name'] = $full_name;

        if(empty($user_id)){
          $log = fopen("ressources/views/log_start_error.txt", "a+");
          $data_log = "\n".date('d/m/Y H:i:s')." Erreur : Données manquantes \nTest : ".$test_id. " - lang : ".$lang."\n";
          $data_log .= "UID : " .$user_id."\n";
          fputs($log, $data_log);
        }

        $user = $this->saveOrUpdate($user_id, $name,$last_name, $genre, $ipadd);
        if($test_id == 0 ){
            $result_url = $this->router->pathFor('accueil');

            $log = fopen("ressources/views/log_start_error.txt", "a+");
            $data_log = "\n".date('H:i:s')." Erreur: Redirection obtenue vers l'accueil \nTest : ".$test_id. " - url : ".$result_url."\n";
            $data_log .= "UID : " .$user_id."\n";
            fputs($log, $data_log);

            return $response->withStatus(302)->withHeader('Location', $result_url );
        }elseif ($test_id == -1){
            $result_url = $request->getUri()->getBaseUrl().'/mytest/create-test.php';
            return $response->withStatus(302)->withHeader('Location', $result_url );
        }else{

          $test = Test::selectRaw('test_info.titre_test AS titre_test, test_info.test_description AS test_description, tests.unique_result AS unique_result, tests.id_theme AS id_theme, tests.id_test AS id_test')
            ->join('test_info','test_info.id_test','tests.id_test')
            ->Where([['tests.id_test', '=', $test_id],['test_info.lang','=',$lang]])->first();

            $test_name = $test->titre_test;
            $theme = $test->id_theme;
            $result_description = $test->test_description;

            try{
                if($test->unique_result == 1) {
                    $user_test = UserTest::where([
                        ['user_id', $user->id],
                        ['test_ids', 0]
                    ])->get();
                }else{
                    $user_test = UserTest::where([
                        ['user_id', $user->id],
                        ['test_id', $test_id]
                    ])->firstOrFail();
                }

            }catch(\Exception $e){
                if($genre == 'male' || $genre == 'homme'){
                    $filter = 'feminin';
                }
                if($genre == 'female' || $genre == 'femme' ){
                    $filter = 'masculin';
                }
                $notIn = [0];
                if($test->unique_result == 1) {
                    $user_test = UserTest::where([
                        ['user_id', $user->id],
                        ['test_id', $test_id]
                    ])->get();

                    foreach ($user_test as $user_tested){
                        $notIn [] = $user_tested->result_id;
                    }
                }
                $result = Resultat::whereNotIn('id_test', $notIn)
                    ->where([
                        ['id_test', '=', $test_id],
                        ['genre', '!=', $filter]
                    ])->orderByRaw("RAND()")->first();
                if(empty($result))
                    $result = Resultat::where([
                            ['id_test', '=', $test_id],
                            ['genre', '!=', $filter]
                        ]
                    )->orderByRaw("RAND()")->first();
                $titre = $result->titre_resultat;
                $image = $result->image_resultat;
                $result_id = $result->id_resultat;
                //$theme = 1;
                //$this->saveOrUpdate($user_id, $name);
                $img = substr($image, strrpos($image, '/') + 1);
                if($theme === 2)
                  $url = SandBox::getUrlTheme1Or2($theme, $user_id, $result_id, $name, $img);
                elseif($theme === 3)
                {
                    $user_posts =  (array) $_SESSION['posts'];
                    $user_friends =  (array) $_SESSION['friends'];
                    $user_photos = (array) $_SESSION['photos'];
                    $url = SandBox::getUrlTheme3($theme, $user_id, $name, $user_posts, $user_friends, $user_photos);
                }
                elseif($theme === 4){
                    $theme_perso_info = ThemePerso::where([['id_test', $test_id],['lang','=',$lang]])->first();

                    $nb_friends_fb =  $theme_perso_info->nb_friends_fb;
                    $max_friends =  $theme_perso_info->max_friends;
                    $best_friends =  $theme_perso_info->best_friends;
                    $args_for_grabzit =array('theme' => $theme, 'fb_id_user' => $user_id, 'user_name' => urlencode($name), 'nb_friends' => $nb_friends_fb );

                    $url = '?user_gender='.$genre.'&fb_id_user='.$user_id.'&user_name='.urlencode($name).'&full_user_name='.urlencode($full_name).'&nb_friends='.$nb_friends_fb;
                    $url_img_profile_user = '&url_img_profile_user='.urlencode('https://graph.facebook.com/'.$user_id.'/picture/?width=275&height=275');
                    $url .= $url_img_profile_user;


                    if($nb_friends_fb > 0){
                        $user_posts =  (array) $_SESSION['posts'];
                        $user_friends =  (array) $_SESSION['friends'];
                        $user_photos = (array) $_SESSION['photos'];

                        if(count($user_posts) > 0){

                            $volume = [];
                            foreach ($user_posts as $key => $row) {
                                $volume[$row['id']]  = $row['freq'];
                            }
                            if($best_friends == 1)
                                  arsort($volume);

                            $user_best_friends_reactions = array_slice($volume, 0, $max_friends, true);

                            $ids = array_rand($user_best_friends_reactions, $nb_friends_fb);
                            $nb_friend = 1;

                            if($nb_friends_fb == 1){
                                $friend_names = explode(" ", $user_posts[$ids]['name']);
                                $prenoms = array_slice($friend_names, 0, count($friend_names)-1,true);
                                $friend_first_name = '';
                                foreach ($prenoms as $val) {
                                    $friend_first_name .= $val.' ';
                                }
                                $url .= '&fb_id_friend_'.$nb_friend.'='.$ids.'&friend_first_name_'.$nb_friend.'='.urlencode($friend_first_name).'&friend_name_'.$nb_friend.'='.urlencode($user_posts[$ids]['name']);

                                $tags['friend_first_name_'.$nb_friend] = $friend_first_name;
                                $tags['friend_name_'.$nb_friend] = $user_posts[$ids]['name'];

                            }
                            else {
                                foreach ($ids as $id) {
                                    $friend_names = explode(" ", $user_posts[$id]['name']);
                                    $prenoms = array_slice($friend_names, 0, count($friend_names)-1,true);
                                    $friend_first_name = '';
                                    foreach ($prenoms as $val) {
                                        $friend_first_name .= $val.' ';
                                    }
                                    $url .= '&fb_id_friend_'.$nb_friend.'='.$id.'&friend_first_name_'.$nb_friend.'='.urlencode($friend_first_name).'&friend_name_'.$nb_friend.'='.urlencode($user_posts[$id]['name']);
                                    $tags['friend_first_name_'.$nb_friend] = $friend_first_name;
                                    $tags['friend_name_'.$nb_friend] = $user_posts[$id]['name'];
                                    $nb_friend++;
                                }
                            }
                            $_SESSION['tags'] = $tags;
                        }
                        elseif(!empty($user_photos)) {

                        }
                    }
                    //$url = "/ressources/views/themes/theme4.php" . $url;
                    $url = SandBox::getUrlTestPerso($test_id ,$url, $lang);
                }
                else
                  $url = SandBox::getUrlTheme1Or2($theme, $user_id, $titre, $name, $img);

                foreach ($tags as $key => $tag) {
                    $result_description = str_replace('{{'.$key.'}}', $tag, $result_description );
                }

                $url = $request->getUri()->getBaseUrl().$url;
                //$url = "http://".$lang.".funizi.com" . $url;

              if($user_id == '1815667808451001'){
                echo $url;
                exit;
              }

                //Generate unique code string for the test result
                $stringen = new RandomStringGenerator();
                $code = $stringen->generate(15);

                // Path of the saved image result
                $filepath = "uploads/". $code . '.jpg';

                //Grabzit Options
                $options = new GrabzItImageOptions();
                //$options->setWidth(600);
                //$options->setHeight(315);
                $options->setBrowserwidth(800);
                $options->setBrowserHeight(420);
                $options->setQuality(90);
                $options->setFormat("jpg");
                //Grab the image result here and save it

                $generated = $this->grabzit->URLToImage($url, $options);
                $save = $this->grabzit->SaveTo($filepath);
                // Saving the test result of user
                $data = [
                    'user_id'               => $user->id,
                    'test_id'               => $test_id,
                    'uuid'                  => $code,
                    'result_id'             => $result_id,
                    'shared_link'           => $code,
                    'result_description'    => $result_description,
                    'img_url'               => "/$filepath",
                    'test_from'             => $_SESSION['referal'],
                    'lang'                  => $lang
                ];
                if($save)
                    $user_test = UserTest::create($data);
            }
            $result_url = $this->router->pathFor('resultat', [
                'name'      => $this->helper->cleanUrl($test_name),
                'code'      =>  $user_test->uuid
            ]);

            $title_url = $this->helper->getUrlTest($test_name, $test_id, $lang);
            $result_url = $request->getUri()->getBaseUrl()."/result/".$this->helper->cleanUrl($title_url)."/".$user_test->uuid ;
        }
        return $response->withStatus(302)->withHeader('Location', $result_url );
    }
    private function saveOrUpdate($id, $name, $lastname, $genre, $ip){
        $country = $this->helper->getCountry($ip);
        try{
            $user_in = User::where('facebook_id', $id)->firstOrFail();
        }catch(\Exception $e){
            $user_in = User::create([
                'first_name'    =>  $name,
                'facebook_id'   =>  $id,
                'last_name'     =>  $lastname,
                'genre'         =>  $genre,
                'ip_address'     =>  $ip,
                'country_code'  =>  $country['countryCode'],
                'country_name'  =>  $country['countryName']

            ]);
        }
        return $user_in;
    }
}
