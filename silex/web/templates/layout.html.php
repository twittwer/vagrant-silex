<?php
/** Main Layout Template
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 */

$slots = $view['slots'];
$title = $slots->get('title');

$navigation = array();
$navigation[] = array('title' => 'Home', 'icon' => 'home', 'link' => '/static/home');
$navigation[] = array('title' => 'Music', 'icon' => 'music', 'link' => '/static/music');
$navigation[] = array('title' => 'Profile', 'icon' => 'user', 'link' => '/static/profile/twittwer');
$navigation[] = array('title' => 'Settings', 'icon' => 'cog', 'link' => '/static/settings');
$navigation[] = array('title' => 'Blog', 'icon' => 'book', 'link' => '/static/blog_entry');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Webengine | <?= $title ?></title>
    <link rel="stylesheet" href="/vendor/css/main.css">
    <!-- Bootstrap - Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">
    <!-- Bootstrap - Optional theme -->
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap-theme.min.css">
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
<nav class="navbar navbar-inverse">
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
            <a class="navbar-brand" href="./home">Webengine</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php foreach ($navigation as $page) { ?>
                    <li <?= ($page['title'] == $title ? 'class="active"' : '') ?>>
                        <a href="<?= $page['link'] ?>">
                            <span class="glyphicon glyphicon-<?= $page['icon'] ?>"
                                  aria-hidden="true"></span>&nbsp;<?= $page['title'] ?>
                            <?= ($page['title'] == $title ? '<span class="sr-only">(current)</span>' : '') ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#myModal">
                        Sign in
                    </button>
                </li>
                <!--<p class="navbar-text navbar-right">Signed in as <a href="/static/profile/" class="navbar-link">Mark Otto</a></p>-->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<div class="container">
    <?php $slots->output('_content') ?>
</div>

<!-- Sign In Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form class="form-signin">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Please sign in</h4>
                </div>
                <div class="modal-body">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username"
                           required autofocus>
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                           required>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="signin" class="btn btn-lg btn-primary btn-block">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>