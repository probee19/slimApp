<?php

use App\Controllers\ConnectController;
use App\Controllers\GrabzitController;
use App\Controllers\HomeController;
use App\Controllers\ShareController;
use App\Controllers\TestController;
use App\Controllers\StartController;
use App\Controllers\ResultController;
use App\Controllers\ClickController;
use App\Controllers\AirtableController;
use App\Controllers\FootBotController;
use App\Controllers\ShareApiController;

use App\Helpers\Helper;
use Bes\Twig\Extension\MobileDetectExtension;
use Facebook\Facebook;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;

use Psr7Middlewares\Middleware;
use Psr7Middlewares\Middleware\EncodingNegotiator;
use Psr7Middlewares\Middleware\Gzip;
use Psr7Middlewares\Middleware\TrailingSlash;
use Psr7Middlewares\Transformers\Minifier;

use Slim\App;
use Slim\Flash\Messages;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

session_start();


define('RDS_HOSTNAME', $_SERVER['RDS_HOSTNAME']);
define('RDS_USERNAME', $_SERVER['RDS_USERNAME']);
define('RDS_PASSWORD', $_SERVER['RDS_PASSWORD']);
define('RDS_DB_NAME',  $_SERVER['RDS_DB_NAME']);
define('GZIT_KEY', $_SERVER['GZIT_KEY']);
define('GZIT_SECRET', $_SERVER['GZIT_SECRET']);
define('FB_SECRET_KEY', $_SERVER['FB_SECRET_KEY']);
define('FB_APP_ID', $_SERVER['FB_APP_ID']);
define('SERVER_DOMAIN', $_SERVER['SERVER_DOMAIN']);
define('AIRTABLE_API_KEY', $_SERVER['AIRTABLE_API_KEY']);

require __DIR__ . '/../vendor/autoload.php';


$config = [
    'displayErrorDetails'   =>  true,
    'db'        =>  [
        'driver'    =>  'mysql',
        'host'      =>  RDS_HOSTNAME,
        'database'  =>  RDS_DB_NAME,
        'username'  =>  RDS_USERNAME,
        'password'  =>  RDS_PASSWORD,
        'charset'   =>  'utf8mb4',
        'collation' =>  'utf8mb4_unicode_ci',
        'prefix'    =>  '',
    ],
    'grabzit_key'       => GZIT_KEY,
    'grabzit_secret'    => GZIT_SECRET,
    'test_per_page'     => 15,
];
date_default_timezone_set('Etc/GMT');

$app = new App(["settings" => $config]);

$checkProxyHeaders = true; // Note: Never trust the IP address for security processes!
$trustedProxies = ['10.0.0.1', '10.0.0.2']; // Note: Never trust the IP address for security processes!
$app->add(new \RKA\Middleware\IpAddress($checkProxyHeaders, $trustedProxies))
    ->add(new TrailingSlash(false))
    ->add(new Middleware\ClientIp());

$container = $app->getContainer();
/*$container['db'] = function (ContainerInterface $container) {
    $settings = $container->get('database');
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($settings);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};*/

$capsule = new Capsule;
$capsule->addConnection($config['db']);
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();




$container['flash'] = function ($container) {
    return new Messages;
};
$container['view'] = function ($container){
    $view = new Twig(__DIR__ . '/../ressources/views', [
        'cache'   =>  false,
    ]);

    $view->addExtension(new TwigExtension(
            $container->router,
            $container->request->getUri()
    ));
    $view->addExtension(new MobileDetectExtension());

    $twigCleanUrl = new Twig_SimpleFilter('twig_clean_url', function ($data){
        //$data = iconv('UTF-8', 'ASCII//TRANSLIT', $data);
        return Helper::cleanUrl($data);
    });
    // Adding created custom filter to twig envirnment
    $view->getEnvironment()->addFilter($twigCleanUrl);
    $view->getEnvironment()->addGlobal('flash', $container->flash);
    $domaine_url = str_replace( 'http://', 'https://', $container->request->getUri()->getBaseUrl());
    $view->getEnvironment()->addGlobal('domain_url', $domaine_url);
    $view->getEnvironment()->addGlobal('session', $_SESSION);

    return $view;
};

//Facebook app config
$container['base_domain'] = SERVER_DOMAIN;
$container['airtable_api_key'] = AIRTABLE_API_KEY;

$container['airtable'] = "https://api.airtable.com/v0/appec3rBvyPYpIOAx/";

$container['fb'] = function($container){
    return new Facebook([
        'app_id' => FB_APP_ID,
        'app_secret' => FB_SECRET_KEY,
        'default_graph_version' => 'v2.5',
    ]);
};
$container['test_per_page'] = function ($container) {
    return $container['settings']['test_per_page'];
};
$container['HomeController'] = function ($container) {
    return new HomeController($container);
};
$container['TestController'] = function ($container) {
    return new TestController($container);
};
$container['StartController'] = function ($container) {
    return new StartController($container);
};
$container['ClickController'] = function ($container) {
    return new ClickController($container);
};
$container['GrabzitController'] = function ($container) {
    return new GrabzitController($container);
};
$container['ResultController'] = function ($container) {
    return new ResultController($container);
};
$container['ShareController'] = function ($container) {
    return new ShareController($container);
};
$container['ClickController'] = function ($container) {
    return new ClickController($container);
};
$container['ConnectController'] = function ($container) {
    return new ConnectController($container);
};
$container['AirtableController'] = function ($container) {
    return new AirtableController($container);
};
$container['FootBotController'] = function ($container) {
    return new FootBotController($container);
};
$container['ShareApiController'] = function ($container) {
    return new ShareApiController($container);
};
$container['DailyStatsController'] = function ($container) {
    return new DailyStatsController($container);
};
$container['grabzit'] = function ($container) {
    return new GrabzItClient(GZIT_KEY, GZIT_SECRET);
};
$container['helper'] = function ($container){
    return new Helper();
};
$container['notFoundHandler'] = function($container)
{
    return function($request, $response) use ($container)
    {
        return $container['view']->render($response->withStatus(404), 'errors/404.twig');
    };
};


require_once __DIR__ . '/../app/routes.php';
