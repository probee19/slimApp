<?php
namespace App\Controllers;

use App\Helpers\DBIP;
use App\Helpers\Helper;
use App\Helpers\Browser;
use App\Models\Admin;
use App\Models\Test;
use App\Models\User;
use App\Models\UserTest;
use App\Models\Visitors;
use App\Models\Countries;
use App\Controllers\AirtableController;
use Psr7Middlewares\Middleware\ClientIp;
use GrabzItImageOptions;

class ShareApiController extends Controller
{
    public function index($request, $response, $arg){
      $user = $_POST['first_name'];
      $img = $_POST['img'];


    return $this->view->render($response, 'page.twig', compact('user','img'));

    }



}
