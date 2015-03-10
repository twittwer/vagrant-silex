<?php
/** Template Main Page (Home)
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
$slots->set('title', "Home");
?>

<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
            <h1>My first Bootstrap website!</h1>

            <p>Lorem ipsum dolor sit amet, consetetur sadipscing.</p>

            <p><a class="btn btn-primary btn-lg" role="button" href="./search"><span
                        class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</a></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <ul class="list-group">
            <li class="list-group-item list-group-item-success">
                Dapibus ac facilisis in
            </li>
            <li class="list-group-item list-group-item-info">
                Cras sit amet nibh libero
            </li>
            <li class="list-group-item list-group-item-warning">
                Porta ac consectetur ac
            </li>
            <li class="list-group-item list-group-item-danger">
                Vestibulum at eros
            </li>
        </ul>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                labore et dolore magna aliquyam erat, sed diam voluptua.
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            </div>
        </div>
    </div>
</div>