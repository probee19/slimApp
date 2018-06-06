<?php


namespace App\Controllers;


use App\Helpers\DBIP;
use App\Helpers\Helper;
use App\Controllers\JsonController;
use App\Models\Admin;
use App\Models\TestOwner;
use App\Models\Test;
use App\Models\Resultat;
use App\Models\User;
use App\Models\UserTest;
use App\Models\Countries;
use App\Models\Rubrique;
use App\Models\ThemePerso;
use App\Models\Share;
use App\Models\Language;
use App\Models\TestInfo;
use App\Models\TestAdditionnalInfos;
use App\Models\InterfaceUi;
use App\Models\InterfaceUiTranslations;
use Psr7Middlewares\Middleware\ClientIp;
use GrabzItImageOptions;

class ActionTestController extends Controller
{
  public function index($request, $response, $arg){

    return $this->view->render($response, 'chooseTheme.twig');

  }

  public function DeleteTest($request, $response, $arg)
  {
    Test::where('id_test',$_GET['idtest'])->update(['statut' => -1]);
  }

  public function ActiveTest($request, $response, $arg)
  {
    Test::where('id_test',$_GET['idtest'])->update(['statut' =>1]);
  }

  public function DesactiveTest($request, $response, $arg)
  {
    Test::where('id_test',$_GET['idtest'])->update(['statut' =>0]);
  }

  public function HighlightTest($request, $response, $arg)
  {
    Test::where('id_test',$_GET['idtest'])->update(['highlight' =>1]);
  }

  public function RemoveHighlightTest($request, $response, $arg)
  {
    Test::where('id_test',$_GET['idtest'])->update(['highlight' =>0]);
  }

  public function ChangeThemeTest($request, $response, $arg)
  {
    Test::where('id_test',$_GET['idTest'])->update(['id_theme'=>$_GET['newTheme']]);

    if($_GET['newTheme'] == 1)
      Resultat::where('id_test',$_GET['idTest'])->update(['titre_resultat'=>'texte_resultat']);

    if($_GET['newTheme'] == 2)
      Resultat::where('id_test',$_GET['idTest'])->update(['texte_resultat'=>'titre_resultat']);

  }

  public function DeleteResultTest($request, $response, $arg)
  {
        $test = $_GET['test']; $user = $_GET['admin'];
        $delete = UserTest::where([ ['test_id','=', $test], ['user_id','=', $user] ])->delete();
  }


  // Citation

  public function DeleteCitation($request, $response, $arg)
  {
    Citation::where('id_citation',$_GET['idcitation'])->update(['statut' => -1]);
  }


  public function ActiveCitation($request, $response, $arg)
  {
    Citation::where('id_citation',$_GET['idcitation'])->update(['statut' =>1]);
  }


  public function DesactiveCitation($request, $response, $arg)
  {
    Citation::where('id_citation',$_GET['idcitation'])->update(['statut' =>0]);
  }


  public function UploadImageThemePerso($request, $response, $arg)
  {
      $target_dir = 'images-theme-perso'; $target_file = "";$end = 0;

      foreach ($_FILES["file_background"]["error"] as $key => $error) {
        if($error == 0 && $end == 0 )
        {
          $infosfichier = pathinfo($_FILES["file_background"]["name"][$key]);
          $extension = $infosfichier['extension'];
          $target_file= time().'.'.$extension;
          $uploadPath = $target_dir. $name;
          if(move_uploaded_file( $_FILES["file_background"]["tmp_name"][$key], "$target_dir/$target_file")){
            $file_img = "https://creation.funizi.com/" . "$target_dir/$target_file" ;
            echo $file_img ; 
            $this->helper->uploadToS3($file_img, 'images/images-theme-perso/');
          }
          else {
            //echo 'erreur' ;
          }
          $end = 1;
        }
        else {
          //echo $error;
        }
      }
  }

  public function ExecutePhpForPreviewTest($request, $response, $arg)
  {
    $code_php = fopen("ressources/views/php-theme-perso.php", "w+");
    if($code_php==false)
    die("La création du fichier a échoué");
    $code = str_replace('{%user_gender%}', '\'homme\'', $_POST['codePHP']);
    $code = str_replace('{% user_gender %}', '\'homme\'', $code);
    $code = str_replace('{%t', ' ', $code);
    $code = str_replace('t%}', ' ', $code);

    fputs($code_php, $code);
    require('ressources/views/php-theme-perso.php');
    //var_dump($_POST['code'], true) ;
  }

