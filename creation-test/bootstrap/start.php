<?php

use App\Controllers\ConnectController;
use App\Controllers\GrabzitController;
use App\Controllers\HomeController;
use App\Controllers\ShareController;
use App\Controllers\TestController;
use App\Controllers\StartController;
use App\Controllers\AllResultsController;
use App\Controllers\ClickController;
use App\Controllers\CronController;
use App\Controllers\LoadStatsController;
use App\Controllers\CreateTestController;
use App\Controllers\ActionTestController;
use App\Controllers\AllTestsController;
use App\Controllers\LangController;
use App\Controllers\JsonController;

use App\Helpers\Helper;
use Bes\Twig\Extension\MobileDetectExtension;
use Facebook\Facebook;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;

use Psr7Middlewares\Middleware;
use Psr7Middlewares\Middleware\Https;
use Psr7Middlewares\Middleware\EncodingNegotiator;
use Psr7Middlewares\Middleware\Gzip;
use Psr7Middlewares\Middleware\TrailingSlash;
use Psr7Middlewares\Transformers\Minifier;

use Slim\App;
use Slim\Flash\Messages;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

session_start();
// RDS CONST
define('RDS_HOSTNAME', $_SERVER['RDS_HOSTNAME']);
define('RDS_USERNAME', $_SERVER['RDS_USERNAME']);
define('RDS_PASSWORD', $_SERVER['RDS_PASSWORD']);
define('RDS_DB_NAME',  $_SERVER['RDS_DB_NAME']);
define('GZIT_KEY', $_SERVER['GZIT_KEY']);
define('GZIT_SECRET', $_SERVER['GZIT_SECRET']);
define('FB_SECRET_KEY', $_SERVER['FB_SECRET_KEY']);

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
    'test_per_page'     =>  12,
    'default_lang'      =>  "en",
];
date_default_timezone_set('Etc/GMT');

$app = new App(["settings" => $config]);
$https = new Https(true);
$app->add($https->maxAge(315360000)->includeSubdomains());
$checkProxyHeaders = true; // Note: Never trust the IP address for security processes!
$trustedProxies = ['10.0.0.1', '10.0.0.2']; // Note: Never trust the IP address for security processes!
$app->add(new \RKA\Middleware\IpAddress($checkProxyHeaders, $trustedProxies))
    ->add(new TrailingSlash(false))
    ->add(new Middleware\ClientIp());

$container = $app->getContainer();

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
    $view->getEnvironment()->addFilter(new Twig_SimpleFilter('addslashes', 'addslashes'));
    $view->getEnvironment()->addFilter(new Twig_SimpleFilter('htmlspecialchars', 'htmlspecialchars'));
    $view->getEnvironment()->addFilter(new Twig_SimpleFilter('html_entity_decode', 'html_entity_decode'));
    $view->getEnvironment()->addFilter(new Twig_SimpleFilter('date("d/m/Y")', 'date("d/m/Y")'));
    $view->getEnvironment()->addFilter(new Twig_SimpleFilter('date("d/m/Y H:i:s")', 'date("d/m/Y H:i:s")'));
    $view->getEnvironment()->addFilter(new Twig_SimpleFilter('date("d/m/Y à H:i:s")', 'date("d/m/Y à H:i:s")'));
    $view->getEnvironment()->addFilter(new Twig_SimpleFilter('date("H:i:s")', 'date("H:i:s")'));
    $view->getEnvironment()->addFilter($twigCleanUrl);
    $view->getEnvironment()->addGlobal('flash', $container->flash);
    $view->getEnvironment()->addGlobal('session', $_SESSION);
    $view->getEnvironment()->addGlobal('cookie', $_COOKIE);
    $view->getEnvironment()->addGlobal('cookie_id_user', $_COOKIE['id_user']);
    $view->getEnvironment()->addGlobal('cookie_prenom_user', $_COOKIE['prenom_user']);
    $view->getEnvironment()->addGlobal('cookie_img_user', $_COOKIE['url_photo_user']);
    $view->getEnvironment()->addGlobal('now', date('d/m/Y H:i:s'));
    $domaine_url = str_replace( 'http://', 'https://', $container->request->getUri()->getBaseUrl());
    $view->getEnvironment()->addGlobal('domain_url', 'https://weasily.com');

    return $view;
};

//Facebook app config
$container['fb'] = function($container){
    return new Facebook([
        'app_id' => '348809548888116',
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
    return new StartController($container);
};
$container['GrabzitController'] = function ($container) {
    return new GrabzitController($container);
};
$container['AllResultsController'] = function ($container) {
    return new AllResultsController($container);
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
$container['CronController'] = function ($container) {
    return new CronController($container);
};
$container['LoadStatsController'] = function ($container) {
    return new LoadStatsController($container);
};
$container['CreateTestController'] = function ($container) {
    return new CreateTestController($container);
};
$container['ActionTestController'] = function ($container) {
    return new ActionTestController($container);
};
$container['AllTestsController'] = function ($container) {
    return new AllTestsController($container);
};
$container['LangController'] = function ($container) {
    return new LangController($container);
};
$container['JsonController'] = function ($container) {
    return new JsonController($container);
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
