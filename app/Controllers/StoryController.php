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
use App\Models\Story;
class StoryController extends Controller
{

    public function index($request, $response, $arg){
      $sandbox = new Helper();

      $url = $sandbox->detectLang($request, $response);
      if($url != "") return $response->withStatus(302)->withHeader('Location', $url );

      $lang = $sandbox->getLangSubdomain($request);
      $interface_ui = $sandbox->getUiLabels($lang);


      $country_code = $sandbox->getCountryCode();
      $pagecount = $this->story_per_page;
      $stories_from_json = $this->helper->getAllStoriesJson($lang);



      // Calcul du nombre total de ciataions
      foreach ($stories_from_json as $story) {
        if($story['codes_countries'] == "" || strpos($story['codes_countries'], $country_code) != false ){
          $stories_json[] = [
            'url_image_story'      => $story['url_image_story'],
            'id_story'             => $story['id_story'],
            'titre_story'          => $story['titre_story']
          ];
        }
      }

      $allstories = count($stories_json);

      // Nombre de pages
      $pagecount = (int)ceil($allstories / $pagecount);

      if(!empty($arg['pageid']))
        $pageid = $arg['pageid'];
      else
        $pageid = 1;
      $name_session_page = $lang.'_stories_page_'.$pageid;

      //
      // Si cette page a été déjà ouverte et en session
      if(isset($_SESSION[$name_session_page]) && !empty($_SESSION[$name_session_page]) ){
        $include = $_SESSION[$name_session_page];
        foreach ($stories_from_json as $story) {
          if(in_array($story['id_story'], $include, true)){
            $stories[$story['id_story']] = [
              'url_image_story'      => $story['url_image_story'],
              'url_thumb_img_story'  => $story['url_thumb_img_story'],
              'id_story'             => $story['id_story'],
              'titre_story'          => $story['titre_story'],
            ];
          }
        }
        $stories = array_replace(array_flip($include), $stories);
      }
      else {// Si cette page n'est pas en session

        if(isset($_SESSION["stories_seen"]) && $allstories <= count($_SESSION["stories_seen"]))
          $_SESSION["stories_seen"] = array();
        $exclude = array();
        if(isset($_SESSION['stories_seen'])) $exclude = $_SESSION['stories_seen'];
        shuffle($stories_from_json);
        $nb_taken = 0;
        $page_stories = array();
        foreach ($stories_from_json as $story) {
          if(($story['codes_countries'] == "" || strpos($story['codes_countries'], $country_code) != false ) && !in_array($story['id_story'], $exclude, true) && ++$nb_taken <= $this->citation_per_page){
            $stories[$story['id_story']] = [
              'url_image_story'      => $story['url_image_story'],
              'url_thumb_img_story'  => $story['url_thumb_img_story'],
              'id_story'             => $story['id_story'],
              'titre_story'          => $story['titre_story'],
            ];
            if(!in_array($story['id_story'], $exclude, true)) $exclude[] = $story['id_story'];
            $page_stories[] = $story['id_story'];
          }
        }

          $_SESSION['stories_seen'] = $exclude;
          $_SESSION[$name_session_page] = $page_stories;
      }

      //
      $tests = $sandbox->relatedTests(0, $country_code, [], $lang);

      $all_lang = $this->helper->getActivatedLanguages();
      return $this->view->render($response, 'stories.twig', compact('stories', 'id_shared_story','img_shared_story', 'tests', 'interface_ui', 'pagecount', 'pageid', 'lang', 'all_lang'));



    }

    public function story($request, $response, $args){
      $sandbox = new Helper();

      $url = $sandbox->detectLang($request, $response);
      if($url != "") return $response->withStatus(302)->withHeader('Location', $url );

      $lang = $sandbox->getLangSubdomain($request);
      $interface_ui = $sandbox->getUiLabels($lang);

      $id = (int) $args['id'];
      $country_code = $sandbox->getCountryCode();

      $story_col = Story::where([['id_story', '=', $id],['default_lang','=',$lang]])->first();

      $story =[
        "id_story"             =>  $story_col->id_story,
        "titre_story"          =>  $story_col->titre_story,
        "code_story"            =>  $story_col->code_story,
        "url_image_story"      =>  '/images/'.$story_col->url_image_story
      ];


      $exclude = [];
      if(!empty($_COOKIE['uid'])){
          $storyUser = User::where('facebook_id', '=', $_SESSION['uid'])->with('usertests')->first();
          if(count($storyUser->usertests) > 0)
            foreach($storyUser->usertests as $user)
                $exclude [] = $user->test_id;
      }


      $id_test = 0;
      $all_test = $sandbox->relatedTests($id_test, $country_code, $exclude, $lang);

      $all_lang = $this->helper->getActivatedLanguages();
      return $this->view->render($response, 'singlecitation.twig', compact('story', 'id_user', 'all_test', 'interface_ui', 'lang', 'all_lang'));

    }

}
