<?php
namespace App\Controllers;
use App\Helpers\Helper;
use App\Helpers\RandomStringGenerator;
use App\Models\Resultat;
use App\Models\Test;
use App\Models\User;
use App\Models\UserTest;
use App\Models\BotTests;
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
    public function index($request, $response, $arg)
    {
        $name = '';
        $test_id = $arg['ref'];
        if(isset($_POST['first_name'])){
            $name  = $_POST['first_name'];
            $img_profile  = $_POST['profile_pic_url'];
        }
        elseif(isset($_POST['prenom_user_friend'])){
            $name  = $_POST['prenom_user_friend'];
            $img_profile = "http://creation.funizi.com/images/user-default.jpg";
        }

        if(isset($_POST['last_name']))
            $last_name  = $_POST['last_name'];
        else
            $last_name  = "";

        $full_name = $name.' '.$last_name;

        if(isset($_POST['gender']))
            $genre  = $_POST['gender'];
        else
            $genre  = "";

        if(isset($_POST['messenger_user_id']))
            $user_id  = $_POST['messenger_user_id'];
        else
            $user_id  = 0;



        $tags = array();
        $tags['user_name'] = $name;
        $tags['full_user_name'] = $full_name;

        //$user = $this->saveOrUpdate($user_id, $name,$last_name, $genre, $ipadd);
        if($test_id == 0 ){
            $result_url = $this->router->pathFor('accueil');
            return $response->withStatus(302)->withHeader('Location', $result_url );
        }elseif ($test_id == -1){
            $result_url = 'http://www.funizi.com/mytest/create-test.php';
            return $response->withStatus(302)->withHeader('Location', $result_url );
        }else{
            $test = Test::where('id_test', $test_id)->first();
            $test_name = $test->titre_test;
            $theme = $test->id_theme;
            $result_description = $test->test_description;

                if($genre == 'male' || $genre == 'homme'){
                    $filter = 'feminin';
                }
                if($genre == 'female' || $genre == 'femme' ){
                    $filter = 'masculin';
                }
                $notIn = [0];

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



            ///




                $theme_perso_info = ThemePerso::where('id_test', $test_id)->first();
                $code_php = $theme_perso_info->code_php;
                $code_css = $theme_perso_info->code_css;
                $code_js = $theme_perso_info->code_js;
                $code_head = $theme_perso_info->code_head;
                $code_bottom = $theme_perso_info->code_bottom;
                $nb_friends_fb =  $theme_perso_info->nb_friends_fb;
                $max_friends =  $theme_perso_info->max_friends;
                $best_friends =  $theme_perso_info->best_friends;
               // $args_for_grabzit =array('theme' => $theme, 'fb_id_user' => $user_id, 'user_name' => urlencode($name), 'nb_friends' => $nb_friends_fb );

                // Create a temporary file for execute php code
                $url_temp_file_php = time().$user_id;
                $temp_file_php = fopen("ressources/views/tempfiles/".$url_temp_file_php.".php", "w+");
                if($temp_file_php==false)
                die("La création du fichier a échoué");
                // changement de tags pour le code php
                //$img_profile .= "\" width=\"275\" height=275";
                $code_php = str_replace('https://graph.facebook.com/{{fb_id_user}}/picture/?width=275&height=275', $img_profile , $code_php );

                $code_php = str_replace('{%', '$_GET[\'', $code_php );
                $code_php = str_replace('%}', '\']', $code_php );

                // changement de tags pour les variables
                $code_php = str_replace('{?', '\'.$_GET[\'', $code_php );
                $code_php = str_replace('?}', '\'].\'', $code_php );

                // changement de tags pour le code html
                $code_php = str_replace('{{', '<?php echo $_GET[\'', $code_php );
                $code_php = str_replace('}}', '\']; ?>', $code_php );
                fputs($temp_file_php, '<style>'.$code_css.'</style>');
                fputs($temp_file_php, '<script>'.$code_js.'</script>');
                fputs($temp_file_php, $code_php);

                $url = '?user_gender='.$genre.'&code_head='.urlencode($code_head).'&code_bottom='.urlencode($code_bottom).'&fb_id_user='.$user_id.'&user_name='.urlencode($name).'&full_user_name='.urlencode($full_name).'&nb_friends='.$nb_friends_fb.'&temp_file_php='.urlencode($url_temp_file_php);

                $url = "/ressources/views/themes/theme4.php" . $url;


                foreach ($tags as $key => $tag) {
                    $result_description = str_replace('{{'.$key.'}}', $tag, $result_description );
                }

                $result_description = strip_tags($result_description);
                //Helper::debug($tags);

                $url = "http://www.funizi.com/api/" . $url;


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
                $save = $this->grabzit->SaveTo("../".$filepath);
                $data = [
                    'messenger_user_id'     => $user_id,
                    'first_name'            => $name,
                    'last_name'             => $last_name,
                    'gender'                => $genre,
                    'test_id'               => $test_id,
                    'uuid'                  => $code,
                    'result'                => $result_id,
                    'img_url'               => "/$filepath",
                ];
                if($save)
                    $bottest = BotTests::create($data);

                $titre_url = Helper::cleanUrl($test_name);
                $url_to_share = urlencode("http://www.funizi.com/result/".$titre_url."/".$code."?ref=fb&utm=partage_bot");
                $url_redirect_share = urlencode("http://www.funizi.com/result/".$titre_url."/".$code."/new");

                $url_share = "https://www.facebook.com/dialog/share?app_id=348809548888116&hashtag=%23funizi&display=popup&href=".$url_to_share."&redirect_uri=".$url_redirect_share;
                $data_json = [
                    "set_attributes"    =>
                		[
                			"result_description"    =>  $result_description,
                			"test_done"             =>  1
                		],
                    "messages"          => [
                        [
                            "attachment" => [
                                "type"      =>  "template",
                                "payload"   =>  [
                                    "template_type"         =>  "generic",
                                    "elements"              =>  [
                                        [
                                            "title"         =>  $test_name,
                                            "image_url"     =>  "http://www.funizi.com/".$filepath,
                                            "subtitle"      =>  "",
                                            "buttons"       =>  [
                                                [
                                                    "type"  =>  "element_share"
                                                ],
                                                [
                                                    "type"  => "web_url",
                                                    "url"   => "http://www.funizi.com?utm=bot",
                                                    "title" => "Voir plus de tests"
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ];



        return $response->withStatus(201)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($data_json));
    }
}

    private function saveOrUpdate($id, $name, $lastname, $genre, $ip){
        $country = Helper::getCountry($ip);
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
