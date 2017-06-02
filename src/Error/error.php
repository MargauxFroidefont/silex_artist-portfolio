<?php

// Components
use Symfony\Component\HttpFoundation\Request;

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
