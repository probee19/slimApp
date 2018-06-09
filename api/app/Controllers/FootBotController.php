<?php


namespace App\Controllers;


use App\Helpers\Helper;

class FootBotController extends Controller
{

    public function index($request, $response, $args){

        $data = 'test';
        return $this->view->render($response, 'footBot.twig', compact('data'));
    }
}
