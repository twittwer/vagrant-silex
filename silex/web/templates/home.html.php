<?php
/**
 * Created by PhpStorm.
 * User: Tobias Wittwer
 * Date: 03.02.2015
 * Time: 20:41
 */

$view->extend('layout.html.php');
$view['slots']->set('title', "Home");
?>

<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
            <h1>My first Bootstrap website!</h1>

            <p>Lorem ipsum dolor sit amet, consetetur sadipscing.</p>

            <p><a class="btn btn-primary btn-lg" role="button" href="http://www.google.com/"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</a></p>
        </div>
    </div>
</div>