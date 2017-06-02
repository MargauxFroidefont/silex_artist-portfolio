<?php

// Middlewares
$app->before(function() use ($app)
{
    $app['twig']->addGlobal('title', 'CY. ');
});
