<?php
/** Main Layout Template
 *
 * Defines the main layout structure around the content of all other templates.
 *
 * User: Tobias Wittwer
 *
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 */

$slots = $view['slots'];
$title = $slots->get('title');

$navigation = array();
$navigation[] = array('title' => 'Home', 'icon' => 'home', 'link' => '/static/home', 'public' => true);
$navigation[] = array('title' => 'Music', 'icon' => 'music', 'link' => '/static/music', 'public' => true);
$navigation[] = array('title' => 'Blog', 'icon' => 'book', 'link' => '/static/blog', 'public' => true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TheBlog | <?= $title ?></title>
    <meta charset="utf-8"/>
    <!-- Bootstrap - Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">
    <!-- Bootstrap - Optional theme -->
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap-theme.min.css">
    <!-- Personal CSS -->
    <link rel="stylesheet" href="/vendor/css/main.css">
    <!-- JQuery -->
    <script src="/vendor/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap - JavaScript -->
    <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">-->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">-->
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>-->
    <base href="http://localhost:8001/static/">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./home">TheBlog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-- Navigation { -->
            <ul class="nav navbar-nav">
                <?php
                foreach ($navigation as $page) {
                    if ($page['public'] || $_SESSION['login']) {
                        ?>
                        <li <?= ($page['title'] == $title ? 'class="active"' : '') ?>>
                            <a href="<?= $page['link'] ?>">
                            <span class="glyphicon glyphicon-<?= $page['icon'] ?>"
                                  aria-hidden="true"></span>&nbsp;<?= $page['title'] ?>
                                <?= ($page['title'] == $title ? '<span class="sr-only">(current)</span>' : '') ?>
                            </a>
                        </li>
                    <?php
                    }
                }
                ?>
            </ul>
            <!-- } Navigation -->
            <form method="post" action="/static/search" class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" name="searchkey" class="form-control" placeholder="Search">
                </div>
                <!--                <button type="submit" name="search" class="btn btn-default">Search</button>-->
            </form>
            <!-- Login { -->
            <ul class="nav navbar-nav navbar-right">
                <?php if ($_SESSION['login']) { ?>
                    <li>
                        <p class="navbar-text"><span class="visible-xs-inline">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="hidden-sm">Signed&nbsp;in&nbsp;as&nbsp;</span>
                            <a href="/static/profile/<?= $_SESSION['username'] ?>" class="navbar-link link-undecorated">
                                <?= $_SESSION['firstname'] != '' ? $_SESSION['firstname'] . '&nbsp;' . $_SESSION['lastname'] : $_SESSION['username'] ?>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            </a>
                        </p>
                    </li>
                    <li>
                        <form method="post" class="navbar-form navbar-left logout">
                            <button type="submit" name="logout" value="1" class="btn btn-link link-undecorated"><span
                                    class="visible-xs-inline">&nbsp;&nbsp;&nbsp;&nbsp;Logout&nbsp;</span><span
                                    class="glyphicon glyphicon-log-out" aria-hidden="true"></span></button>
                        </form>
                    </li>
                <?php } else { ?>
                    <li>
                        <button type="button" class="btn btn-link login navbar-btn" data-toggle="modal"
                                data-target="#signInModal"><span class="visible-sm-inline visible-xs-inline">&nbsp;&nbsp;&nbsp;&nbsp;</span>Sign&nbsp;in&nbsp;<span
                                class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
                        </button>
                    </li>
                <?php } ?>
            </ul>
            <!-- } Login -->
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<div class="container">
    <?php $slots->output('_content') ?>
</div>
<footer>
    &#169;&nbsp;Tobias&nbsp;Wittwer&nbsp;2015<?= (date('Y') != '2015') ? '&nbsp;-&nbsp;' . date('Y') : '' ?>
</footer>

<!-- Sign In Modal -->
<div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="signInModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method="post" class="form-signin">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="signInModalLabel">Please sign in</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username" class="sr-only">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username"
                               required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                               required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="login" value="1" class="btn btn-lg btn-primary btn-block">Sign in
                    </button>
                    <a class="btn btn-default btn-block" href="/static/registration">Sign up</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>