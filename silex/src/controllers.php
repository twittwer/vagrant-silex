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


//$app->get('/static', function () use ($app) {
//    return $app['templating']->render('home.html.php');
//});

$app->get('/static/home', function () use ($app) {
    return $app['templating']->render('home.html.php');
});

$app->get('/static/music', function () use ($app) {
    return $app['templating']->render('music.html.php');
});

$app->get('/static/profile', function () use ($app) {
    return $app['templating']->render('profile.html.php');
});

$app->get('/static/settings', function () use ($app) {
    return $app['templating']->render('settings.html.php');
});