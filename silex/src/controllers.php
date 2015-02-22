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

$app->get('/static/home', function () use ($app) {
    return $app['templating']->render('home.html.php');
});

$app->get('/static/music', function () use ($app) {
    return $app['templating']->render('music.html.php');
});

$app->get('/static/profile/{username}', function ($username) use ($app) {
    $dbConnection = $app['db'];
    $user = $dbConnection->fetchAssoc("SELECT * FROM users WHERE username = '$username'");
    $posts = $dbConnection->fetchAll('SELECT blog_posts.id, blog_posts.title, blog_posts.text, blog_posts.email, blog_posts.created_at, users.username AS user FROM blog_posts LEFT JOIN users ON users.id = blog_posts.user_id WHERE blog_posts.user_id = ' . $user['id'] . ' ORDER BY blog_posts.created_at');
    return $app['templating']->render(
        'profile.html.php',
        array(
            'userId' => $user['id'],
            'username' => $user['username'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'email' => $user['email'],
            'registrationDate' => $user['registered_at'],
            'posts' => $posts
        )
    );
});

$app->get('/static/settings', function () use ($app) {
    return $app['templating']->render('settings.html.php');
});

// match ($app->match) scans for get ($app->get) and post ($app->post)
$app->match('/static/blog_entry', function (Request $request) use ($app) {
    $error = false;
    $title = $request->get('title', '');
    $email = $request->get('email', '');
    $text = $request->get('text', '');

    /** @var $dbConnection Doctrine\DBAL\Connection */
    $dbConnection = $app['db'];

    if ($request->isMethod('POST')) {
        if ($title != '' && $email != '' && $text != '') {
            $text = nl2br($text);
            $dbConnection->insert(
                'blog_posts',
                array(
                    'title' => $title,
                    'text' => $text,
                    'email' => $email)
            );
            return $app['templating']->render('response_panel.html.php',
                array(
                    'title' => 'Blog',
                    'responseTitle' => 'Post Saved',
                    'responseContent' => 'Your inputs were processed successfully!<br/><br/>Title:<br/>' . $title . ' (' . $email . ')<br/>Content:<br/>' . $text,
                    'responseType' => 'success',
                    'returnLink' => './blog_entry'
                ));
        } else {
            $error = true;
        }
    }
    $posts = $dbConnection->fetchAll('SELECT blog_posts.id, blog_posts.title, blog_posts.text, blog_posts.email, blog_posts.created_at, users.username AS user FROM blog_posts LEFT JOIN users ON users.id = blog_posts.user_id ORDER BY blog_posts.created_at');
    return $app['templating']->render(
        'blog_entry.html.php',
        array(
            'edit' => false,
            'error' => $error,
            'title' => $title,
            'email' => $email,
            'text' => $text,
            'posts' => $posts
        )
    );
});

$app->get('/static/blog_post/{id}/{title}', function ($id) use ($app) {
    /** @var $dbConnection Doctrine\DBAL\Connection */
    $dbConnection = $app['db'];
    $post = $dbConnection->fetchAssoc("SELECT blog_posts.id, blog_posts.title, blog_posts.text, blog_posts.email, blog_posts.created_at, users.username AS user FROM blog_posts LEFT JOIN users ON users.id = blog_posts.user_id WHERE blog_posts.id = $id");
    return $app['templating']->render(
        'blog_post.html.php',
        array(
            'id' => $post['id'],
            'title' => $post['title'],
            'user' => $post['user'],
            'email' => $post['email'],
            'text' => $post['text'],
            'date' => $post['created_at']
        )
    );
});

$app->match('/static/blog_edit/{id}', function (Request $request, $id) use ($app) {
    $error = false;

    /** @var $dbConnection Doctrine\DBAL\Connection */
    $dbConnection = $app['db'];

    if ($request->isMethod('POST')) {
        $title = $request->get('title', '');
        $email = $request->get('email', '');
        $text = $request->get('text', '');
        $user = '';
        if ($title != '' && $email != '' && $text != '') {
            $text = nl2br($text);
            $dbConnection->update('blog_posts',
                array(
                    'title' => $title,
                    'text' => $text,
                    'email' => $email
                ),
                array(
                    'id' => $id
                )
            );
            return $app['templating']->render('response_panel.html.php',
                array(
                    'title' => 'Blog',
                    'responseTitle' => 'Changes Saved',
                    'responseContent' => 'Your changes were processed successfully!<br/><br/>Title:<br/>' . $title . ' (' . $email . ')<br/>Content:<br/>' . $text,
                    'responseType' => 'success',
                    'returnLink' => './blog_post/' . $id . '/' . urlencode($title)
                ));
        } else {
            $error = true;
        }
    } else {
        $post = $dbConnection->fetchAssoc("SELECT blog_posts.id, blog_posts.title, blog_posts.text, blog_posts.email, blog_posts.created_at, users.username AS user FROM blog_posts LEFT JOIN users ON users.id = blog_posts.user_id WHERE blog_posts.id = $id");
        $title = $post['title'];
        $email = $post['email'];
        $text = str_replace('<br />', '', $post['text']);
        $user = $post['user'];
    }
    return $app['templating']->render(
        'blog_entry.html.php',
        array(
            'edit' => true,
            'error' => $error,
            'id' => $id,
            'title' => $title,
            'user' => $user,
            'email' => $email,
            'text' => $text
        )
    );
});