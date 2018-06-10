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
          'img_url'     =>  $_GET['img_url'],
          'imgtest'     =>  urlencode('https://s3.us-east-2.amazonaws.com/funiziuploads/api/pronostics/pronostic_kO1S4NZlxFIPIp9.jpg'),
          'url'         =>  urlencode('https://funizi.com/api/footbot?from=Pedre&img_url=https%3A%2F%2Fs3.us-east-2.amazonaws.com%2Ffuniziuploads%2Fapi%2Fpronostics%2Fpronostic_kO1S4NZlxFIPIp9.jpg')
          ];
        Helper::debug($data);
        return $this->view->render($response, 'footBot.twig', compact('data'));
    }
}