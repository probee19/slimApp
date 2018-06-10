<?php


namespace App\Controllers;


use App\Helpers\Helper;

class FootBotController extends Controller
{

    public function index($request, $response, $args){
      $user = $_GET['from'];
      $img = $_GET['img_url'];
        $data = [
          'text'        =>  'Découvrir FootBot',
          'btn_title'   =>  'FootBot',
          'user'        =>  $_GET['from'],
          'img_url'     =>  $_GET['img_url']
          ];
        Helper::debug($data);
        return $this->view->render($response, 'footBot.twig', compact('data'));
    }
}
