<?php


namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Visitors;
use App\Models\ClickEvents;

class ClickController extends Controller
{
    public function index($request, $response, $args){
        $btn = $args['btn'];
        Helper::debug($_COOKIE["visitor"]);
        $click="";
		if(isset($_COOKIE["visitor"])){
			$visitor = Visitors::where('cookie_code', $_COOKIE["visitor"])->first();
			$ip = $visitor->ip_address;
			$browser = $visitor->browser;
            $cookie_code = $_COOKIE["visitor"];
            Helper::debug($browser);

            $data_click =[
				"button" 		=>	"$btn",
				"cookie_code"	=>	"$cookie_code",
                "ip_address"	=>	"$ip",
                "browser"	    =>	"$browser"
			];
		}
        else {
            $helper = new Helper();
            $cookie = $helper->createCookie();
            $cookie_code = $cookie->cookie_code;
            $ip = $cookie->ip_address;
            $browser = $cookie->browser;

            $data_click =[
				"button" 		=>	"$btn",
				"cookie_code"	=>	"$cookie_code",
                "ip_address"	=>	"$ip",
                "browser"	    =>	"$browser"
			];
        }
        $click = ClickEvents::create($data_click);
        if($click)
            Helper::debug($click);

		return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($click));
    }
}
