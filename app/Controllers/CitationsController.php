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
class CitationsController extends Controller
{

    public function index($request, $response, $arg){
      $sandbox = new Helper();

      $url = $sandbox->detectLang($request, $response);
      if($url != "") return $response->withStatus(302)->withHeader('Location', $url );

      $lang = $sandbox->getLangSubdomain($request);
      $interface_ui = $sandbox->getUiLabels($lang);


      $country_code = $sandbox->getCountryCode();
      $pagecount = $this->citation_per_page;
      $citations_from_json = $this->helper->getAllCitationJson($lang);

      $id_shared_citation ='';
      if(isset($arg['id'])){
        $id_shared_citation = $arg['id'];
        $img_shared_citation = $citations_from_json[$id_shared_citation]['url_image_citation'];
      }

      // Calcul du nombre total de ciataions
      foreach ($citations_from_json as $citation) {
        if($citation['codes_countries'] == "" || strpos($citation['codes_countries'], $country_code) != false ){
          $citations_json[] = [
            'url_image_citation'      => $citation['url_image_citation'],
            'url_thumb_img_citation'  => $citation['url_thumb_img_citation'],
            'id_citation'             => $citation['id_citation'],
            'titre_citation'          => $citation['titre_citation']
          ];
        }
      }

      $allcitation = count($citations_json);

      // Nombre de pages
      $pagecount = (int)ceil($allcitation / $pagecount);

      if(!empty($arg['pageid']))
        $pageid = $arg['pageid'];
      else
        $pageid = 1;
      $name_session_page = $lang.'_citations_page_'.$pageid;

      //
      // Si cette page a été déjà ouverte et en session
      if(isset($_SESSION[$name_session_page]) && !empty($_SESSION[$name_session_page]) ){
        $include = $_SESSION[$name_session_page];
        foreach ($citations_from_json as $citation) {
          if(in_array($citation['id_citation'], $include, true)){
            //$url_to_share =      urlencode($request->getUri()->getBaseUrl()."/citation/".$citation['titre_citation']."/".$citation['id_citation']."?utm_source=facebook&utm_medium=share&utm_campaign=funizi_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation']);
            //$url_to_share_msg =  urlencode($request->getUri()->getBaseUrl()."/citation/".$citation['titre_citation']."/".$citation['id_citation']."?utm_source=facebook&utm_medium=messenger&utm_campaign=funizi_messenger_share_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation']);
            //$url_to_share_wtsp = urlencode($request->getUri()->getBaseUrl()."/citation/".$citation['titre_citation']."/".$citation['id_citation']."?utm_source=facebook&utm_medium=whatsapp&utm_campaign=funizi_whatsapp_share_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation']);

            $citations[$citation['id_citation']] = [
              'url_image_citation'      => $citation['url_image_citation'],
              'url_thumb_img_citation'  => $citation['url_thumb_img_citation'],
              'id_citation'             => $citation['id_citation'],
              'titre_citation'          => $citation['titre_citation'],
              'redirect_uri'            => urlencode($request->getUri()->getBaseUrl()."/citations/"),
              'url_to_share'            => urlencode($request->getUri()->getBaseUrl()."/citations/ref/".$citation['id_citation']."?utm_source=facebook&utm_medium=share&utm_campaign=funizi_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation']),
              'url_to_share_msg'        => urlencode($request->getUri()->getBaseUrl()."/citations/ref/".$citation['id_citation']."?utm_source=facebook&utm_medium=messenger&utm_campaign=funizi_messenger_share_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation']),
              'url_to_share_wtsp'       => urlencode($request->getUri()->getBaseUrl()."/citations/ref/".$citation['id_citation']."?utm_source=facebook&utm_medium=whatsapp&utm_campaign=funizi_whatsapp_share_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation']),
              //'redirect_uri'            => urlencode($request->getUri()->getBaseUrl()."/citations/?utm_source=facebook&utm_medium=share&utm_campaign=funizi_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation']),
              //'url_to_share'            => urlencode($request->getUri()->getBaseUrl()."/citation/".$citation['titre_citation']."/".$citation['id_citation']."?utm_source=facebook&utm_medium=share&utm_campaign=funizi_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation']),
              //'url_to_share_msg'        => urlencode($request->getUri()->getBaseUrl()."/citation/".$citation['titre_citation']."/".$citation['id_citation']."?utm_source=facebook&utm_medium=messenger&utm_campaign=funizi_messenger_share_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation']),
              //'url_to_share_wtsp'       => urlencode($request->getUri()->getBaseUrl()."/citation/".$citation['titre_citation']."/".$citation['id_citation']."?utm_source=facebook&utm_medium=whatsapp&utm_campaign=funizi_whatsapp_share_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation'])
            ];
          }
        }
        $citations = array_replace(array_flip($include), $citations);
      }
      else {// Si cette page n'est pas en session

        if(isset($_SESSION["citations_seen"]) && $allcitation <= count($_SESSION["citations_seen"]))
          $_SESSION["citations_seen"] = array();
        $exclude = array();
        if(isset($_SESSION['citations_seen'])) $exclude = $_SESSION['citations_seen'];
        shuffle($citations_from_json);
        $nb_taken = 0;
        $page_citations = array();
        foreach ($citations_from_json as $citation) {
          if(($citation['codes_countries'] == "" || strpos($citation['codes_countries'], $country_code) != false ) && !in_array($citation['id_citation'], $exclude, true) && ++$nb_taken <= $this->citation_per_page){
            $citations[$citation['id_citation']] = [
              'url_image_citation'      => $citation['url_image_citation'],
              'url_thumb_img_citation'  => $citation['url_thumb_img_citation'],
              'id_citation'             => $citation['id_citation'],
              'titre_citation'          => $citation['titre_citation'],
              'url_to_share'            => urlencode($request->getUri()->getBaseUrl()."/citation/".$citation['titre_citation']."/".$citation['id_citation']."?utm_source=facebook&utm_medium=share&utm_campaign=funizi_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation']),
              'url_to_share_msg'        => urlencode($request->getUri()->getBaseUrl()."/citation/".$citation['titre_citation']."/".$citation['id_citation']."?utm_source=facebook&utm_medium=messenger&utm_campaign=funizi_messenger_share_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation']),
              'url_to_share_wtsp'       => urlencode($request->getUri()->getBaseUrl()."/citation/".$citation['titre_citation']."/".$citation['id_citation']."?utm_source=facebook&utm_medium=whatsapp&utm_campaign=funizi_whatsapp_share_quote_".date('Y-m-d')."&utm_content=citation_".$citation['id_citation'])
            ];
            if(!in_array($citation['id_citation'], $exclude, true)) $exclude[] = $citation['id_citation'];
            $page_citations[] = $citation['id_citation'];
          }
        }

          $_SESSION['citations_seen'] = $exclude;
          $_SESSION[$name_session_page] = $page_citations;
      }

      //
      $tests = $sandbox->relatedTests(0, $country_code, [], $lang);

      $all_lang = $this->helper->getActivatedLanguages();
      return $this->view->render($response, 'citations.twig', compact('citations', 'id_shared_citation','img_shared_citation', 'tests', 'interface_ui', 'pagecount', 'pageid', 'lang', 'all_lang'));


    }

    public function oneQuote($request, $response, $args){
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
