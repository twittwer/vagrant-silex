<?php
/** Main Layout Template */
$title = $view['slots']->get('title');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Webengine | <?= $title ?></title>
    <!--<title>Webengine | <?php //$view['slots']->output('title') ?></title>-->
    <!-- Bootstrap - Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">-->
    <!-- Bootstrap - Optional theme -->
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap-theme.min.css">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">-->
    <!-- JQuery -->
    <script src="/vendor/jquery/dist/jquery.min.js"></script>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
    <!-- Bootstrap - JavaScript -->
    <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>-->
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
                <li <?php echo($title == 'Home' ? 'class="active"' : '') ?>>
                    <a href="./home">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home
                        <?php echo($title == 'Home' ? '<span class="sr-only">(current)</span>' : '') ?>
                    </a>
                </li>
                <li <?php echo($title == 'Music' ? 'class="active"' : '') ?>>
                    <a href="./music">
                        <span class="glyphicon glyphicon-music" aria-hidden="true"></span>&nbsp;Music
                        <?php echo($title == 'Music' ? '<span class="sr-only">(current)</span>' : '') ?>
                    </a>
                </li>
                <li <?php echo($title == 'Profile' ? 'class="active"' : '') ?>>
                    <a href="./profile">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Profile
                        <?php echo($title == 'Profile' ? '<span class="sr-only">(current)</span>' : '') ?>
                    </a>
                </li>
                <li <?php echo($title == 'Settings' ? 'class="active"' : '') ?>>
                    <a href="./settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;Settings
                        <?php echo($title == 'Settings' ? '<span class="sr-only">(current)</span>' : '') ?>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<div class="container">
    <?php $view['slots']->output('_content') ?>
</div>
</body>
</html>