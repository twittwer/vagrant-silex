<?php
/** Template Blog Post List
 *
 * Required title-slot
 *      for main layout template
 * Optional postsAtBottom-slot
 *      to decide if the posts are under (true, default) or above (false) the content.
 *
 * User: Tobias Wittwer
 * Date: 18.02.2015
 * Time: 15:50
 *
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 *
 * @var $posts
 */

$slots = $view['slots'];
$view->extend('layout.html.php');
$postsAtBottom = $slots->has('postsAtBottom') ? $slots->get('postsAtBottom') : true;
?>

<?php if ($postsAtBottom) { ?>
    <div class="row">
        <div class="col-md-12">
            <?php $slots->output('_content') ?>
        </div>
    </div>
<?php } ?>

    <div class="row">
        <?php foreach ($posts as $post) { ?>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a class="link-unseen"
                           href="/static/blog_post/<?= $post['id'] . '/' . urlencode($post['title']) ?>"><?= $post['title'] ?>
                            <small><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></small>
                        </a>

                        <div class="pull-right small">
                            <i>
                                <?= date('D, d.m.', strtotime($post['created_at'])) ?>&nbsp;&#150;&nbsp;
                                <a class="link-uncolored"
                                   href="/static/profile/<?= $post['username'] ?>"><?= $post['username'] ?></a>
                            </i>
                        </div>
                    </div>
                    <div class="panel-body small-post">
                        <?= $post['text'] ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

<?php if (!$postsAtBottom) { ?>
    <div class="row">
        <div class="col-md-12">
            <?php $slots->output('_content') ?>
        </div>
    </div>
<?php } ?>