<?php
/** Route Controller
 *
 * @var $app
 */

use Symfony\Component\HttpFoundation\Request;

$app->get('/welcome/{name}', function ($name) use ($app) {
    return $app['templating']->render('default_hello.html.php', array('name' => $name));
});
$app->get('/welcome-twig/{name}', function ($name) use ($app) {
    return $app['twig']->render('default_hello.html.twig', array('name' => $name));
});

function login($dbConnection, $login, $logout, $username, $password)
{
    /** @var $dbConnection Doctrine\DBAL\Connection */
    session_start();
    if ($login && $username != '' && $password != '') {
        $user = $dbConnection->fetchAssoc('SELECT `id`, `username`, `firstname`, `lastname`, `email` FROM `users` WHERE `username` = "' . $username . '" AND `password` = "' . md5($password) . '"');
        if ($user != null) {
            $_SESSION['login'] = true;
            $_SESSION['userId'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
        }
    } elseif ($logout || !isset($_SESSION['login'])) {
        $_SESSION['login'] = false;
        $_SESSION['userId'] = null;
        $_SESSION['username'] = null;
        $_SESSION['email'] = null;
        $_SESSION['firstname'] = null;
        $_SESSION['lastname'] = null;
    }
}

$app->match('/static/home', function (Request $request) use ($app) {
    login($app['db'], $request->get('login', '0'), $request->get('logout', '0'), $request->get('username', ''), $request->get('password', ''));

    return $app['templating']->render('home.html.php');
});

$app->match('/static/music', function (Request $request) use ($app) {
    login($app['db'], $request->get('login', '0'), $request->get('logout', '0'), $request->get('username', ''), $request->get('password', ''));

    return $app['templating']->render('music.html.php');
});

$app->match('/static/profile/{username}', function (Request $request, $username) use ($app) {
    login($app['db'], $request->get('login', '0'), $request->get('logout', '0'), $request->get('username', ''), $request->get('password', ''));

    /** @var $dbConnection Doctrine\DBAL\Connection */
    $dbConnection = $app['db'];

    $user = $dbConnection->fetchAssoc("SELECT * FROM users WHERE username = '$username'");
    $posts = $dbConnection->fetchAll('SELECT blog_posts.id, blog_posts.title, blog_posts.text, blog_posts.created_at, users.username AS username FROM blog_posts LEFT JOIN users ON users.id = blog_posts.user_id WHERE blog_posts.user_id = ' . $user['id'] . ' ORDER BY blog_posts.created_at');
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

$app->match('/static/settings', function (Request $request) use ($app) {
    login($app['db'], $request->get('login', '0'), $request->get('logout', '0'), $request->get('username', ''), $request->get('password', ''));

    return $app['templating']->render('settings.html.php');
});

// match ($app->match) scans for get ($app->get) and post ($app->post)
$app->match('/static/blog_entry', function (Request $request) use ($app) {
    login($app['db'], $request->get('login', '0'), $request->get('logout', '0'), $request->get('username', ''), $request->get('password', ''));

    /** @var $dbConnection Doctrine\DBAL\Connection */
    $dbConnection = $app['db'];
    $error = false;
    $title = $request->get('title', '');
    $userId = $request->get('userId', '');
    $text = $request->get('text', '');

    if ($request->isMethod('POST') && $request->get('send', '0')) {
        if ($title != '' && $userId != '' && $text != '') {
            $text = nl2br($text);
            $dbConnection->insert(
                'blog_posts',
                array(
                    'title' => $title,
                    'text' => $text,
                    'user_id' => $userId)
            );
            return $app['templating']->render('response_panel.html.php',
                array(
                    'title' => 'Blog',
                    'responseTitle' => 'Post Saved',
                    'responseContent' => 'Your inputs were proceed successfully!<!--<br/><br/>Title:<br/>' . $title . '<br/>Content:<br/>' . $text . '-->',
                    'responseType' => 'success',
                    'returnLink' => './blog_entry'
                ));
        } else {
            $error = true;
        }
    }
    $posts = $dbConnection->fetchAll('SELECT blog_posts.id, blog_posts.title, blog_posts.text, blog_posts.created_at, users.username AS username FROM blog_posts LEFT JOIN users ON users.id = blog_posts.user_id ORDER BY blog_posts.created_at');
    return $app['templating']->render(
        'blog_form.html.php',
        array(
            'edit' => false,
            'error' => $error,
            'title' => $title,
            'text' => $text,
            'posts' => $posts
        )
    );
});

$app->match('/static/blog_post/{id}/{title}', function (Request $request, $id) use ($app) {
    login($app['db'], $request->get('login', '0'), $request->get('logout', '0'), $request->get('username', ''), $request->get('password', ''));

    /** @var $dbConnection Doctrine\DBAL\Connection */
    $dbConnection = $app['db'];

    $post = $dbConnection->fetchAssoc("SELECT blog_posts.id, blog_posts.title, blog_posts.text, blog_posts.created_at, users.username AS username FROM blog_posts LEFT JOIN users ON users.id = blog_posts.user_id WHERE blog_posts.id = $id");
    return $app['templating']->render(
        'blog_post.html.php',
        array(
            'id' => $post['id'],
            'title' => $post['title'],
            'username' => $post['username'],
            'text' => $post['text'],
            'date' => $post['created_at']
        )
    );
});

$app->match('/static/blog_edit/{id}', function (Request $request, $id) use ($app) {
    login($app['db'], $request->get('login', '0'), $request->get('logout', '0'), $request->get('username', ''), $request->get('password', ''));

    /** @var $dbConnection Doctrine\DBAL\Connection */
    $dbConnection = $app['db'];
    $error = false;

    if ($request->isMethod('POST') && $request->get('send', '0')) {
        $title = $request->get('title', '');
        $text = $request->get('text', '');
        $username = '';
        if ($title != '' && $text != '') {
            $text = nl2br($text);
            $dbConnection->update('blog_posts',
                array(
                    'title' => $title,
                    'text' => $text
                ),
                array(
                    'id' => $id
                )
            );
            return $app['templating']->render('response_panel.html.php',
                array(
                    'title' => 'Blog',
                    'responseTitle' => 'Changes Saved',
                    'responseContent' => 'Your changes were processed successfully!<!--<br/><br/>Title:<br/>' . $title . '<br/>Content:<br/>' . $text . '-->',
                    'responseType' => 'success',
                    'returnLink' => './blog_post/' . $id . '/' . urlencode($title)
                ));
        } else {
            $error = true;
        }
    } else {
        $post = $dbConnection->fetchAssoc("SELECT blog_posts.id, blog_posts.title, blog_posts.text, blog_posts.created_at, users.username AS username FROM blog_posts LEFT JOIN users ON users.id = blog_posts.user_id WHERE blog_posts.id = $id");
        $title = $post['title'];
        $text = str_replace('<br />', '', $post['text']);
        $username = $post['username'];
    }
    return $app['templating']->render(
        'blog_form.html.php',
        array(
            'edit' => true,
            'error' => $error,
            'id' => $id,
            'title' => $title,
            'username' => $username,
            'text' => $text
        )
    );
});