  public function SaveTestPerso_($request, $response, $arg)
  {
    // Traduction du fichier
    /*


      $langs = Language::selectRaw('code')->where('status',1)->get();
      $data_tp = array();
      foreach ($langs as $lang) {
        $url_temp_file_php_ = Helper::getUrlTempFile(
          $lang->code,
          $_POST['idTest'],
          "ressources/views/themes/perso/",
          $_POST['codePHPHTML'],
          $_POST['codeCSS'],
          $_POST['codeJS'],
          $_POST['codeRequireTop'],
          $_POST['codeRequireBottom']
        );

        $data_tp[] = [
          'lang'          =>  $lang->code,
          'code_php'      =>  $_POST['codePHPHTML'],
          'code_css'      =>  $_POST['codeCSS'],
          'code_js'       =>  $_POST['codeJS'],
          'code_head'     =>  $_POST['codeRequireTop'],
          'code_bottom'   =>  $_POST['codeRequireBottom'],
          'nb_friends_fb' =>  $_POST['nbFriends'],
          'max_friends'   =>  $_POST['nbMaxFriends'],
          'best_friends'  =>  $_POST['bestFriends']
        ];
      }
    */

    $url_temp_file_php = Helper::getUrlTempFile(
      "fr",
      $_POST['idTest'],
      "ressources/views/themes/perso/",
      $_POST['codePHPHTML'],
      $_POST['codeCSS'],
      $_POST['codeJS'],
      $_POST['codeRequireTop'],
      $_POST['codeRequireBottom']
    );
    $data_tp = [
      'id_test'       =>  $_POST['idTest'],
      'code_php'      =>  $_POST['codePHPHTML'],
      'code_css'      =>  $_POST['codeCSS'],
      'code_js'       =>  $_POST['codeJS'],
      'code_head'     =>  $_POST['codeRequireTop'],
      'code_bottom'   =>  $_POST['codeRequireBottom'],
      'nb_friends_fb' =>  $_POST['nbFriends'],
      'max_friends'   =>  $_POST['nbMaxFriends'],
      'best_friends'  =>  $_POST['bestFriends']
    ];
    $last_id = ThemePerso::insertGetId($data_tp);
    if($last_id)
      echo 'Thème personnalisé '.$last_id.' ajouté avec succès ';
    else
      echo 'Erreurs survenues lors de la sauvegarde du thème personnalisé';
      return $data_tp;
  }

  public function SaveTestPerso($request, $response, $arg){
    $data_tp = array();
    // Creation du fichier en français
    $url_temp_file_php = Helper::getUrlTempFile(
      "fr",
      $_POST['idTest'],
      "ressources/views/themes/perso/",
      $_POST['codePHPHTML'],
      $_POST['codeCSS'],
      $_POST['codeJS'],
      $_POST['codeRequireTop'],
      $_POST['codeRequireBottom']
    );

    $data_tp[] = [
      'id_test'       =>  $_POST['idTest'],
      'lang'          =>  "fr",
      'code_php'      =>  $_POST['codePHPHTML'],
      'code_css'      =>  $_POST['codeCSS'],
      'code_js'       =>  $_POST['codeJS'],
      'code_head'     =>  $_POST['codeRequireTop'],
      'code_bottom'   =>  $_POST['codeRequireBottom'],
      'nb_friends_fb' =>  $_POST['nbFriends'],
      'max_friends'   =>  $_POST['nbMaxFriends'],
      'best_friends'  =>  $_POST['bestFriends']
    ];

    // Creation des fichiers pour les autres langues restantes
    $langs = Language::selectRaw('code')->where([['status',1], ['code','!=','fr']])->get();
    // Creation du code PHP en anglais
    $_POST['codePHPHTML'] = Helper::toEn($_POST['codePHPHTML']);

    foreach ($langs as $lang) {
      $url_temp_file_php_ = Helper::getUrlTempFile(
        $lang->code,
        $_POST['idTest'],
        "ressources/views/themes/perso/",
        $_POST['codePHPHTML'],
        $_POST['codeCSS'],
        $_POST['codeJS'],
        $_POST['codeRequireTop'],
        $_POST['codeRequireBottom']
      );
      //$php = self::translateWithTags($lang, $php);

      $data_tp[] = [
        'id_test'       =>  $_POST['idTest'],
        'lang'          =>  "$lang->code",
        'code_php'      =>  Helper::translateWithTags($lang->code,$_POST['codePHPHTML']),
        'code_css'      =>  $_POST['codeCSS'],
        'code_js'       =>  $_POST['codeJS'],
        'code_head'     =>  $_POST['codeRequireTop'],
        'code_bottom'   =>  $_POST['codeRequireBottom'],
        'nb_friends_fb' =>  $_POST['nbFriends'],
        'max_friends'   =>  $_POST['nbMaxFriends'],
        'best_friends'  =>  $_POST['bestFriends']
      ];

    }

    ThemePerso::insert($data_tp);

    return $data_tp;
  }

