<?php


namespace App\Controllers;


use App\Helpers\Helper;

class FootBotController extends Controller
{

    public function index($request, $response, $args){


        return $this->view->render($response, 'footBot.twig', compact('test', 'code', 'all_test', 'new_con', 'permission', 'loginUrl', 'loginUrl2' , 'test_owner', 'img_url'));
    }
}
