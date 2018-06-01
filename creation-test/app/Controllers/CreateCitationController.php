<?php


namespace App\Controllers;


use App\Controllers\GrabzitController;
use App\Helpers\RandomStringGenerator;
use App\Helpers\DBIP;
use App\Helpers\Helper;
use App\Models\Admin;
use App\Models\TestOwner;
use App\Models\Test;
use App\Models\Citation;
use App\Models\CitationInfo;
use App\Models\Resultat;
use App\Models\User;
use App\Models\UserTest;
use App\Models\Countries;
use App\Models\Rubrique;
use App\Models\Theme;
use App\Models\Language;
use App\Models\ThemePerso;
use App\Models\AdditionnalInfos;
use App\Models\TestAdditionnalInfos;
use Psr7Middlewares\Middleware\ClientIp;
use GrabzItImageOptions;

class CreateCitationController extends Controller
{
  public function index($request, $response, $arg){

    //$this->helper->checkCookies();
    if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL){
      return $response->withStatus(302)->withHeader('Location', "http://creation.funizi.com" );
    }
    return $this->view->render($response, 'chooseTheme.twig');

  }

  public function createCitation($request, $response, $arg)
  {
    //$this->helper->checkCookies();
    if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL){
      return $response->withStatus(302)->withHeader('Location', "http://creation.funizi.com" );
    }
    $rubriques = Rubrique::all();

    $countries = Countries::all();
    $langs = Language::selectRaw('code, name, fr_name')->where('status',1)->orderByRaw('fr_name')->get();

    return $this->view->render($response, 'createCitation.twig', compact('theme', 'rubriques', 'countries', 'langs'));
  }

  public function editCitation($request, $response, $arg)
  {
    //$this->helper->checkCookies();
    if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL){
      return $response->withStatus(302)->withHeader('Location', "https://creation.funizi.com" );
    }
    $id_citation = $arg['citation'];

    $citation = Citation::where('id_citation',$arg['citation'])->with('citationInfo')->first();
    $citationInfo = CitationInfo::where([['id_citation',$id_citation],['lang',$citation->default_lang]])->first();

    $liste_des_pays = preg_split("/[\s,]+/", $citation->codes_countries);

    $rubriques = Rubrique::all();

    $countries = Countries::all();
    $langs = Language::selectRaw('code, name, fr_name')->where('status',1)->orderByRaw('fr_name')->get();

    $langs = CitationInfo::selectRaw('citation_info.lang AS code, lang.name AS name, lang.fr_name AS fr_name')
      ->join('lang','citation_info.lang','=','lang.code')
      ->where('citation_info.id_citation',$id_citation)
      ->orderByRaw('fr_name')
      ->get();
     return $this->view->render($response, 'editCitation.twig', compact('citation', 'liste_des_pays', 'rubriques', 'countries', 'langs', 'citationInfo'));
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

  public function addCitation($request, $response, $arg){
      //$this->helper->checkCookies();
      $test_owner = $_COOKIE['id_user']; $if_translated = 0; $if_personalizable = 0; $test_to_translate = false; $statut = 0; $save_done = true;
      $error_message = ''; $target_dir = './images-citations/'; $target_file = ""; $end = false;
      $localite = "";
      // Enregitrement des informations générales du test

      if(isset($_POST['localite']))
        foreach ($_POST['localite'] as $code_localite)
          $localite .= " ".$code_localite;

      if(isset($_POST['if_translated'])){
        $test_to_translate = true;
        $if_translated = 1;
      }
      if(isset($_POST['if_personalizable']))
        $if_personalizable = 1;

      $data_citation = [
        "id_citation_owner"       =>  $test_owner,
        "id_rubrique"             =>  $_POST['rubrique'],
        "titre_citation"          =>  $_POST['titre'],
        "citation_description"    =>  $_POST['texte_for_share'],
        "statut"                  =>  $statut,
        "default_lang"            =>  $_POST['default_lang'],
        "if_translated"           =>  $if_translated,
        "if_personalizable"       =>  $if_personalizable,
        "codes_countries"         =>  $localite,
        'code_php'                =>  $_POST['codePHPHTML'],
        'code_css'                =>  $_POST['codeCSS'],
        'code_js'                 =>  $_POST['codeJS'],
        'code_head'               =>  $_POST['codeRequireTop'],
        'code_bottom'             =>  $_POST['codeRequireBottom'],
        "seen_count"              =>  0,
        "shares_count"            =>  0,
        "created_at"              =>  \date("Y-m-d H:i:s"), # \Datetime()
        "updated_at"              =>  \date("Y-m-d H:i:s")  # \Datetime()
      ];

      $id_citation = Citation::insertGetId($data_citation);

      // Put code in files and get url
      $lang = $_POST['default_lang'];
      $path = "ressources/views/themes/citations/";
      $url_file = $this->helper->getUrlCitationFile(
        $lang,
        $id_citation,
        "ressources/views/themes/citations/",
        $_POST['codePHPHTML'],
        $_POST['codeCSS'],
        $_POST['codeJS'],
        $_POST['codeRequireTop'],
        $_POST['codeRequireBottom']
      );

      // Do capture with url
      $citation_img_name = self::captureWithGrabzit($this->grabzit, $url_file, $id_citation, $lang);

      // Sauvegarde des informations de la citation pour chaque langue activée
      $data_ci = array();
      $data_ci[] = [
        'id_citation'             =>  $id_citation,
        'lang'                    =>  "fr",
        'code_php'                =>  $this->helper->translateWithTags("fr", $_POST['codePHPHTML']),
        'url_image_citation'      =>  $citation_img_name,
        "titre_citation"          =>  $_POST['titre'],
        "citation_description"    =>  $_POST['texte_for_share'],
        "created_at"              =>  \date("Y-m-d H:i:s"), # \Datetime()
        "updated_at"              =>  \date("Y-m-d H:i:s")  # \Datetime()
      ];

      $langs = Language::selectRaw('code')->where([['status',1], ['code','!=','fr']])->get();
      // Traduction du code en anglais pour les prochaines traductions
      $titre_citation_en = $this->helper->toEn($_POST['titre'], false);
      $test_for_share_en = $this->helper->toEn($_POST['texte_for_share'], false);
      $_POST['codePHPHTML'] = $this->helper->toEn($_POST['codePHPHTML']);
      foreach ($langs as $lang) {
        $url_file = $this->helper->getUrlCitationFile(
          $lang->code,
          $id_citation,
          "ressources/views/themes/citations/",
          $_POST['codePHPHTML'],
          $_POST['codeCSS'],
          $_POST['codeJS'],
          $_POST['codeRequireTop'],
          $_POST['codeRequireBottom']
        );
        // Création de l'image de la citation dans la langue $lang->code
        $citation_img_name = self::captureWithGrabzit($this->grabzit, $url_file, $id_citation, $lang->code);
        $data_ci[] = [
          'id_citation'             =>  $id_citation,
          'lang'                    =>  $lang->code,
          'code_php'                =>  $this->helper->translateWithTags($lang->code, $_POST['codePHPHTML']),
          'url_image_citation'      =>  $citation_img_name,
          "titre_citation"          =>  $this->helper->GoogleTranslate($lang->code, stripslashes($titre_citation_en), "en"),
          "citation_description"    =>  $this->helper->GoogleTranslate($lang->code, stripslashes($test_for_share_en), "en"),
          "created_at"              =>  \date("Y-m-d H:i:s"), # \Datetime()
          "updated_at"              =>  \date("Y-m-d H:i:s")  # \Datetime()
        ];
      }
      CitationInfo::insert($data_ci);
  }

  public function updateCitation($request, $response, $arg)
  {
      //$this->helper->checkCookies();
      $if_translated = 0;  $test_to_translate = false; $if_personalizable = 0;
    	$error_message = ''; $target_dir = './images-citations/'; $target_file = ""; $end = false;
    	$localite = "";
      $id_citation = $_POST['idCitation'];
      $path = "ressources/views/themes/citations/";
  		// Récuperation de la liste des zones sélectionnées pour le test
  		if(isset($_POST['localite']))
  			foreach ($_POST['localite'] as $code_localite)
  				$localite .= " ".$code_localite;

      $localite = addslashes($localite);

      if(isset($_POST['if_translated'])){
        $if_translated = 1;
        $test_to_translate = true;
      }

      if(isset($_POST['if_personalizable']))
        $if_personalizable = 1;

  		$_POST['texte_for_share'] = addslashes($_POST['texte_for_share']);

      if($_POST['default_lang'] == $_POST['langs_citations_edit'])
        $new_data = [
          "titre_citation"          =>  $_POST['titre'],
          "id_rubrique"             =>  intval($_POST['rubrique']),
          "codes_countries"         =>  $localite,
          "citation_description"    =>  $_POST['texte_for_share'],
          "default_lang"            =>  $_POST['default_lang'],
          "if_translated"           =>  $if_translated,
          "if_personalizable"       =>  $if_personalizable,
          "codes_countries"         =>  $localite,
          'code_php'                =>  $_POST['codePHPHTML'],
          'code_css'                =>  $_POST['codeCSS'],
          'code_js'                 =>  $_POST['codeJS'],
          'code_head'               =>  $_POST['codeRequireTop'],
          'code_bottom'             =>  $_POST['codeRequireBottom']
        ];
      else
      $new_data = [
        "id_rubrique"             =>  intval($_POST['rubrique']),
        "codes_countries"         =>  $localite,
        "citation_description"    =>  $_POST['texte_for_share'],
        "default_lang"            =>  $_POST['default_lang'],
        "if_translated"           =>  $if_translated,
        "if_personalizable"       =>  $if_personalizable,
        "codes_countries"         =>  $localite,
        'code_css'                =>  $_POST['codeCSS'],
        'code_js'                 =>  $_POST['codeJS'],
        'code_head'               =>  $_POST['codeRequireTop'],
        'code_bottom'             =>  $_POST['codeRequireBottom']
      ];
      $update_citation = Citation::where('id_citation', '=', $id_citation)->update($new_data);

      if($if_translated == 1){
        if ($_POST['default_lang'] == $_POST['langs_citations_edit'] ) {
          $langs = Language::selectRaw('code')->where('status','=', 1)->get();
          // Traduction du code en anglais pour les prochaines traductions
            $titre_citation_en = $this->helper->toEn($_POST['titre'], false);
            $test_for_share_en = $this->helper->toEn($_POST['texte_for_share'], false);
            $code_php = $this->helper->toEn($_POST['codePHPHTML']);

          foreach ($langs as $lang){
            $url_file = $this->helper->getUrlCitationFile($lang->code, $id_citation, "ressources/views/themes/citations/", $_POST['codePHPHTML'], $_POST['codeCSS'], $_POST['codeJS'], $_POST['codeRequireTop'], $_POST['codeRequireBottom']);
            // Do capture
            $citation_img_name = self::captureWithGrabzit($this->grabzit, $url_file, $id_citation, $lang->code);
            // Save to DB
            if( $lang->code == $_POST['default_lang'])
              $new_data_ci = [
                "code_php"                =>  $this->helper->translateWithTags($lang->code, $_POST['codePHPHTML']),
                "url_image_citation"      =>  $citation_img_name,
                "titre_citation"          =>  $_POST['titre'],
                "citation_description"    =>  $_POST['texte_for_share']
              ];
            else
            $new_data_ci = [
              "code_php"                =>  $this->helper->translateWithTags($lang->code, $code_php),
              "url_image_citation"      =>  $citation_img_name,
              "titre_citation"          =>  $this->helper->GoogleTranslate($lang->code, stripslashes($titre_citation_en), "en"),
              "citation_description"    =>  $this->helper->GoogleTranslate($lang->code, stripslashes($test_for_share_en), "en")
            ];
            $this->helper->debug($new_data_ci['citation_description']);
            $update_citation_info = CitationInfo::where([['id_citation','=',$id_citation],['lang','=',$lang->code]])->update($new_data_ci);
          }

        } else {// Mise à jour de la citation dans la langue choisie
          $url_file = $this->helper->getUrlCitationFile($_POST['langs_citations_edit'], $id_citation, "ressources/views/themes/citations/", $_POST['codePHPHTML'], $_POST['codeCSS'], $_POST['codeJS'], $_POST['codeRequireTop'], $_POST['codeRequireBottom']);
          // Do capture
          $citation_img_name = self::captureWithGrabzit($this->grabzit, $url_file, $id_citation, $lang->code);

          $new_data_ci = [
            "code_php"                =>  $_POST['codePHPHTML'],
            "url_image_citation"      =>  $citation_img_name,
            "titre_citation"          =>  $_POST['titre'],
            "citation_description"    =>  $_POST['texte_for_share']
          ];
          $this->helper->debug($new_data_ci['titre_citation']);
          $update_citation_info = CitationInfo::where([['id_citation','=',$id_citation],['lang','=',$_POST['langs_citations_edit']]])->update($new_data_ci);
        }
      }
      return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('alltcitations') );
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

  public static function captureWithGrabzit($grabzit, $filesrc, $id_citation,  $lang)
  {
    $citation_img_name = $lang.'_img_citation_'.$id_citation.'.jpg';
    // Path of the saved image result
    $filepath = "ressources/views/themes/citations/". $citation_img_name ;

    $options = new GrabzItImageOptions();
    $options->setBrowserwidth(800);
    $options->setBrowserHeight(420);
    $options->setQuality(100);
    $options->setFormat("jpg");

    //Grab the image result here and save it
    $file_src = 'http://creation.funizi.com/'.$filesrc;
    $generated = $grabzit->URLToImage($file_src, $options);
    $save = $grabzit->SaveTo($filepath);

    // Upload to S3 AWS
    //...
    //

    return $citation_img_name;
  }

	public static function decode ($code,$pathname) {
	    list($type, $code) = explode(';', $code);
	    list(, $code)      = explode(',', $code);
	    $code = base64_decode($code);
	    file_put_contents($pathname, $code);
		return true;
	}
 
}
