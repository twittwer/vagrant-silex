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
 */

$slots = $view['slots'];
if ($edit) {
    $view->extend('layout.html.php');
} else {
    $view->extend('blog_posts.html.php');
    $slots->set('postsAtBottom', true);
}
$slots->set('title', "Blog");

if ($_SESSION['login']) {
    ?>

    <div class="panel panel-default">
        <div class="panel-heading"><?= $edit ? 'Edit Post' : 'New Post' ?></div>
        <div class="panel-body">

            <?php if ($error) { ?>
                <div class="alert alert-danger" role="alert">
                    Please fill out the form completely!
                </div>
            <?php } ?>

            <form action="<?= $edit ? '/static/blog_edit/' . $id : '/static/blog_entry' ?>" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?= (($error && $title == '') ? 'has-error' : '') ?>">
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
    </div>

<?php } ?>