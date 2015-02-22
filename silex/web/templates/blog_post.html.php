<?php
/** Template Blog Post
 *
 * Shows blog post in a detailed view.
 *
 * User: Tobias Wittwer
 * Date: 18.02.2015
 * Time: 19:00
 *
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 *
 * @var $id
 * @var $date
 * @var $text
 * @var $email
 * @var $user
 */

$slots = $view['slots'];
$view->extend('layout.html.php');
$slots->set('title', "Blog");
?>

<div class="row">
    <div class="col-md-12">
        <a class="btn btn-primary pull-right" href="/static/blog_edit/<?= $id ?>" role="button"><span
                class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Edit Post</a>

        <div class="page-header">
            <h1><?= $title ?>&nbsp;&nbsp;&nbsp;
                <small><i><?= date('H:i d.m.Y', strtotime($date)) ?></i></small>
            </h1>
        </div>
        <div
            class="pull-right small"><?= ($user != null ? $user . ' (' : '') ?><?= $email ?><?= ($user != null ? ')' : '') ?></div>
    </div>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <?= $text ?>
    </div>
</div>