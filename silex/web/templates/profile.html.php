<?php
/** Template User Profile
 *
 * Shows detailed information about a user and a list of his blog posts.
 *
 * User: Tobias Wittwer
 * Date: 03.02.2015
 * Time: 20:41
 *
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 *
 * @var $userId
 * @var $username
 * @var $firstname
 * @var $lastname
 * @var $email
 * @var $registrationDate
 * @var $posts
 */

$slots = $view['slots'];
$view->extend('layout.html.php');
$slots->set('title', "Profile");
?>

<div class="row">
    <div class="col-md-12">
        <?php if ($username == $_SESSION['username']) { ?>
            <a class="btn btn-default pull-right" href="/static/settings" role="button"><span
                    class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;Settings</a>
        <?php } ?>
        <div class="page-header">
            <?php if ($firstname != '' && $lastname != '') { ?>
                <h1><?= $firstname . '&nbsp;' . $lastname ?>&nbsp;
                    <small><i><?= $username ?></i></small>
                </h1>
            <?php } else { ?>
                <h1><?= $username ?></h1>
            <?php } ?>
        </div>
        <div class="pull-right small">Registered since <?= date('d.m.Y', strtotime($registrationDate)) ?></div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Userinformation
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-2 show-label">Email</div>
                    <div class="col-md-4"><?= $email ?></div>
                    <div class="col-md-2 show-label">Postcounter</div>
                    <div class="col-md-4"><?= count($posts) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?= $view->render('blog_posts.html.php', array('posts' => $posts, 'grid' => true)) ?>
</div>