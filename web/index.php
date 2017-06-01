<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Length;


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

// Create `home` route
$app
    ->get('/', function() use ($app)
    {
      return $app['twig']->render('pages/home.twig');
    })
    ->bind('home');

// Create `newsletter` route

$app
    ->match('/newsletter', function(Request $request) use ($app)
    {
      $data = array();

      $formBuilder = $app['form.factory']->createBuilder();

      $formBuilder->setMethod('post');
      $formBuilder->setAction($app['url_generator']->generate('newsletter'));

      $formBuilder
        ->add('firstname', TextType::class, [
          'label' => 'Prénom',
          'trim' => true,
          'required' => true,
          'constraints' => [
            new Length([
              'max' => 50,
              'min'=> 1,
              'minMessage' => 'Veuillez renseigner votre prénom',
              'maxMessage' => 'Votre prénom est trop long.'
            ])
          ]
        ])
        ->add('email', EmailType::class, [
          'label' => 'Email',
          'trim' => true,
          'required' => true
        ])
        ->add('submit', SubmitType::class, [
          'label' => 'S\'abonner',
        ]);

      $form = $formBuilder->getForm();

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $formData = $form->getData();
        $message = new \Swift_Message();
        $message->setSubject('Inscription à la newsletter réussie !');
        $message->setFrom(array('margaux.froidefont@gmail.com'));
        $message->setTo(array($formData['email']));
        $message->setBody($app['twig']->render('pages/mail-template.twig', [
          'nom' => $formData['firstname']
        ]));

        $app['mailer']->send($message);

        return $app->redirect($app['url_generator']->generate('home'));
      }

      $data['newsletter_form'] = $form->createView();

      return $app['twig']->render('pages/newsletter.twig', $data);
    })
    ->bind('newsletter');

// Create `graphism/all` route
$app
    ->get('/{category}', function($category) use ($app)
    {
      $data = array();

      $artworksModel = new \Site\Models\Cy($app['db']);
      $data['artworks'] = $artworksModel->getGoodCategory($category);

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->assert('category', 'graphisme|serigraphie|crayon|series')
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
    ->assert('category', 'graphisme|serigraphie|crayon|series')
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
    ->assert('category', 'graphisme|serigraphie|crayon|series')
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
    ->assert('category', 'graphisme|serigraphie|crayon|series')
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
    ->assert('category', 'graphisme|serigraphie|crayon|series')
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
    ->assert('category', 'graphisme|serigraphie|crayon|series')
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
    ->assert('category', 'graphisme|serigraphie|crayon|series')
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
    ->assert('category', 'graphisme|serigraphie|crayon|series')
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
    ->assert('category', 'graphisme|serigraphie|crayon|series')
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
    ->assert('category', 'graphisme|serigraphie|crayon|series')
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
    ->assert('category', 'graphisme|serigraphie|crayon|series')
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
    ->assert('category', 'graphisme|serigraphie|crayon|series')
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
    ->assert('category', 'graphisme|serigraphie|crayon|series')
    ->bind('series/hogwart');

// Error handler
$app
    ->error(function (\Exception $e, Request $request, $code) use ($app)
    {

      if ($app['debug']) {
        return;
      }

      $data = array();
      $data['title'] = 'Error';
      $data['code'] = $code;

      return $app['twig']->render('pages/error.twig', $data);
    });


// Run Silex
$app->run();
