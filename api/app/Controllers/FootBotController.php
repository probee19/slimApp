<?php


namespace App\Controllers;


use App\Helpers\Helper;

class FootBotController extends Controller
{

    public function index($request, $response, $args){
      $user = $args['first_name'];
      $img = $args['img_url'];
        $data = [
          'text'        =>  'Découvrir FootBot',
          'btn_title'   =>  'FootBot',
          'user'        =>  $args['first_name'],
          'img_url'     =>  $args['img_url']
          ];
        return $this->view->render($response, 'footBot.twig', compact('data'));
    }
}
