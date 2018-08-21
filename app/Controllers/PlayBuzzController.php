<?php
namespace App\Controllers;
use App\Helpers\RandomStringGenerator;
use App\Helpers\Helper;
use App\Models\Test;
use App\Models\Citation;
use App\Models\CitationInfo;
use App\Models\User;
use App\Models\UserTest;
use App\Models\Language;
use App\Models\PlayBuzz;
class PlayBuzzController extends Controller
{

    public function index($request, $response, $arg){
      $sandbox = new Helper();

      $url = $sandbox->detectLang($request, $response);
      if($url != "") return $response->withStatus(302)->withHeader('Location', $url );

      $lang = $sandbox->getLangSubdomain($request);
      $interface_ui = $sandbox->getUiLabels($lang);


      $country_code = $sandbox->getCountryCode();
      $pagecount = $this->playbuzz_per_page;
      $playbuzz_from_json = $this->helper->getAllPlayBuzzJson($lang);


      // Calcul du nombre total de contenus
      foreach ($playbuzz_from_json as $playbuzz) {
        if($playbuzz['codes_countries'] == "" || strpos($playbuzz['codes_countries'], $country_code) != false ){
          $playbuzz_json[] = [
            'url_image_playbuzz'      => $playbuzz['url_image_playbuzz'],
            'id_playbuzz'             => $playbuzz['id_playbuzz'],
            'titre_playbuzz'          => $playbuzz['titre_playbuzz']
          ];
        }
      }

      $allplaybuzz = count($playbuzz_json);

      // Nombre de pages
      $pagecount = (int)ceil($allplaybuzz / $pagecount);

      if(!empty($arg['pageid']))
        $pageid = $arg['pageid'];
      else
        $pageid = 1;
      $name_session_page = $lang.'_playbuzz_page_'.$pageid;

      //
      // Si cette page a été déjà ouverte et en session
      if(isset($_SESSION[$name_session_page]) && !empty($_SESSION[$name_session_page]) ){
        $include = $_SESSION[$name_session_page];
        foreach ($playbuzz_from_json as $playbuzz) {
          if(in_array($playbuzz['id_playbuzz'], $include, true)){
            $playbuzzzzz[$playbuzz['id_playbuzz']] = [
              'url_image_playbuzz'      => $playbuzz['url_image_playbuzz'],
              'id_playbuzz'             => $playbuzz['id_playbuzz'],
              'titre_playbuzz'          => $playbuzz['titre_playbuzz']
            ];
          }
        }
        $playbuzzzzz = array_replace(array_flip($include), $playbuzzzzz);
      }
      else {// Si cette page n'est pas en session

        if(isset($_SESSION["playbuzz_seen"]) && $allplaybuzz <= count($_SESSION["playbuzz_seen"]))
          $_SESSION["playbuzz_seen"] = array();
        $exclude = array();
        if(isset($_SESSION['playbuzz_seen'])) $exclude = $_SESSION['playbuzz_seen'];
        shuffle($playbuzz_from_json);
        $nb_taken = 0;
        $page_playbuzz = array();
        foreach ($playbuzz_from_json as $playbuzz) {
          if(($playbuzz['codes_countries'] == "" || strpos($playbuzz['codes_countries'], $country_code) != false ) && !in_array($citation['id_citation'], $exclude, true) && ++$nb_taken <= $this->playbuzz_per_page){
            $playbuzzzzz[$playbuzz['id_playbuzz']] = [
              'url_image_playbuzz'      => $playbuzz['url_image_playbuzz'],
              'id_playbuzz'             => $playbuzz['id_playbuzz'],
              'titre_playbuzz'          => $playbuzz['titre_playbuzz']
            ];
            if(!in_array($playbuzz['id_playbuzz'], $exclude, true)) $exclude[] = $playbuzz['id_citation'];
            $page_playbuzz[] = $playbuzz['id_playbuzz'];
          }
        }

          $_SESSION['playbuzz_seen'] = $exclude;
          $_SESSION[$name_session_page] = $page_playbuzz;
      }
      $this->helper->debug($playbuzzzzz);

      //
      $tests = $sandbox->relatedTests(0, $country_code, [], $lang);

      $all_lang = $this->helper->getActivatedLanguages();
      $data_playbuzz = $playbuzzzzz;
      return $this->view->render($response, 'playbuzz.twig', compact('data_playbuzz', 'tests', 'interface_ui', 'pagecount', 'pageid', 'lang', 'all_lang'));


    }

    public function onePlayBuzz($request, $response, $args){
      $sandbox = new Helper();

      $url = $sandbox->detectLang($request, $response);
      if($url != "") return $response->withStatus(302)->withHeader('Location', $url );

      $lang = $sandbox->getLangSubdomain($request);
      $interface_ui = $sandbox->getUiLabels($lang);

      $id = (int) $args['id'];
      $country_code = $sandbox->getCountryCode();

      $citation_col = CitationInfo::where([['id_citation', '=', $id],['lang','=',$lang]])->first();
      //$citation = Citation::where('id_citation','=',$id)->first();

      $citation =[
        "id_citation"             =>  $citation_col->id_citation,
        "titre_citation"          =>  $citation_col->titre_citation,
        "citation_description"    =>  $citation_col->citation_description,
        "url_image_citation"      =>  '/images/'.$citation_col->url_image_citation
      ];


      $next_citation_col = CitationInfo::where([['id_citation', '>', $id],['lang','=',$lang]])->orderBy('id_citation','ASC')->first();
      $previous_citation_col = CitationInfo::where([['id_citation', '<', $id],['lang','=',$lang]])->orderBy('id_citation','DESC')->first();

      if($next_citation_col)
        $next_citation =[
          "id_citation"             =>  $next_citation_col->id_citation,
          "titre_citation"          =>  $next_citation_col->titre_citation,
        ];

      if($previous_citation_col)
        $previous_citation =[
          "id_citation"             =>  $previous_citation_col->id_citation,
          "titre_citation"          =>  $previous_citation_col->titre_citation,
        ];

      $exclude = [];
      if(!empty($_SESSION['uid'])){
          $citationUser = User::where('facebook_id', '=', $_SESSION['uid'])->with('usertests')->first();
          if(count($citationUser->usertests) > 0)
            foreach($citationUser->usertests as $user)
                $exclude [] = $user->test_id;
      }

      $url_to_share = urlencode($request->getUri()->getBaseUrl()."/citation/".$citation['titre_citation']."/".$citation['id_citation']."?utm_source=facebook&utm_medium=share&utm_campaign=funizi_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation']);

      $url_redirect_share = $url_to_share;
      $id_test = 0;
      $all_test = $sandbox->relatedTests($id_test, $country_code, $exclude, $lang);

      $url_to_share_msg =  urlencode($request->getUri()->getBaseUrl()."/citation/".$citation['titre_citation']."/".$citation['id_citation']."?utm_source=facebook&utm_medium=messenger&utm_campaign=funizi_messenger_share_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation']);
      $url_to_share_wtsp = urlencode($request->getUri()->getBaseUrl()."/citation/".$citation['titre_citation']."/".$citation['id_citation']."?utm_source=facebook&utm_medium=whatsapp&utm_campaign=funizi_whatsapp_share_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation']);


      $all_lang = $this->helper->getActivatedLanguages();
      return $this->view->render($response, 'singlecitation.twig', compact('citation', 'next_citation', 'previous_citation','id_user', 'all_test', 'interface_ui', 'lang', 'all_lang', 'url_to_share','url_to_share_msg', 'url_to_share_wtsp', 'url_redirect_share' ));

    }

}
