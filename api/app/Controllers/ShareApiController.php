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
      $user = $_GET['first_name'];
      $img = $_GET['img_url'];
      $team_a = $_GET['team_a'];
      $team_b = $_GET['team_b'];
      $data = [
        'user'       => $_GET['first_name'],
        'img'        => $_GET['img_url'],
        'team_a'     => $_GET['team_a'],
        'team_b'     => $_GET['team_b']
      ];

    $url_to_share = urlencode('https://funizi.com/api/footbot?from='.$_GET['first_name'].'&img_url='.$_GET['img_url']);
    $url_redirect_share = $url_to_share;
    $result_description = 'Partage ton pronostic à tes amis et à tes proches.';


    $lang = $this->helper->getLangSubdomain($request);
    $interface_ui = $this->helper->getUiLabels($lang);

    return $this->view->render($response, 'share.twig', compact('data','url_to_share','url_redirect_share','result_description','interface_ui'));

    }



}
