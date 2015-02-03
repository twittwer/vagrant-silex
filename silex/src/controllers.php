<?php
use Symfony\Component\HttpFoundation\Request;

$app->get('/welcome/{name}', function ($name) use ($app) {
    return $app['templating']->render(
        'default_hello.html.php',
        array('name' => $name)
    );
});

$app->get('/welcome-twig/{name}', function ($name) use ($app) {
    return $app['twig']->render(
        'default_hello.html.twig',
        array('name' => $name)
    );
});

$app->get('/static', function () use ($app) {
    return $app['templating']->render(
        'home.html.php'
    );
});