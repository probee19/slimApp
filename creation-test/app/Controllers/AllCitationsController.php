<?php


namespace App\Controllers;


use App\Helpers\Helper;
use App\Models\DailyStat;
use App\Models\Resultat;
use App\Models\Share;
use App\Models\Citation;
use App\Models\CitationInfo;
use App\Models\User;
use App\Models\UserTest;
use App\Models\Rubrique;

class AllCitationsController extends Controller
{
    public function index($request, $response, $args){
      //Helper::checkCookies();
      if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL)
        return $response->withStatus(302)->withHeader('Location', "https://creation.funizi.com" );

        $data_users_tests = array();
        $rubriques = Rubrique::all();
        $citations = CitationInfo::where('lang','=','fr')->with('CitationInfo')->orderBy('id','DESC')->take(40)->get();
        foreach ($citations as $citation) {

          $date_citation = new \DateTime($citation->created_at);
          $today =new \DateTime();
          if($today->format("d") == $date_citation->format("d")) $jour = " Aujourd'hui";
          else $jour = $date_citation->format("d").'/'.$date_citation->format("m").'/'.$date_citation->format("Y");
          $heure = $date_citation->format("H").':'.$date_citation->format("i").':'.$date_citation->format("s");

          $data_citations[] = [
            'id_citation'     =>  $citation->id_citation,
            'img_url'         =>  $citation->url_image_citation,
            'titre_citation'  =>  $citation->titre_citation,
            'rubrique'        =>  $citation->CitationInfo->id_rubrique,
            'shared'          =>  $citation->CitationInfo->shares_count,
            'day'             =>  $jour,
            'hour'            =>  $heure,
          ];
        }
        //$this->helper->debug($data_citations);

        return $this->view->render($response, 'allCitations.twig', compact('rubriques', 'data_citations'));
    }

    public function citationsToTable($request, $response, $args){
      //Helper::checkCookies();
      if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == NULL)
        return $response->withStatus(302)->withHeader('Location', "https://creation.funizi.com" );

        $data_users_tests = array();
        $rubriques = Rubrique::all();
        //$citations = CitationInfo::where('lang','=','fr')->with('CitationInfo')->orderBy('id','DESC')->take(40)->get();
        $citations = Citation::where('statut','!=',-1)->orderBy('id_citation','DESC')->take(40)->get();

        foreach ($citations as $citation) {

          $date_citation = new \DateTime($citation->created_at);
          $today =new \DateTime();
          if($today->format("d") == $date_citation->format("d")) $jour = " Aujourd'hui";
          else $jour = $date_citation->format("d").'/'.$date_citation->format("m").'/'.$date_citation->format("Y");
          $heure = $date_citation->format("H").':'.$date_citation->format("i").':'.$date_citation->format("s");

          $if_translated = 'Non';
          if($citation->if_translated == 1)
            $if_translated = 'Oui';

          $link = 'http://'.$citation->default_lang.'.funizi.com/citation/'.$this->helper->cleanUrl($citation->titre_citation).'/'.$citation->id_citation;

          $data_citations[] = [
            'id_citation'     =>  $citation->id_citation,
            'titre_citation'  =>  $citation->titre_citation,
            'lang'            =>  $citation->default_lang,
            'if_translated'   =>  $if_translated,
            'url_citation'    =>  $link,
            'statut'          =>  $citation->statut,
            'rubrique'        =>  $citation->id_rubrique,
            'shared'          =>  $citation->shares_count,
            'day'             =>  $jour,
            'hour'            =>  $heure,
          ];
        }
        //$this->helper->debug($data_citations);

        return $this->view->render($response, 'allCitationsTable.twig', compact('rubriques', 'data_citations'));
    }


}
