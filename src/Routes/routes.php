<?php

// Components
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;

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

      // Create newsletter form
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

      // Send newsletter email
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
      $data['title'] = "CY - " . $category;

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
      $data['title'] = "CY - " . $category;

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
      $data['title'] = "CY - " . $category;

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
      $data['title'] = "CY - " . $category;

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
      $data['title'] = "CY - " . $category;

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
      $data['title'] = "CY - " . $category;

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
      $data['title'] = "CY - " . $category;

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
      $data['title'] = "CY - " . $category;

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
      $data['title'] = "CY - " . $category;

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
      $data['title'] = "CY - " . $category;

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
      $data['title'] = "CY - " . $category;

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
      $data['title'] = "CY - " . $category;
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
      $data['title'] = "CY - " . $category;

      return $app['twig']->render('pages/category.twig', $data);
    })
    ->assert('category', 'graphisme|serigraphie|crayon|series')
    ->bind('series/hogwart');

// Create `artwork` route
$app
    ->get('/{artwork}', function($artwork) use ($app)
    {
      $data = array();

      $artworkModel = new \Site\Models\Cy($app['db']);
      $data['artwork'] = $artworkModel->getGoodArtwork($artwork);
      if(!$data['artwork']) {
          $app->abort(404);
      }
      $data['title'] = "CY - " . $data['artwork']->name;

      return $app['twig']->render('pages/artwork.twig', $data);
    })
    ->bind('artwork');