  public function UpdateTestPerso_($request, $response, $arg)
  {
      $url_temp_file_php = Helper::getUrlTempFile(
        "fr",
        $_POST['idTest'],
        "ressources/views/themes/perso/",
        $_POST['codePHPHTML'],
        $_POST['codeCSS'],
        $_POST['codeJS'],
        $_POST['codeRequireTop'],
        $_POST['codeRequireBottom']
      );

      $data_tp = [
        'code_php'      =>  $_POST['codePHPHTML'],
        'code_css'      =>  $_POST['codeCSS'],
        'code_js'       =>  $_POST['codeJS'],
        'code_head'     =>  $_POST['codeRequireTop'],
        'code_bottom'   =>  $_POST['codeRequireBottom'],
        'nb_friends_fb' =>  $_POST['nbFriends'],
        'max_friends'   =>  $_POST['nbMaxFriends'],
        'best_friends'  =>  $_POST['bestFriends']
      ];
      $update = ThemePerso::where('id_test',$_POST['idTest'])->update($data_tp);
      return $data_tp;
  }
  public function UpdateTestPerso($request, $response, $arg)
  {
    if($_POST['langsEdit'] == 'fr'){
      // Creation du fichier en français
      $url_temp_file_php = Helper::getUrlTempFile(
        "fr",
        $_POST['idTest'],
        "ressources/views/themes/perso/",
        $_POST['codePHPHTML'],
        $_POST['codeCSS'],
        $_POST['codeJS'],
        $_POST['codeRequireTop'],
        $_POST['codeRequireBottom']
      );

      $data_tp_fr = [
        'code_php'      =>  $_POST['codePHPHTML'],
        'code_css'      =>  $_POST['codeCSS'],
        'code_js'       =>  $_POST['codeJS'],
        'code_head'     =>  $_POST['codeRequireTop'],
        'code_bottom'   =>  $_POST['codeRequireBottom'],
        'nb_friends_fb' =>  $_POST['nbFriends'],
        'max_friends'   =>  $_POST['nbMaxFriends'],
        'best_friends'  =>  $_POST['bestFriends']
      ];
      $update = ThemePerso::where([['id_test',$_POST['idTest']], ['lang','fr']])->update($data_tp_fr);
      // Creation des fichiers pour les autres langues restantes
      $langs = Language::selectRaw('code')->where([['status',1], ['code','!=','fr']])->get();
      // Creation du code PHP en anglais
      $_POST['codePHPHTML'] = Helper::toEn($_POST['codePHPHTML']);

      $nb_lang_created_for_test = ThemePerso::where("id_test",$_POST['idTest'])->count();
      if($nb_lang_created_for_test > 1){
            foreach ($langs as $lang) {
              $url_temp_file_php_ = Helper::getUrlTempFile(
                $lang->code,
                $_POST['idTest'],
                "ressources/views/themes/perso/",
                $_POST['codePHPHTML'],
                $_POST['codeCSS'],
                $_POST['codeJS'],
                $_POST['codeRequireTop'],
                $_POST['codeRequireBottom']
              );
              $data_tp = [
                'code_php'      =>  Helper::translateWithTags($lang->code,$_POST['codePHPHTML']),
                'code_css'      =>  $_POST['codeCSS'],
                'code_js'       =>  $_POST['codeJS'],
                'code_head'     =>  $_POST['codeRequireTop'],
                'code_bottom'   =>  $_POST['codeRequireBottom'],
                'nb_friends_fb' =>  $_POST['nbFriends'],
                'max_friends'   =>  $_POST['nbMaxFriends'],
                'best_friends'  =>  $_POST['bestFriends']
              ];
              ThemePerso::where([['id_test',$_POST['idTest']], ['lang',"$lang->code"]])->update($data_tp);
            }
      }
      else {
        foreach ($langs as $lang) {
            $url_temp_file_php_ = Helper::getUrlTempFile(
            $lang->code,
            $_POST['idTest'],
            "ressources/views/themes/perso/",
            $_POST['codePHPHTML'],
            $_POST['codeCSS'],
            $_POST['codeJS'],
            $_POST['codeRequireTop'],
            $_POST['codeRequireBottom']
          );
          $data_tp[] = [
            'id_test'       =>  $_POST['idTest'],
            'lang'          =>  "$lang->code",
            'code_php'      =>  Helper::translateWithTags($lang->code,$_POST['codePHPHTML']),
            'code_css'      =>  $_POST['codeCSS'],
            'code_js'       =>  $_POST['codeJS'],
            'code_head'     =>  $_POST['codeRequireTop'],
            'code_bottom'   =>  $_POST['codeRequireBottom'],
            'nb_friends_fb' =>  $_POST['nbFriends'],
            'max_friends'   =>  $_POST['nbMaxFriends'],
            'best_friends'  =>  $_POST['bestFriends']
          ];
        }
        ThemePerso::insert($data_tp);
      }

    }
    else {
      // Mise à jour du test pour la langue choisie lors de l'édition $_POST['lang']
      // Creation du fichier en français
      $url_temp_file_php = Helper::getUrlTempFile(
        $_POST['langsEdit'],
        $_POST['idTest'],
        "ressources/views/themes/perso/",
        Helper::translateWithTags($_POST['langsEdit'],$_POST['codePHPHTML']),
        $_POST['codeCSS'],
        $_POST['codeJS'],
        $_POST['codeRequireTop'],
        $_POST['codeRequireBottom']
      );

      $data_tp = [
        'code_php'      =>  Helper::translateWithTags($_POST['langsEdit'],$_POST['codePHPHTML']),
        'code_css'      =>  $_POST['codeCSS'],
        'code_js'       =>  $_POST['codeJS'],
        'code_head'     =>  $_POST['codeRequireTop'],
        'code_bottom'   =>  $_POST['codeRequireBottom'],
        'nb_friends_fb' =>  $_POST['nbFriends'],
        'max_friends'   =>  $_POST['nbMaxFriends'],
        'best_friends'  =>  $_POST['bestFriends']
      ];
      $update = ThemePerso::where([['id_test',$_POST['idTest']], ['lang',$_POST['langsEdit']]])->update($data_tp);
    }
      return $data_tp;
  }

