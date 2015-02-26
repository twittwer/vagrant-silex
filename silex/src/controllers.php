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

$app->before(function (Request $request, \Silex\Application $app) {
    session_start();
    /** @var $dbConnection Doctrine\DBAL\Connection */
    $dbConnection = $app['db'];
    $login = $request->get('login', false);
    $username = $request->get('username', '');
    $password = $request->get('password', '');
    $logout = $request->get('logout', false);

    if ($login && $username != '' && $password != '') {
        $user = $dbConnection->fetchAssoc("SELECT `id`, `username`, `firstname`, `lastname`, `email` FROM `users` WHERE `username` = '$username' AND `password` = '" . md5($password) . "'");
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
});

$app->match('/static/home', function () use ($app) {
    return $app['templating']->render('home.html.php');
});

$app->match('/static/music', function () use ($app) {
    return $app['templating']->render('music.html.php');
});

$app->match('/static/profile/{username}', function ($username) use ($app) {
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
    /** @var $dbConnection Doctrine\DBAL\Connection */
    $dbConnection = $app['db'];
    $errorPasswd = false;
    $password = $request->get('password', '');
    $passwd = $request->get('passwd', '');

    if ($request->isMethod('POST') && $request->get('changePasswd', false)) {
        if ($password != '' && ($password == $passwd)) {
            $dbConnection->update('users',
                array(
                    'password' => md5($password)
                ),
                array(
                    'id' => $_SESSION['userId']
                )
            );
            return $app['templating']->render('response_panel.html.php',
                array(
                    'title' => 'Password Change',
                    'responseTitle' => 'Password Changed',
                    'responseContent' => 'Your password is changed.',
                    'responseType' => 'success',
                    'returnLink' => './settings'
                ));
        } else {
            $errorPasswd = true;
        }
    }
    return $app['templating']->render(
        'user_settings.html.php',
        array(
            'errorPasswd' => $errorPasswd
        )
    );
});

// match ($app->match) scans for get ($app->get) and post ($app->post)
$app->match('/static/blog', function (Request $request) use ($app) {
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
                    'returnLink' => './blog'
                ));
        } else {
            $error = true;
        }
    }
    $posts = $dbConnection->fetchAll('SELECT blog_posts.id, blog_posts.title, blog_posts.text, blog_posts.created_at, users.username AS username FROM blog_posts LEFT JOIN users ON users.id = blog_posts.user_id ORDER BY blog_posts.created_at DESC');
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

$app->match('/static/blog_post/{id}/{title}', function ($id) use ($app) {
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

$app->match('/static/registration', function (Request $request) use ($app) {
    /** @var $dbConnection Doctrine\DBAL\Connection */
    $dbConnection = $app['db'];
    $error = false;
    $existingUser = false;
    $username = $request->get('username', '');
    $email = $request->get('email', '');
    $firstname = $request->get('firstname', '');
    $lastname = $request->get('lastname', '');
    $password = $request->get('password', '');
    $passwd = $request->get('passwd', '');

    if ($request->isMethod('POST') && $request->get('register', '0')) {
        $user = $dbConnection->fetchAssoc("SELECT * FROM users WHERE username = '$username'");
        if ($user != null) {
            $existingUser = true;
        }
        if (!$existingUser && $username != '' && $email != '' && $password != '' && ($password == $passwd)) {
            $dbConnection->insert(
                'users',
                array(
                    'username' => $username,
                    'email' => $email,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'password' => md5($password))
            );
            return $app['templating']->render('response_panel.html.php',
                array(
                    'title' => 'Registered',
                    'responseTitle' => 'Account Created',
                    'responseContent' => "You are signed up successfully as $username!",
                    'responseType' => 'success',
                    'returnLink' => "./profile/$username"
                ));
        } else {
            $error = true;
        }
    }
    return $app['templating']->render(
        'user_registration.html.php',
        array(
            'error' => $error,
            'existingUser' => $existingUser,
            'username' => $username,
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname
        )
    );
});

$app->match('/static/search', function (Request $request) use ($app) {
    /** @var $dbConnection Doctrine\DBAL\Connection */
    $dbConnection = $app['db'];
    $searchkey = $request->get('searchkey', '');
    $postsTitle = null;
    $postsText = null;
    $users = null;

    if ($searchkey != '') {
        $postsTitle = $dbConnection->fetchAll("SELECT blog_posts.id, blog_posts.title, blog_posts.text, blog_posts.created_at, users.username AS username FROM blog_posts LEFT JOIN users ON users.id = blog_posts.user_id WHERE title LIKE '%$searchkey%' ORDER BY blog_posts.created_at DESC");
        $postsText = $dbConnection->fetchAll("SELECT blog_posts.id, blog_posts.title, blog_posts.text, blog_posts.created_at, users.username AS username FROM blog_posts LEFT JOIN users ON users.id = blog_posts.user_id WHERE text LIKE '%$searchkey%' AND title NOT LIKE '%$searchkey%' ORDER BY blog_posts.created_at DESC");
        $users = $dbConnection->fetchAll("SELECT * FROM users WHERE username LIKE '%$searchkey%'");
    }
    return $app['templating']->render(
        'search.html.php',
        array(
            'searchkey' => $searchkey,
            'postsTitle' => $postsTitle,
            'postsText' => $postsText,
            'users' => $users
        )
    );
});