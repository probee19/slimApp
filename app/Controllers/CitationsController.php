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

    public function index($request, $response, $args){
      $sandbox = new Helper();

      $url = $sandbox->detectLang($request, $response);
      if($url != "") return $response->withStatus(302)->withHeader('Location', $url );

      $lang = $sandbox->getLangSubdomain($request);
      $interface_ui = $sandbox->getUiLabels($lang);

      $country_code = $sandbox->getCountryCode();
      $pagecount = $this->test_per_page;
      $citations_col = CitationInfo::where('lang', '=',$lang)->with('citationInfos')->get();
      $citations = [];
      foreach ($citations_col as $citation) {
        if($citation->citationInfos->statut == 1)
          $citations[] = [
            'id_citation'         =>  $citation->id_citation,
            'titre_citation'      =>  $citation->titre_citation,
            'url_image_citation'  =>  $citation->url_image_citation
          ];
      }
      $nb_citation = count($citations);
      $pagecount = (int)ceil($nb_citation / $pagecount);

      if(!empty($arg['pageid']))
        $pageid = $arg['pageid'];
      else
        $pageid = 1;
      $name_session_page = $lang.'_citations_page_'.$pageid;


      //$this->helper->debug($citations);

      $all_lang = $this->helper->getActivatedLanguages();
      return $this->view->render($response, 'citations.twig', compact('citations', 'interface_ui', 'pagecount', 'pageid', 'lang', 'all_lang'));


    }
    public function oneQuote($request, $response, $args)
    {
      // code...
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

      $sandbox->debug($previous_citation);
      $sandbox->debug($citation);
      $sandbox->debug($next_citation);

      $exclude = [];
      if(!empty($_SESSION['uid'])){
          $testUser = User::where('facebook_id', '=', $_SESSION['uid'])->with('usertests')->first();
          if(count($testUser->usertests) > 0)
            foreach($testUser->usertests as $user)
                $exclude [] = $user->test_id;
      }

      $url_to_share = urlencode($request->getUri()->getBaseUrl()."/citation/".$citation['titre_citation']."/".$citation['id_citation']."?utm_source=facebook&utm_medium=share&utm_campaign=funizi_".date('Y-m-d')."&utm_content=quote_".$citation['id_citation']);

      $url_redirect_share = $url_to_share;

      $all_test = $sandbox->relatedTests($country_code, $exclude, $lang);


      $all_lang = $this->helper->getActivatedLanguages();
      return $this->view->render($response, 'singlecitation.twig', compact('citation', 'next_citation', 'previous_citation','id_user', 'all_test', 'interface_ui', 'lang', 'all_lang', 'url_to_share', 'url_redirect_share'));

    }

}
