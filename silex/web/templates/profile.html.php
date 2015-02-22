<?php
/** Template
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
 */

$slots = $view['slots'];
$view->extend('blog_posts.html.php');
$slots->set('postsAtBottom', true);
$slots->set('title', "Profile");
?>

<div class="row">
    <div class="col-md-12">
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
                <?= $email ?>
            </div>
        </div>
    </div>
</div>