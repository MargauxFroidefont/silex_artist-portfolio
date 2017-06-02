<?php

// Require dependendies
$loader = require_once __DIR__.'/../vendor/autoload.php';
$loader->addPsr4('Site\\', __DIR__.'/../src/');

// Config
$config = array();

switch($_SERVER['HTTP_HOST'])
{

    case 'localhost:8888':
        $config['debug']   = false;
        $config['db_host'] = 'localhost';
        $config['db_name'] = 'h2_silex_cy';
        $config['db_user'] = 'root';
        $config['db_pass'] = 'root';
        break;
    case 'preprod.monsite.com':
        $config['debug']   = true;
        $config['db_host'] = '';
        $config['db_name'] = '';
        $config['db_user'] = '';
        $config['db_pass'] = '';
        break;
    case 'monsite.com':
        $config['debug']   = false;
        $config['db_host'] = '';
        $config['db_name'] = '';
        $config['db_user'] = '';
        $config['db_pass'] = '';
        break;
}

// Init Silex
$app = new Silex\Application();
$app['config'] = $config;
$app['debug']  = $app['config']['debug'];

// Services
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array (
        'driver'    => 'pdo_mysql',
        'host'      => $app['config']['db_host'],
        'dbname'    => $app['config']['db_name'],
        'user'      => $app['config']['db_user'],
        'password'  => $app['config']['db_pass'],
        'charset'   => 'utf8'
    ),
));

$app['db']->setFetchMode(PDO::FETCH_OBJ);
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\SwiftmailerServiceProvider(), array(
    'swiftmailer.options' => array(
        'host'       => 'smtp.gmail.com',
        'port'       => 465,
        'username'   => 'smtp.hetic.p2020@gmail.com',
        'password'   => 'heticp2020smtp',
        'encryption' => 'ssl',
        'auth_mode'  => 'login'
    )
));

// Routes 
require_once('../src/Middlewares/middlewares.php');

require_once('../src/Routes/routes.php');

require_once('../src/Error/error.php');

// Run Silex
$app->run();
