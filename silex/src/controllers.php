<?php
/** Route Controller
 *
 * @var $app
 */

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

// match ($app->match) scans for get ($app->get) and post ($app->post)
$app->match('/static/guestbook', function (Request $request) use ($app) {
    $error = false;
    $title = $request->get('title', '');
    $email = $request->get('email', '');
    $text = $request->get('text', '');

    /** @var $dbConnection Doctrine\DBAL\Connection */
    $dbConnection = $app['db'];
    if ($request->isMethod('POST')) {
        if ($title != '' && $email != '' && $text != '') {
            $dbConnection->insert(
                'blog_post',
                array(
                    'title' => $title,
                    'text' => $text,
                    'created_at' => date('Y-m-d'))
            );
            return $app['templating']->render('response_panel.html.php',
                array(
                    'title' => 'Guestbook',
                    'responseTitle' => 'Saved',
                    'responseContent' => 'Your inputs were processed successfully!<br/><br/>' . $title . ' (' . $email . ')<br/>' . $text,
                    'responseType' => 'success'
                ));
        } else {
            $error = true;
        }
    }
    return $app['templating']->render(
        'guestbook.html.php',
        array(
            'error' => $error,
            'title' => $title,
            'email' => $email,
            'text' => $text
        )
    );
});