<?php
namespace App\Controllers;
use App\Helpers\Helper;
use App\Helpers\SandBox;
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
        $lang = 'fr';
        //self::writeOnFile("ressources/views/tempfiles/test.php","Ok");

        //
        $log = fopen("uploads/log_api.txt", "w+");
        $data_log = '&url_img_profile_user='.urlencode($_POST['link_picture']).'&eam_a_name=' . urlencode($_POST['team_a_name']) . '&eam_b_name='. urlencode($_POST['team_b_name']) . '&cca=' . $_POST['cca'] . '&ccb='. $_POST['ccb'] . '&eamuser_ps='. $_POST['teamuser_ps'] ;

        fputs($log, $data_log);
        if($test_id == 359)
          $log_api = $this->helper->uploadToS3("https://".$this->base_domain .'/uploads/log_api.txt', 'api/pronostics/');




        $name = '';
        $test_id = $arg['ref'];
        if(isset($_POST['first_name'])){
            $name  = $_POST['first_name'];
            $img_profile  = $_POST['profile_pic_url'];
            if(isset($_POST['link_picture'])) $img_profile  = $_POST['link_picture'];
        }
        elseif(isset($_POST['prenom_user_friend'])){
            $name  = $_POST['prenom_user_friend'];
            $img_profile = "http://www.creation.funizi.com/src/img/user-default.jpg";
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
        elseif(isset($_POST['id_facebook_user']))
            $user_id  = $_POST['id_facebook_user'];
        else
            $user_id  = 0;

        $phrase = $_POST['phrase'];

        $tofile = "Test Id :  $test_id  name : $name  gender : $genre  user_id : $user_id";

        $tags = array();
        $tags['user_name'] = $name;
        $tags['full_user_name'] = $full_name;


        // Getting test's infos
        $test = Test::where('id_test', $test_id)->first();
        $test_name = $test->titre_test;
        $theme = $test->id_theme;
        $result_description = $test->test_description;
        $if_additionnal_info = $test->if_additionnal_info;

        // Setting filter for user's gender
        if($genre == 'male' || $genre == 'homme'){
            $filter = 'feminin';
        }
        if($genre == 'female' || $genre == 'femme' ){
            $filter = 'masculin';
        }
        $notIn = [0];


        // To delete
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




         $url = '?user_gender='.$genre.'&fb_id_user='.$user_id.'&user_name='.urlencode($name).'&full_user_name='.urlencode($full_name);
         //
         $url_img_profile_user = "&url_img_profile_user=".urlencode($img_profile);
         if( $if_additionnal_info == 1){
            $additionnal_input_text = '';
            $additionnal_input_text = '&additionnal_input_text='.urlencode($_SESSION['additionnal_input_text']);
         }
         $additionnal_input_text = '&additionnal_input_text=' . $phrase;
         $url .= $url_img_profile_user . $additionnal_input_text;

         //
         $url = SandBox::getUrlTestPerso($test_id ,$url, $lang);

         if($test_id == 358){
           $this->helper->debug($_POST);

           for ($i=1; $i <= $_POST['nb_games'] ; $i++) {
             $url .= '&a'.$i.'=' . $_POST['a'.$i] .'&b'.$i.'=' . $_POST['b'.$i];
           }
           $this->helper->debug($url);

           $url .= '&games=' . $_POST['games'];
           exit;
            //$resultUrl = $this->helper->uploadToS3($filepath, 'uploads/');

         }

        if($test_id == 359)
          $url .= '&url_img_profile_user='.urlencode($_POST['link_picture']).'&eam_a_name=' . urlencode($_POST['team_a_name']) . '&eam_b_name='. urlencode($_POST['team_b_name']) . '&cca=' . strtolower($_POST['cca']) . '&ccb='. strtolower($_POST['ccb']) . '&eamuser_ps='. $_POST['teamuser_ps'] ;


           //$resultUrl = $this->helper->uploadToS3($filepath, 'uploads/');



          foreach ($tags as $key => $tag)
              $result_description = str_replace('{{'.$key.'}}', $tag, $result_description );

          $result_description = strip_tags($result_description);

          $url = "https://fr.funizi.com" . $url;
          /*
          if($user_id = '1518836714820288'){
            return $url;
          }
          */
          //Helper::debug($url);

          //Generate unique code string for the test result
          $stringen = new RandomStringGenerator();
          $code = $stringen->generate(15);

          // Path of the saved image result
          $filepath = "uploads/". $code . '.jpg';

          if($test_id == 358)
            $filepath = "uploads/game_day_". $_POST['day'] . '.jpg';


          if($test_id == 359)
            $filepath = "uploads/pronostic_". $code . '.jpg';


          //Grabzit Options
          $options = new GrabzItImageOptions();
          $options->setBrowserwidth(800);
          $options->setBrowserHeight(420);
          $options->setQuality(90);
          $options->setFormat("jpg");
          //Grab the image result here and save it

          $generated = $this->grabzit->URLToImage($url, $options);
          $save = $this->grabzit->SaveTo("../".$filepath);
          if($save){
              $filepath_ = "https://".$this->base_domain .'/'. $filepath;
              if($test_id == 358)
                $resultUrl = $this->helper->uploadToS3($filepath_, 'api/games/');

              if($test_id == 359)
                $resultUrl = $this->helper->uploadToS3($filepath_, 'api/pronostics/');
          }
          $data = [
              'messenger_user_id'     => $user_id,
              'first_name'            => $name,
              'last_name'             => $last_name,
              'gender'                => $genre,
              'test_id'               => $test_id,
              'uuid'                  => $code,
              'result'                => $result_id,
              'img_url'               => "/$filepath"
          ];


          //Helper::debug($data);
          //if($save)
              //$bottest = BotTests::create($data);

          $image_url = "https://fr.funizi.com/".$filepath;

          $titre_url = Helper::cleanUrl($test_name);
          $url_to_share = urlencode("https://fr.funizi.com/result/".$titre_url."/".$code."?ref=fb&utm=partage_bot");
          $url_redirect_share = urlencode("https://fr.funizi.com/result/".$titre_url."/".$code."/new");



          $url_share = "https://www.facebook.com/dialog/share?app_id=348809548888116&hashtag=%23funizi&display=popup&href=".$url_to_share."&redirect_uri=".$url_redirect_share;
          $data_json = [
              "set_attributes"    =>
          		[
          			"result_description"    => $result_description,
          			"test_done"             =>1
          		],
              "messages"          => [
                  [
                      "attachment" => [
                          "type"      => "template",
                          "payload"   => [
                              "template_type"         =>  "generic",
                              "elements"              =>  [
                                  [
                                      "title"         =>  $test_name,
                                      "image_url"     =>  $image_url,
                                      "subtitle"      =>  "",
                                      "buttons"       =>  [
                                          [
                                              "type"  =>  "element_share"
                                          ],
                                          [
                                              "type"  =>  "web_url",
                                              "url"   =>  "https://fr.funizi.com?utm=bot",
                                              "title" =>  "Voir plus de tests"
                                          ]
                                      ]
                                  ]
                              ]
                          ]
                      ]
                  ]
              ]
          ];


          $link_image  =  "$image_url";
          $images = [
            'messages'  => [
              'attachment'  => [
                     'type' => 'image',
                      'payload' => [
                          'image' => [
                            "$link_image",
                          ]
                     ]
                   ]
                ]
          ];


          if($test_id == 359){
            $elements = [];
            $image = "https://s3.us-east-2.amazonaws.com/funiziuploads/api/pronostics/pronostic_$code.jpg";
            $url_share = "https://fr.funizi.com/api/share/footbot?from=" .urlencode($name) . "&img_url=" .urlencode($image) ."&team_a=" . urlencode($_POST['team_a_name']) ."&team_b=" . urlencode($_POST['team_b_name']);
            $elements[] = [
                               'title' => $_POST['team_a_name'] ." - ". $_POST['team_b_name'],
                               'image_url'=> $image,
                               'subtitle' => '',

                               'buttons' =>[
                                  [
                                         'type'  => 'web_url',
                                         'url'   => "$url_share",
                                         'title' => 'Partager sur Facebook'
                                     ]
                                  ]
                           ];
            $messages = [
                   'messages'  => [
                           'attachment'  => [
                                  'type' => 'template',
                                  'payload' => [
                                       'template_type' => 'generic',
                                       'elements' => $elements
                                    ]
                           ]
                   ]
             ];
            echo json_encode([$messages]);
            exit;
          }

  return $response->withStatus(201)
  ->withHeader('Content-Type', 'application/json')
  ->write(json_encode([$messages]));
}

  public function test($request, $response, $arg)
  {
    self::writeOnFile("ressources/views/tempfiles/test.php","Ok");

    $data = [
      "messages" => [
        [
          "text"=>"Hello, bienvenue sur funizi"
        ]
      ]
    ];


    return $response->withStatus(201)
    ->withHeader('Content-Type', 'application/json')
    ->write(json_encode($data));

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

    public static function writeOnFile($file, $data)
    {
      $f = fopen($file, "w+");
      if($f==false)
      die("La création du fichier a échoué");

      fputs($f, $data);

    }
}
