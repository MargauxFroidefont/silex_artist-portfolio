<?php

// Require dependendies
$loader = require_once __DIR__.'/../vendor/autoload.php';
$loader->addPsr4('Site\\', __DIR__.'/../src/');

// Init Silex
$app = new Silex\Application();

// Services
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array (
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
        'dbname'    => 'h2_silex_cy',
        'user'      => 'root',
        'password'  => 'root',
        'charset'   => 'utf8'
    ),
));

$app['db']->setFetchMode(PDO::FETCH_OBJ);

// Create `home` route
$app
    ->get('/', function() use ($app)
    {
      return $app['twig']->render('pages/home.twig');
    })
    ->bind('home');

// Create `graphism/all` route
$app
    ->get('/{category}', function($category) use ($app)
    {
      $data = array();

      $artworksModel = new \Site\Models\Cy($app['db']);
      $data['artworks'] = $artworksModel->getGoodCategory($category);

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->bind('graphisme');

// Create `graphism/mermaids` route
$app
    ->get('/{category}/{serie}', function($category, $serie) use ($app)
    {
      $data = array();

      $artworksModel = new \Site\Models\Cy($app['db']);
      $data['artworks'] = $artworksModel->getGoodSerie($category, $serie);

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->bind('graphisme/mermaids');

// Create `graphism/hogwards` route
$app
    ->get('/{category}/{serie}', function($category, $serie) use ($app)
    {
      $data = array();

      $artworksModel = new \Site\Models\Cy($app['db']);
      $data['artworks'] = $artworksModel->getGoodSerie($category, $serie);

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->bind('graphisme/hogwart');


// Create `serigraphy/all` route
$app
    ->get('/{category}', function($category) use ($app)
    {
      $data = array();

      $artworksModel = new \Site\Models\Cy($app['db']);
      $data['artworks'] = $artworksModel->getGoodCategory($category);

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->bind('serigraphie');

// Create `serigraphy/sleepers` route
$app
    ->get('/{category}/{serie}', function($category, $serie) use ($app)
    {
      $data = array();

      $artworksModel = new \Site\Models\Cy($app['db']);
      $data['artworks'] = $artworksModel->getGoodSerie($category, $serie);

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->bind('serigraphie/endormies');

// Create `pencil/all` route
$app
    ->get('/{category}', function($category) use ($app)
    {
      $data = array();

      $artworksModel = new \Site\Models\Cy($app['db']);
      $data['artworks'] = $artworksModel->getGoodCategory($category);

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->bind('crayon');

// Create `pencil/birds` route
$app
    ->get('/{category}/{serie}', function($category, $serie) use ($app)
    {
      $data = array();

      $artworksModel = new \Site\Models\Cy($app['db']);
      $data['artworks'] = $artworksModel->getGoodSerie($category, $serie);

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->bind('crayon/oiseaux');

// Create `pencil/flowers` route
$app
    ->get('/{category}/{serie}', function($category, $serie) use ($app)
    {
      $data = array();

      $artworksModel = new \Site\Models\Cy($app['db']);
      $data['artworks'] = $artworksModel->getGoodSerie($category, $serie);

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->bind('crayon/fleuries');

// Create `pencil/hogwards` route
$app
    ->get('/{category}/{serie}', function($category, $serie) use ($app)
    {
      $data = array();

      $artworksModel = new \Site\Models\Cy($app['db']);
      $data['artworks'] = $artworksModel->getGoodSerie($category, $serie);

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->bind('crayon/hogwart');

// Create `pencil/sleepers` route
$app
    ->get('/{category}/{serie}', function($category, $serie) use ($app)
    {
      $data = array();

      $artworksModel = new \Site\Models\Cy($app['db']);
      $data['artworks'] = $artworksModel->getGoodSerie($category, $serie);

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->bind('crayon/endormies');

// Create `series/all` route
$app
    ->get('/{category}', function($category) use ($app)
    {
      $data = array();

      $artworksModel = new \Site\Models\Cy($app['db']);
      $data['artworks'] = $artworksModel->getGoodCategory($category);

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->bind('series');

// Create `series/sleepers` route
$app
    ->get('/{category}/{serie}', function($category, $serie) use ($app)
    {
      $data = array();

      $artworksModel = new \Site\Models\Cy($app['db']);
      $data['artworks'] = $artworksModel->getGoodSerie($category, $serie);

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->bind('series/endormies');

// Create `series/hogwards` route
$app
    ->get('/{category}/{serie}', function($category, $serie) use ($app)
    {
      $data = array();

      $artworksModel = new \Site\Models\Cy($app['db']);
      $data['artworks'] = $artworksModel->getGoodSerie($category, $serie);

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->bind('series/hogwart');


// Run Silex
$app->run();
