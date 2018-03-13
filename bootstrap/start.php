<?php


use App\Controllers\HomeController;
use Illuminate\Database\Capsule\Manager;
use Slim\App;


define('RDS_HOSTNAME', $_SERVER['RDS_HOSTNAME']);
define('RDS_USERNAME', $_SERVER['RDS_USERNAME']);
define('RDS_PASSWORD', $_SERVER['RDS_PASSWORD']);
define('RDS_DB_NAME', $_SERVER['RDS_DB_NAME']);
$app = new App([
    'settings' => [
        'displayErrorDetails'   =>  true,
        'db'        =>  [
            'driver'    =>  'mysql',
            'host'      =>  'RDS_HOSTNAME',
            'database'  =>  'RDS_PASSWORD',
            'username'  =>  'RDS_USERNAME',
            'password'  =>  'RDS_PASSWORD',
            'charset'   =>  'utf8mb4',
            'collation' =>  'utf8mb4_unicode_ci',
            'prefix'    =>  '',
        ]
    ],
]);

$container = $app->getContainer();

$capsule = new Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] =  function ($container) use ($capsule) {
    return $capsule;
};

$container['view'] = function ($container){
    $view = new \Slim\Views\Twig(__DIR__ . '/../ressources/views', [
        'cache' => false,
    ]);

    return $view;
};

$container['HomeController'] = function ($container) {
    return new HomeController($container);
};
require __DIR__ . '/../app/routes.php';