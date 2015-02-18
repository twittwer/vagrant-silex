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
$slots->set('title', "Settings");
?>

<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
            <h1>Settings</h1>

            <p>Have fun at optimization.</p>

            <p><a class="btn btn-primary btn-lg" role="button" href="http://www.siemens.md.st.schule.de/"><span
                        class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Education</a></p>
        </div>
    </div>
</div>