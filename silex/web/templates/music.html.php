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
$slots->set('title', "Music");
?>

<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
            <h1>Music</h1>

            <p>When words leave off, music begins.&nbsp;&nbsp;-&nbsp;Heinrich Heine</p>

            <p><a class="btn btn-primary btn-lg" role="button"
                  href="http://www.brainyquote.com/quotes/topics/topic_music.html/"><span
                        class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Music Quotes</a></p>
        </div>
    </div>
</div>