  public function loadCodeTestPersoLang()
  {
    $theme_perso = ThemePerso::where([["id_test", $_POST['id_test']],["lang",$_POST['lang']]])->orderBy('id','DESC')->first();
    //Helper::debug($theme_perso->code_php);
    return $theme_perso->code_php;
  }


  public function loadInfoTestLang()
  {
    $info_test = TestInfo::where([["id_test", $_POST['id_test']],["lang",$_POST['lang']]])->first();

    $test_additionnal_infos = TestAdditionnalInfos::where([['id_test','=',$_POST['id_test']],['lang','=', $_POST['lang'] ]])->first();

    $data = [
      "titre_test"              =>  $info_test->titre_test,
      "test_description"        =>  $info_test->test_description,
      "label_additionnal_info"  =>  $test_additionnal_infos->label
    ];
    return json_encode($data);
  }

  public function loadInfoCitation()
  {
    $info_citation = CitationInfo::where([["id_citation", "=", $_POST['id_citation']],["lang", "=", $_POST['lang']]])->first();
    //Helper::debug($theme_perso->code_php);
    $data = [
      'titre_citation'          =>  $info_citation->titre_citation,
      'citation_description'    =>  $info_citation->citation_description,
      'code_php'                =>  $info_citation->code_php
    ];

    return json_encode($data);
  }

//
  public function upgrade($request, $response, $arg)
  {
      $tests = ThemePerso::all();
      Helper::debug(count($tests));
      //exit;
      foreach ($tests as $test) {
        $url_temp_file_php = Helper::getUrlTempFile(
          "en",
          $test->id_test,
          "ressources/views/themes/perso/",
          $test->code_php,
          $test->code_css,
          $test->code_js,
          $test->code_head,
          $test->code_bottom
        );
      }
  }



  public function ShowMoreResult($request, $response, $arg)
  {
    $begin = $_GET['last'] + 1;
  	$nb = $_GET['nb'] ;

    $users_tests = UserTest::with('testInfo')->with('userInfo')->orderBy('id','DESC')->skip($begin)->take($nb)->get();
    foreach ($users_tests as $user_test) {
      $share = Share::where('result_code','=',$user_test->uuid)->first();
      if($share){
        $shared = true;
        $nb_clics = $share->clicks_count;
      }

      $date_test = new \DateTime($user_test->created_at);
      $today =new \DateTime();
      if($today->format("d") == $date_test->format("d")) $jour = " Aujourd'hui";
      else $jour = $date_test->format("d").'/'.$date_test->format("m").'/'.$date_test->format("Y");
      $heure = $date_test->format("H").':'.$date_test->format("i").':'.$date_test->format("s");


      $data_users_tests[] = [
        'img_url'     =>  $user_test->img_url,
        'theme'       =>  $user_test->testInfo->id_theme,
        'titre_test'  =>  $user_test->testInfo->titre_test,
        'rubrique'    =>  $user_test->testInfo->id_rubrique,
        'date_test'   =>  $user_test->created_at,
        'shared'      =>  $shared,
        'day'         =>  $jour,
        'hour'        =>  $heure,
        'nb_clics'    =>  $nb_clics,
        'facebook_id' =>  $user_test->userInfo->facebook_id
      ];
    }

    return $this->view->render($response, 'ajaxviews/moreResults.twig', compact('data_users_tests'));

  }
}
