<?php
/** Template
 *
 * User: Tobias Wittwer
 * Date: 03.02.2015
 * Time: 20:41
 *
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 */

$slots = $view['slots'];
$view->extend('layout.html.php');
$slots->set('title', "Profile");
?>

<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
            <h1>Profile</h1>

            <p>A bit individualism.</p>

            <p><a class="btn btn-primary btn-lg" role="button" href="http://en.wikipedia.org/wiki/Me_Myself_I/"><span
                        class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Me, Myself and I</a></p>
        </div>
    </div>
</div>