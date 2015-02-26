<?php
/** Template Blog Entry
 *
 * Shows blog entry form and the existing one at the bottom.
 *
 * User: Tobias Wittwer
 * Date: 11.02.2015
 * Time: 09:37
 *
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 *
 * @var $edit
 * @var $error
 * @var $id
 * @var $date
 * @var $text
 * @var $email
 * @var $user
 * @var $posts
 */

$slots = $view['slots'];
$view->extend('layout.html.php');
$slots->set('title', "Blog");

if ($_SESSION['login']) {
    ?>

    <?php if ($error) { ?>
        <div class="alert alert-danger  text-center" role="alert">
            Please fill out the form completely!
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-12">
            <?php if ($edit) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">Edit Post</div>
                <?php } else { ?>
                <div class="panel-group" id="newPostForm" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-primary">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <a class="link-unseen" data-toggle="collapse" data-parent="#newPostForm"
                               href="#collapseNewPost"
                               aria-expanded="true"
                               aria-controls="collapseNewPost">
                                <h4 class="panel-title">
                                    Add Post <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                                </h4>
                            </a>
                        </div>
                        <div id="collapseNewPost" class="panel-collapse collapse <?= $error ? 'in' : '' ?> "
                             role="tabpanel"
                             aria-labelledby="headingOne">
            <?php } ?>

                            <div class="panel-body">
                                <form action="<?= $edit ? '/static/blog_edit/' . $id : '/static/blog' ?>" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div
                                                class="form-group <?= (($error && $title == '') ? 'has-error' : '') ?>">
                                                <label for="title" class="control-label">Title</label>
                                                <input type="text" name="title" id="title" class="form-control"
                                                       placeholder="Enter title of entry" <?= 'value="' . $title . '"' ?>>
                                            </div>
                                        </div>
                                        <input type="hidden" name="userId" value="<?= $_SESSION['userId'] ?>">
                                    </div>
                                    <div class="form-group <?= (($error && $text == '') ? 'has-error' : '') ?>">
                        <textarea name="text" class="form-control" rows="<?= $edit ? '15' : '5' ?>"
                                  placeholder="Enter your message"><?= $text ?></textarea>
                                    </div>
                                    <button type="submit" name="send" class="btn btn-primary"
                                            value="1"><?= $edit ? 'Save' : 'Send' ?></button>
                                </form>
                            </div>

                            <?php if ($edit) { ?>
                        </div>
                        <?php } else { ?>
                        </div>
                    </div>
                </div>
        <?php } ?>
        </div>
    </div>
<?php } ?>
<?php if (!$edit) { ?>
    <div class="row">
        <div class="col-md-12">
            <?= $view->render('blog_posts.html.php', array('posts' => $posts, 'grid' => true)) ?>
        </div>
    </div>
<?php } ?>
<?php if ($edit && !$_SESSION['login']) { ?>
    <?= $view->render('no_access.html.php'); ?>
<?php } ?>