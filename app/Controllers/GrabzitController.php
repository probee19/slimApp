<?php
namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Resultat;

class GrabzitController extends Controller
{
    public function index($request, $response, $args){
        $theme = $args['theme'];
        $name = urldecode($args['name']);
        $user_id = $args['fb_id'];
        $title = urldecode($args['title']);
        $img_url = $args['img_url'];
        if($theme == '2'){
            $texte = Resultat::where('id_resultat', '=', "$title")->pluck('texte_resultat')->first();
            return $this->view->render($response, '/themes/theme2.twig', compact('name', 'user_id', 'texte', 'img_url'));
        }
        elseif($theme == '3'){
            // name = name of user ; title = name of friend ; img_url = FB ID of friend
            return $this->view->render($response, '/themes/theme3.twig', compact('name', 'user_id', 'title', 'img_url'));
        }
        elseif ($theme == '4') {


        }
        return $this->view->render($response, 'theme1.twig', compact('name', 'user_id', 'title', 'img_url'));
    }
    public function getImageFromUrl($request, $response){
        $img_url = $request->getParam('url');
        //$img_url = urlencode($img_url);
        $t_now = time();
        //$img_url = explode('-is_slash-', $img_url);
        //$url = 'http://' . implode('/', $img_url);
        //echo $url;
        $filepath = "uploads/urltoimage$t_now.png";

        $save = copy($img_url, $filepath);
        if($save)
            return $response->withStatus(201)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode($filepath));
    }
}
