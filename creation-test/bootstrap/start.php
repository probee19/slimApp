<?php

use App\Controllers\ConnectController;
use App\Controllers\GrabzitController;
use App\Controllers\HomeController;
use App\Controllers\ShareController;
use App\Controllers\TestController;
use App\Controllers\StartController;
use App\Controllers\AllResultsController;
use App\Controllers\AllCitationsController;
use App\Controllers\ClickController;
use App\Controllers\CronController;
use App\Controllers\LoadStatsController;
use App\Controllers\CreateTestController;
use App\Controllers\CreateCitationController;
use App\Controllers\ActionTestController;
use App\Controllers\AllTestsController;
use App\Controllers\LangController;
use App\Controllers\NotificationPushController;
use App\Controllers\JsonController;

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

require __DIR__ . '/../vendor/autoload.php';

$config = [
    'displayErrorDetails'   =>  true,
    'db'        =>  [
        'driver'    =>  'mysql',
        'host'      =>  'localhost',
        'database'  =>  'funizi_store',
        'username'  =>  'funizi_user',
        'password'  =>  'R$46Wm1tM0-)',
        'charset'   =>  'utf8',
        'collation' =>  'utf8_unicode_ci',
        'prefix'    =>  '',
    ],
    'grabzit_key'       => "MDliYmY0OTM1OTI3NDk5OTkwOWYyZjY5MDZlZTJkZTU=",
    'grabzit_secret'    => "H2s/Dj8/Pzk/P1ZmbDk/bT8/Sz8/Pz9BPz8/Pz8/Pz8=",
    'test_per_page'     =>  15,
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
    $view->getEnvironment()->addGlobal('now', date());
    $view->getEnvironment()->addGlobal('domain_url', $container->request->getUri()->getBaseUrl());

    return $view;
};

//Facebook app config
$container['fb'] = function($container){
    return new Facebook([
        'app_id' => '348809548888116',
        'app_secret' => '2d51d516fa50ce2382b2e8214db499c3',
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
$container['AllCitationsController'] = function ($container) {
    return new AllCitationsController($container);
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
$container['CreateCitationController'] = function ($container) {
    return new CreateCitationController($container);
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
$container['NotificationPushController'] = function ($container) {
    return new NotificationPushController($container);
};
$container['JsonController'] = function ($container) {
    return new JsonController($container);
};
$container['grabzit'] = function ($container) {
    return new GrabzItClient("N2U3YTNkZGYxNGUzNDA0OWFjODRmYzYzZjk0ZDAxZmU=", "CD8/PzIJP2shZz8/Pz8rBj8LET8/P0M/aBcsc1gQGT8=");
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
