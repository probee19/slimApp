<?php


namespace App\Controllers;


use App\Helpers\DBIP;
use App\Helpers\Helper;
use App\Models\Admin;
use App\Models\TestOwner;
use App\Models\Test;
use App\Models\Resultat;
use App\Models\User;
use App\Models\UserTest;
use App\Models\Countries;
use App\Models\Rubrique;
use App\Models\Theme;
use App\Models\Language;
use App\Models\ThemePerso;
use Psr7Middlewares\Middleware\ClientIp;
use GrabzItImageOptions;

class CreateTestController extends Controller
{
  public function index($request, $response, $arg){

    //Helper::checkCookies();
    if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL){
      return $response->withStatus(302)->withHeader('Location', "http://creation.funizi.com" );
    }
    return $this->view->render($response, 'chooseTheme.twig');

  }

  public function createTest($request, $response, $arg)
  {
    //Helper::checkCookies();
    if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL){
      return $response->withStatus(302)->withHeader('Location', "http://creation.funizi.com" );
    }
    $theme = $arg['theme'];
    $rubriques = Rubrique::all();

    $countries = Countries::all();
    $langs = Language::selectRaw('code, name, fr_name')->where('status',1)->orderByRaw('fr_name')->get();

    return $this->view->render($response, 'createTest.twig', compact('theme','rubriques','countries','langs'));
  }

  public function editTest($request, $response, $arg)
  {
    //Helper::checkCookies();
    if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL){
      return $response->withStatus(302)->withHeader('Location', "http://creation.funizi.com" );
    }
    $id_test = $arg['test'];

    $test = Test::where('id_test',$arg['test'])->with('themePersoInfo')->first();
    $themePersoInfo = ThemePerso::where([['id_test',$id_test],['lang',$test->default_lang]])->first();
    //Helper::debug($themePersoInfo);

    $liste_des_pays = preg_split("/[\s,]+/", $test->codes_countries);

    $all_resultats = Resultat::where('id_test',$arg['test'])->get();

    $first_resultat = Resultat::where('id_test',$arg['test'])->first();

    $rubriques = Rubrique::all();

    $countries = Countries::all();
    $langs = Language::selectRaw('code, name, fr_name')->where('status',1)->orderByRaw('fr_name')->get();

    if($test->id_theme == 4 && 3==4 )
      $langs = ThemePerso::selectRaw('themes_perso.lang, lang.name AS name, lang.fr_name AS fr_name')
        ->join('lang','themes_perso.lang','=','lang.code')
        ->where('themes_perso.id_test',$id_test)
        ->orderByRaw('fr_name')
        ->get();


    $themes = Theme::where([['id','!=',3],['id','!=',4]])->get();
    return $this->view->render($response, 'editTest.twig', compact('test','liste_des_pays','all_resultats','first_resultat','rubriques','countries','themes', 'langs','themePersoInfo'));
  }

  public function debugOnFile($data)
  {
    # code...
    // Create a temporary file for execute php code

    $url_temp_file_php = time()."_log";
    $temp_file_php = fopen($path . $url_temp_file_php.".php", "w+");
    if($temp_file_php==false)
    die("La création du fichier a échoué");
    foreach ($data as $d) {
      # code...
      fputs($temp_file_php, $d. "\n");
    }
    return;
  }

  public function addTest($request, $response, $arg){
      //Helper::checkCookies();
      $test_owner = $_COOKIE['id_user'];
      $id_theme = $_POST['theme'];
      $titre_resultat = ' ';
      $texte_resultat = ' ';
      $genre = 'all';
      $permissions = 0;
      $unique_result = 0;
      $if_translated = 0;
      $statut = 0; $save_done = true;
      $error_message = ''; $target_dir = './images-tests/'; $target_file = ""; $end = false;
      $localite = ""; $id_test = 0;
      // Enregitrement des informations générales du test
      $name = 'test_'.$test_owner.str_replace(' ','_',time().'_'.$_POST['rubrique'].'.jpeg');
      $uploadPath = $target_dir. $name;


      if(self::decode($_POST['img_resultat_base_64_1'], $uploadPath)){
        // Récuperation de la liste des zones sélectionnées pour le test
        if(isset($_POST['localite'])){
          foreach ($_POST['localite'] as $code_localite) {
            $localite .= " ".$code_localite;
          }
        }
        else
          $localite = "";

        if(isset($_POST['unique_result']))
            $unique_result = 1;

        if(isset($_POST['permissions']))
            $permissions = 1;

        if(isset($_POST['if_translated']))
            $if_translated = 1;

        $data_test = [
          "id_test_owner"       =>  $test_owner,
          "id_rubrique"         =>  $_POST['rubrique'],
          "id_theme"            =>  $id_theme,
          "titre_test"          =>  $_POST['titre'],
          "url_image_test"      =>  $uploadPath,
          "statut"              =>  $statut,
          "default_lang"        =>  $_POST['default_lang'],
          "if_translated"       =>  $if_translated,
          "permissions"         =>  $permissions,
          "unique_result"       =>  $unique_result,
          "date_creation_test"  =>  \date("Y-m-d H:i:s"),
          "codes_countries"     =>  $localite,
          "tests_count"         =>  0,
          "shares_count"        =>  0,
          "test_description"    =>  $_POST['texte_for_share'],
          "created_at"          =>  \date("Y-m-d H:i:s"), # \Datetime()
          "updated_at"          =>  \date("Y-m-d H:i:s")  # \Datetime()
        ];

        // Sauvegarde des informations générales du test (titre, rubrique, image, zones sélectionnées)
        $id_test = Test::insertGetId($data_test);

        if($id_test)
          {
            // Traduction des informations générales du test dans toutes les langues activées
            //if($_POST['if_translated'] == 1)
              Helper::translateInfoTestAndSave($id_test, $_POST['titre'], $_POST['texte_for_share'], $_POST['default_lang'], $if_translated);

            // Enregitrement des résultats
            $nb_resultats = 0; // Nombre de résultats traités

            for ($i = 1; $i < $_POST['idNextResultat'] ; $i++) {
              $name = 'resultat_'.$i.'_'.time().'_'.str_replace(' ','_',$id_test.'.jpeg');
                  $uploadPathResultat = $target_dir. $name;
                  if(self::decode($_POST['img_resultat_base_64_'.$i], $uploadPathResultat)){
                    if($id_theme == 1){
                      $titre_resultat = $_POST['resultat'.$i];
                      $genre = $_POST['genre'.$i];
                    }
                    if($id_theme == 2){
                      $texte_resultat = $_POST['texte_resultat'.$i];
                      $genre = $_POST['genre'.$i];
                    }
                    $data_result = [
                      "id_test"           =>  $id_test,
                      "titre_resultat"    =>  $titre_resultat,
                      "texte_resultat"    =>  $texte_resultat,
                      "image_resultat"    =>  $uploadPathResultat,
                      "genre"             =>  $genre
                    ];
                    $add_result = Resultat::insertGetId($data_result);
                    if(!$add_result)
                      $save_done = false;

                }
              $nb_resultats++;
            }
            // Enregistrement des informations du test effectué avec succès
            // Mise à jour du nombre de test de la rubrique choisie
            //$update_rubrique = Rubrique::where('id_rubrique',$_POST['rubrique'])->increment('nb_test');

          }
         else
          $save_done = false;
      }

      if($save_done == true)
          echo $id_test;

  }

  public function updateTest($request, $response, $arg)
  {
      //Helper::checkCookies();
      $titre_resultat = ' '; $texte_resultat = ' '; $permissions = 0; $unique_result = 0; $genre = 'all'; $if_translated = 0;
    	$id_theme = $_POST['theme']; $error_message = ''; $target_dir = './images-tests/'; $target_file = ""; $end = false;
    	$localite = "";


  		// Récuperation de la liste des zones sélectionnées pour le test
  		if(isset($_POST['localite']))
  			foreach ($_POST['localite'] as $code_localite) {
  				$localite .= " ".$code_localite;
  			}

  		if(isset($_POST['unique_result']))
  			$unique_result = 1;

  		if(isset($_POST['permissions']))
  			$permissions = 1;

      if(isset($_POST['if_translated']))
          $if_translated = 1;

  		//$_POST['titre'] = addslashes($_POST['titre']);
  		$_POST['texte_for_share'] = $_POST['texte_for_share'];
  		$localite = addslashes($localite);

      //if(isset($_POST['img_resultat_base_64_1']) AND $_POST['img_resultat_base_64_1']!="")
      if(isset($_POST['img_test_base_64']) AND $_POST['img_test_base_64']!="")
  		{
  			// L'image du test a été modifiée
  			$name = 'test_'.$test_owner.str_replace(' ','_',time().'_'.$_POST['rubrique'].'.jpeg');
  			$uploadPath = $target_dir. $name;
  			self::decode($_POST['img_test_base_64'], $uploadPath);
        if($_POST['default_lang'] == $_POST['langs_edit'])
            $new_data = [
              "titre_test"        =>  $_POST['titre'],
              "id_rubrique"       =>  $_POST['rubrique'],
              "url_image_test"    =>  "$uploadPath",
              "permissions"       =>  $permissions,
              "unique_result"     =>  $unique_result,
              "codes_countries"   =>  $localite,
              "test_description"  =>  $_POST['texte_for_share'],
              "default_lang"      =>  $_POST['default_lang'],
              "if_translated"     =>  $if_translated
            ];
        else
          $new_data = [
            "id_rubrique"       =>  $_POST['rubrique'],
            "url_image_test"    =>  "$uploadPath",
            "permissions"       =>  $permissions,
            "unique_result"     =>  $unique_result,
            "codes_countries"   =>  $localite,
            "default_lang"      =>  $_POST['default_lang'],
            "if_translated"     =>  $if_translated
          ];
  		}
  		else
      {
        if($_POST['default_lang'] == $_POST['langs_edit'])
          $new_data = [
            "titre_test"        =>  $_POST['titre'],
            "id_rubrique"       =>  intval($_POST['rubrique']),
            "permissions"       =>  $permissions,
            "unique_result"     =>  $unique_result,
            "codes_countries"   =>  $localite,
            "test_description"  =>  $_POST['texte_for_share'],
            "default_lang"      =>  $_POST['default_lang'],
            "if_translated"     =>  $if_translated
          ];
        else
          $new_data = [
            "id_rubrique"       =>  intval($_POST['rubrique']),
            "permissions"       =>  $permissions,
            "unique_result"     =>  $unique_result,
            "codes_countries"   =>  $localite,
            "default_lang"      =>  $_POST['default_lang'],
            "if_translated"     =>  $if_translated
          ];
      }


  		// Mise à jour des informations générales du test
      $update_test = Test::where('id_test',$_POST['idTest'])->update($new_data);

      //if($_POST['if_translated'] == 1)
        Helper::translateInfoTestAndSave($_POST['idTest'], $_POST['titre'], $_POST['texte_for_share'], $_POST['default_lang'], $if_translated, $_POST['langs_edit']);

  		// Mise à jour des résultats des résultats
  		$nb_resultats = 0; // Nombre de résultats traités
  		for ($i = 1; $i < $_POST['idNextResultat'] ; $i++) {
  			$id_resultat = $_POST['id_resultat'.$i];

  			if($id_theme == 1){
  				$titre_resultat = addslashes($_POST['resultat'.$i]);
  				$genre = $_POST['genre'.$i];
  			}
  			if($id_theme == 2){
  				$texte_resultat = addslashes($_POST['texte_resultat'.$i]);
  				$genre = $_POST['genre'.$i];
  			}
  			// Mide à jour
  			if(isset($_POST['img_resultat_base_64_'.$i]) AND $_POST['img_resultat_base_64_'.$i]!="noimage"){
  				// L'image du résultat a été modifiée
  				if($id_resultat!=0){
  					// L'image reçue est celle d'un résultat modifié; $_POST['id_resultat'] étant l'id du résultat dans la base de données
  					$name = 'resultat_'.$i.'_'.time().'_'.str_replace(' ','_',$_POST['idTest'].'.jpeg');
  					$uploadPath = $target_dir. $name;
  					if(self::decode($_POST['img_resultat_base_64_'.$i], $uploadPath)){
  						// Mise à jour des informations du résultat
              $new_data_result = [
                "titre_resultat"  =>  $titre_resultat,
                "image_resultat"  =>  $uploadPath,
                "genre"           =>  $genre,
                "texte_resultat"  =>  $texte_resultat
              ];

              $update_resultat = Resultat::where('id_resultat',$id_resultat )->update($new_data_result);

  						if($id_theme == 3 || $id_theme == 4) echo 'j';
                $update_test = Test::where('id_test',$_POST['idTest'])->update(['url_image_test' => "$uploadPath"]);
  					}
  				}
  				else {
  					// L'image reçu est celle d'un nouveau résultat
  					// Sauvegarde de l'image du résultat
  					$name = 'resultat_'.$i.'_'.time().'_'.str_replace(' ','_',$_POST['idTest'].'.jpeg');
  					$uploadPath = $target_dir. $name;
  					if(self::decode($_POST['img_resultat_base_64_'.$i], $uploadPath)){
              $data_new_resultat = [
                "id_test"         =>  $_POST['idTest'],
                "titre_resultat"  =>  $titre_resultat,
                "texte_resultat"  =>  $texte_resultat,
                "image_resultat"  =>  $uploadPath,
                "genre"           =>  $genre
              ];

              $new_resultat = Resultat::insertGetId($data_new_resultat);

  					}
  				}
  			}
  			else {
          $new_data_result = [
            "titre_resultat"  =>  $titre_resultat,
            "genre"           =>  $genre,
            "texte_resultat"  =>  $texte_resultat
          ];
          $update_resultat = Resultat::where('id_resultat',$id_resultat )->update($new_data_result);
  			}
  		}

  		// Supréssion des résultats choisis pour
  		for ($j=1; $j < $_POST['nb_resultats_to_del']+1; $j++) {
  			// Traitement des résultats choisis pour Supression
          $req_del_resultat = Resultat::where('id_resultat',$_POST['to_del'.$j])->delete();
  		}
      return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('alltests') );
  }

  public function grabImageForCropit($request, $response, $arg)
  {
    if(isset ($_POST['url'])){
    	$img_url = $_POST['url'];

    	$filepath = "uploads/".time().".png";

    	$save = copy($img_url, $filepath);
    	if($save){

    		echo $filepath ;
    	}
    }
  }

	public static function decode ($code,$pathname) {
	    list($type, $code) = explode(';', $code);
	    list(, $code)      = explode(',', $code);
	    $code = base64_decode($code);
	    file_put_contents($pathname, $code);
		return true;
	}
}
