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

        $lang = $this->helper->getLangSubdomain($request);

        //Helper::debug($_COOKIE);
        if(isset($_GET['next']) && $_GET['next'] == 'on'){
            $next_result = true;
            //Helper::debug($next_result);
        }
        //$ipadd = $request->getAttribute('ip_address');
        $ipadd = $this->helper->getRealUserIp();
        $test_id = $arg['ref'];
        if(isset($_GET['ref']))
          $test_id = (int)$_GET['ref'];
        //$country = $arg['country'];
        $genre = ""; $user_id = 0;
        $last_name = ''; $name = '';

        if(isset($_COOKIE['last_name']) && $_COOKIE['last_name'] !='')
            $last_name = $_COOKIE['last_name'];
        if(isset($_COOKIE['name']) && $_COOKIE['name'] !='')
            $name = $_COOKIE['name'];
        if(isset($_COOKIE['uid']) && $_COOKIE['uid'] != '')
            $user_id  = $_COOKIE['uid'];
        if(isset($_COOKIE['gender']) && $_COOKIE['gender'] != '')
            $genre  = $_COOKIE['gender'];

        $_SESSION['user_has_disconnected'] = null;
        $full_name = $name.' '.$last_name;
        $tags = array();
        $tags['user_name'] = $name;
        $tags['full_user_name'] = $full_name;

        if(empty($user_id)){
          $log = fopen("ressources/views/log_start_error.txt", "a+");
          $data_log = "\n".date('d/m/Y H:i:s')." Erreur : Données manquantes \nTest : ".$test_id. " - lang : ".$lang."\n";
          $data_log .= "UID : " .$user_id."\n";
          fwrite($log, $data_log);
        }

        $user = $this->saveOrUpdate($user_id, $name, $last_name, $genre, $ipadd);
        if($test_id == 0 ){
            $result_url = $this->router->pathFor('accueil');

            $log = fopen("ressources/views/log_start_error.txt", "a+");
            $data_log = "\n".date('H:i:s')." Erreur: Redirection obtenue vers l'accueil \nTest : ".$test_id. " - url : ".$result_url."\n";
            $data_log .= "UID : " .$user_id."\n";
            fwrite($log, $data_log);

            return $response->withStatus(302)->withHeader('Location', $result_url );
        }elseif ($test_id == -1){
            $result_url = $request->getUri()->getBaseUrl().'/mytest/create-test.php';
            return $response->withStatus(302)->withHeader('Location', $result_url );
        }else{

            /*
              $test = Test::on('reader')->selectRaw('test_info.titre_test AS titre_test, test_info.test_description AS test_description, tests.has_treatment AS has_treatment, tests.unique_result AS unique_result, tests.if_additionnal_info AS if_additionnal_info, tests.id_theme AS id_theme, tests.id_test AS id_test')
              ->join('test_info','test_info.id_test','tests.id_test')
              ->Where([['tests.id_test', '=', $test_id],['test_info.lang','=',$lang]])->first();

              $test_name = $test->titre_test;
              $theme = $test->id_theme;
              $result_description = $test->test_description;
              $if_additionnal_info = $test->if_additionnal_info;
              $has_treatment = $test->has_treatment;
            */

            $tests_from_json = $this->helper->getAllTestJson($lang, true);
            $test  = $tests_from_json[$test_id];

            $test_name = $test['titre_test'];
            $theme = $test['id_theme'];
            $result_description = $test['test_description'];
            $if_additionnal_info = $test['if_additionnal_info'];
            $has_treatment = $test['has_treatment'];
            $unique_result = $test['unique_result'];

            //try{
                //if($test->unique_result == 1) {
                    //$user_test = UserTest::where([
                        //['user_id', $user->id],
                        //['test_ids', 0]
                    //])->get();
                //}else{
                    //$user_test = UserTest::where([
                        //['user_id', $user->id],
                        //['test_id', $test_id]
                    //])->firstOrFail();
                //}

            //}catch(\Exception $e){
              $filter = "";
                if($genre == 'male' || $genre == 'homme'){
                    $filter = 'feminin';
                }
                if($genre == 'female' || $genre == 'femme' ){
                    $filter = 'masculin';
                }
                $notIn = [0];
                if($unique_result == 1) {
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
                    //
                    $url_img_profile = 'https://graph.facebook.com/'.$user_id.'/picture/?width=275&height=275';
                    /*
                    if(isset($_SESSION['url_pic_profile']))
                      $url_img_profile = $_SESSION['url_pic_profile'];
                    else{
                      $url_img_profile = SandBox::getProfilePic($user_id, $_SESSION['fb_access_token']);
                      $_SESSION['url_pic_profile'] = $url_img_profile;
                    }
                    */


                    //$url_img_profile_user = '&url_img_profile_user='.urlencode('https://graph.facebook.com/'.$user_id.'/picture/?width=275&height=275');
                    $url_img_profile_user = '&url_img_profile_user='.urlencode($url_img_profile);
                    $additionnal_input_text = ''; $additionnal_input_country_cdm = '';

                    if( $if_additionnal_info == 1){
                      if(isset($_SESSION['url_img_profile_user']) && $_SESSION['url_img_profile_user'] != 'unset'){
                        $url_img_profile_user = '&url_img_profile_user='.urlencode($_SESSION['url_img_profile_user']);
                        $url_img_profile = $_SESSION['url_img_profile_user'];
                        $_SESSION['url_img_profile_user'] = 'unset';
                      }

                      if(isset($_SESSION['additionnal_input_text']))
                        $additionnal_input_text = '&additionnal_input_text='.urlencode($_SESSION['additionnal_input_text']);

                      if(isset($_SESSION['fav_team'])){
                        $fav_team = json_decode($_SESSION['fav_team']);
                        foreach ($fav_team as $key => $value)
                          if($key != 'cf') //CountryFlag
                            $additionnal_input_country_cdm .= '&'.$key.'='.$value;

                      }

                    }

                    if($has_treatment == 1 ) {
                      $result_cmf = $this->helper->cmfTreatmentImg($url_img_profile);
                      if($result_cmf[0] == 1)
                        $url_img_profile_user = '&url_img_profile_user='.urlencode($result_cmf[1]).'&url_img_profile_user0='.urlencode($url_img_profile);
                      else{
                        $this->flash->addMessage('imgface', $result_cmf[1]);
                        $url_back = $request->getUri()->getBaseUrl()."/start/1/".$test_id;
                        return $response->withStatus(302)->withHeader('Location', $url_back );
                        exit;
                      }
                    }
                    $url .= $url_img_profile_user . $additionnal_input_text . $additionnal_input_country_cdm;

                    //
                    if($nb_friends_fb > 0){
                        $user_posts =  (array) $_SESSION['posts'];
                        $user_friends =  (array) $_SESSION['friends'];
                        $user_photos = (array) $_SESSION['photos'];

                        if(!empty($user_posts) && count($user_posts) > $nb_friends_fb ){

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
                        elseif(!empty($user_friends) ) {

                            shuffle($user_friends);
                            $user_friends_selected = array_slice($user_friends, 0, $nb_friends_fb, true);

                            $nb_friend = 1;
                            if($nb_friends_fb == 1){
                              $url .= '&fb_id_friend_'.$nb_friend.'='.$user_friends_selected[0]['id'].'&friend_first_name_'.$nb_friend.'='.urlencode($user_friends_selected[0]['first_name']).'&friend_name_'.$nb_friend.'='.urlencode($user_friends_selected[0]['first_name'].' '.$user_friends_selected[0]['last_name']);
                              $tags['friend_first_name_'.$nb_friend] = $user_friends_selected[0]['first_name'] ;
                              $tags['friend_name_'.$nb_friend] = $user_friends_selected[0]['first_name'].' '.$user_friends_selected[0]['last_name'];

                            }
                            else {
                              foreach ($user_friends_selected as $friend) {
                                $url .= '&fb_id_friend_'.$nb_friend.'='.$friend['id'].'&friend_first_name_'.$nb_friend.'='.urlencode($friend['first_name']).'&friend_name_'.$nb_friend.'='.urlencode($friend['first_name'].' '.$friend['last_name']);
                                $tags['friend_first_name_'.$nb_friend] = $friend['first_name'] ;
                                $tags['friend_name_'.$nb_friend] = $friend['first_name'].' '.$friend['last_name'];
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
                  //echo $url;
                  //exit;

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
                $options->setQuality(80);
                $options->setFormat("jpg");
                //Grab the image result here and save it

                $generated = $this->grabzit->URLToImage($url, $options);
                $save = $this->grabzit->SaveTo($filepath);
                // Saving the test result of user
                $referal = 'direct';
                if(isset($_SESSION['referal'])) $referal = $_SESSION['referal'];

                $data = [
                    'user_id'               => $user->id,
                    'test_id'               => $test_id,
                    'uuid'                  => $code,
                    'result_id'             => $result_id,
                    'shared_link'           => $code,
                    'result_description'    => $result_description,
                    'test_from'             => $referal,
                    'lang'                  => $lang,
                    'ab_testing'            => $this->helper->getAB() // for A/B Testing
                ];


                if($save){
                    $filepath = "https://".$this->base_domain."/uploads/". $code . '.jpg';
                    $resultUrl = $this->helper->uploadToS3($filepath, 'uploads/');
                }

                if(!empty($resultUrl['ObjectURL'])){
                    $data['img_url'] = "/uploads/$code.jpg";
                    $user_test = UserTest::create($data);
                }else{
                    echo "Une erreur inattendue s'est produite, veuillez réessayer encore";
                    exit;
                }
            //}


            $result_url = $this->router->pathFor('resultat', [
                'name'      => $this->helper->cleanUrl($test_name),
                'code'      =>  $user_test->uuid
            ]);

            $title_url = $this->helper->getUrlTest($test_name, $test_id, $lang);
            $result_url = $request->getUri()->getBaseUrl()."/result/".$this->helper->cleanUrl($title_url)."/".$user_test->uuid ;
        }
        return $response->withStatus(302)->withHeader('Location', $result_url );
    }

    public function indexChunk($request, $response, $arg){
        $url = $this->helper->detectLang($request, $response);
        $lang = $this->helper->getLangSubdomain($request);
        if(isset($_GET['next']) && $_GET['next'] == 'on')
            $next_result = true;

        $ipadd = $this->helper->getRealUserIp();
        $test_id = $arg['ref'];
        if(isset($_GET['ref']))
          $test_id = (int)$_GET['ref'];

        $genre = ""; $user_id = 0;
        $last_name = ''; $name = '';

        if(isset($_COOKIE['last_name']) && $_COOKIE['last_name'] !='')
            $last_name = $_COOKIE['last_name'];
        if(isset($_COOKIE['name']) && $_COOKIE['name'] !='')
            $name = $_COOKIE['name'];
        if(isset($_COOKIE['uid']) && $_COOKIE['uid'] != '')
            $user_id  = $_COOKIE['uid'];
        if(isset($_COOKIE['gender']) && $_COOKIE['gender'] != '')
            $genre  = $_COOKIE['gender'];

        $_SESSION['user_has_disconnected'] = null;
        $full_name = $name.' '.$last_name;
        $tags = array();
        $tags['user_name'] = $name;
        $tags['full_user_name'] = $full_name;

        $user = $this->saveOrUpdate($user_id, $name, $last_name, $genre, $ipadd);

        $tests_from_json = $this->helper->getAllTestJson($lang, true);
        $test  = $tests_from_json[$test_id];

        $test_name = $test['titre_test'];
        $theme = $test['id_theme'];
        $result_description = $test['test_description'];
        $if_additionnal_info = $test['if_additionnal_info'];
        $has_treatment = $test['has_treatment'];
        $unique_result = $test['unique_result'];

          $filter = "";
            if($genre == 'male' || $genre == 'homme'){
                $filter = 'feminin';
            }
            if($genre == 'female' || $genre == 'femme' ){
                $filter = 'masculin';
            }
            $notIn = [0];
            if($unique_result == 1) {
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
                //
                $url_img_profile = 'https://graph.facebook.com/'.$user_id.'/picture/?width=275&height=275';

                $url_img_profile_user = '&url_img_profile_user='.urlencode($url_img_profile);
                $additionnal_input_text = ''; $additionnal_input_country_cdm = '';

                if( $if_additionnal_info == 1){
                  if(isset($_SESSION['url_img_profile_user']) && $_SESSION['url_img_profile_user'] != 'unset'){
                    $url_img_profile_user = '&url_img_profile_user='.urlencode($_SESSION['url_img_profile_user']);
                    $url_img_profile = $_SESSION['url_img_profile_user'];
                    $_SESSION['url_img_profile_user'] = 'unset';
                  }

                  if(isset($_SESSION['additionnal_input_text']))
                    $additionnal_input_text = '&additionnal_input_text='.urlencode($_SESSION['additionnal_input_text']);

                  if(isset($_SESSION['fav_team'])){
                    $fav_team = json_decode($_SESSION['fav_team']);
                    foreach ($fav_team as $key => $value)
                      if($key != 'cf') //CountryFlag
                        $additionnal_input_country_cdm .= '&'.$key.'='.$value;
                  }
                }

                if($has_treatment == 1 ) {
                  $result_cmf = $this->helper->cmfTreatmentImg($url_img_profile);
                  if($result_cmf[0] == 1)
                    $url_img_profile_user = '&url_img_profile_user='.urlencode($result_cmf[1]).'&url_img_profile_user0='.urlencode($url_img_profile);
                  else{
                    $this->flash->addMessage('imgface', $result_cmf[1]);
                    $url_back = $request->getUri()->getBaseUrl()."/start/1/".$test_id;
                    return $response->withStatus(302)->withHeader('Location', $url_back );
                    exit;
                  }
                }
                $url .= $url_img_profile_user . $additionnal_input_text . $additionnal_input_country_cdm;
                //
                if($nb_friends_fb > 0){
                    $user_posts =  (array) $_SESSION['posts'];
                    $user_friends =  (array) $_SESSION['friends'];
                    $user_photos = (array) $_SESSION['photos'];

                    if(!empty($user_posts) && count($user_posts) > $nb_friends_fb ){

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
                    elseif(!empty($user_friends) ) {
                        shuffle($user_friends);
                        $user_friends_selected = array_slice($user_friends, 0, $nb_friends_fb, true);
                        $nb_friend = 1;
                        if($nb_friends_fb == 1){
                          $url .= '&fb_id_friend_'.$nb_friend.'='.$user_friends_selected[0]['id'].'&friend_first_name_'.$nb_friend.'='.urlencode($user_friends_selected[0]['first_name']).'&friend_name_'.$nb_friend.'='.urlencode($user_friends_selected[0]['first_name'].' '.$user_friends_selected[0]['last_name']);
                          $tags['friend_first_name_'.$nb_friend] = $user_friends_selected[0]['first_name'] ;
                          $tags['friend_name_'.$nb_friend] = $user_friends_selected[0]['first_name'].' '.$user_friends_selected[0]['last_name'];
                        }
                        else {
                          foreach ($user_friends_selected as $friend) {
                            $url .= '&fb_id_friend_'.$nb_friend.'='.$friend['id'].'&friend_first_name_'.$nb_friend.'='.urlencode($friend['first_name']).'&friend_name_'.$nb_friend.'='.urlencode($friend['first_name'].' '.$friend['last_name']);
                            $tags['friend_first_name_'.$nb_friend] = $friend['first_name'] ;
                            $tags['friend_name_'.$nb_friend] = $friend['first_name'].' '.$friend['last_name'];
                            $nb_friend++;
                          }
                        }
                        $_SESSION['tags'] = $tags;
                    }
                    elseif(!empty($user_photos)) {
                    }
                }
                $url = SandBox::getUrlTestPerso($test_id ,$url, $lang);
            }
            else
              $url = SandBox::getUrlTheme1Or2($theme, $user_id, $titre, $name, $img);

            foreach ($tags as $key => $tag) {
                $result_description = str_replace('{{'.$key.'}}', $tag, $result_description );
            }

            $url = $request->getUri()->getBaseUrl().$url;

            if($user_id == '1815667808451001'){
              //echo $url;
              //exit;
            }
            //Generate unique code string for the test result
            $stringen = new RandomStringGenerator();
            $code = $stringen->generate(15);

            // Path of the saved image result
            $filepath = "uploads/". $code . '.jpg';

            //
            $callBackrUrl = $request->getUri()->getBaseUrl()."/thumcallback/".$code;
            $version = '';
            if($theme === 4)
              $version = '&v='.mt_rand(0,10);

            $url_thum = 'http://image.thum.io/get/auth/1922-Go/allowJPG/noanimate/prefetch/width/800/crop/420/viewportWidth/800/?url='.urlencode($url).$version.'&callbackUrl='.urlencode($callBackrUrl);
            $this->helper->curl_get_fields($url_thum, []);
            $url_thum_without_call_back = 'http://image.thum.io/get/auth/1922-Go/allowJPG/noanimate/width/800/crop/420/viewportWidth/800/?url='.urlencode($url).$version;
            //


            // Saving the test result of user
            $referal = 'direct';
            if(isset($_SESSION['referal'])) $referal = $_SESSION['referal'];

            $data = [
                'user_id'               => $user->id,
                'test_id'               => $test_id,
                'uuid'                  => $code,
                'result_id'             => $result_id,
                'shared_link'           => $code,
                'result_description'    => $result_description,
                'test_from'             => $referal,
                'lang'                  => $lang,
                'ab_testing'            => $this->helper->getAB() // for A/B Testing
            ];

            /*

            $ch = curl_init($url_thum);
            $fp = fopen('uploads/'.$code.'.jpg', 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            $filepath = "https://".$this->base_domain."/uploads/". $code . '.jpg';
            $resultUrl = $this->helper->uploadToS3($filepath, 'uploads/');

            if(!empty($resultUrl['ObjectURL'])){
                $data['img_url'] = "/uploads/$code.jpg";
                $user_test = UserTest::create($data);
            }else{
                echo "Une erreur inattendue s'est produite, veuillez réessayer encore";
                exit;
            }
            **/

            $data['img_url'] = "/uploads/$code.jpg";
            $data['url_thum_io'] = $url_thum_without_call_back;
            $user_test = UserTest::create($data);

        $result_url = $this->router->pathFor('resultat', [
            'name'      => $this->helper->cleanUrl($test_name),
            'code'      =>  $user_test->uuid
        ]);

        $title_url = $this->helper->getUrlTest($test_name, $test_id, $lang);
        $result_url = $request->getUri()->getBaseUrl()."/chunkresult/".$this->helper->cleanUrl($title_url)."/".$user_test->uuid ;

        return $response->withStatus(302)->withHeader('Location', $result_url );
    }

    public function thumCallBack($request, $response, $arg)
    {
      $urlSuffix = $_GET['urlSuffix'];
      $code = $arg['code'];
      //$originalUrl = ;
      $url_thum = "http://image.thum.io/get/auth/1922-Go/crop/420".$urlSuffix;
      $ch = curl_init($url_thum);
      $fp = fopen('uploads/'.$code.'.jpg', 'wb');
      curl_setopt($ch, CURLOPT_FILE, $fp);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_exec($ch);
      curl_close($ch);
      fclose($fp);

      $filepath = "https://".$this->base_domain."/uploads/". $code . '.jpg';
      $resultUrl = $this->helper->uploadToS3($filepath, 'uploads/');

    }

    private function saveOrUpdate($id, $name, $lastname, $genre, $ip){
        $country = $this->helper->getCountry($ip);
        try{
            $user_in = User::on('reader')->where('facebook_id', $id)->firstOrFail();
        }catch(\Exception $e){
            $user_in = User::create([
                'first_name'    =>  $name,
                'facebook_id'   =>  $id,
                'last_name'     =>  $lastname,
                'genre'         =>  $genre,
                'ip_address'    =>  $ip,
                'country_code'  =>  $country['countryCode'],
                'country_name'  =>  $country['countryName'],
            ]);
        }
        return $user_in;
    }
}
