<?php
/** Template Guestbook
 *
 * User: Tobias Wittwer
 * Date: 11.02.2015
 * Time: 09:37
 *
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 */

$slots = $view['slots'];
$view->extend('layout.html.php');
$slots->set('title', "Guestbook");
?>

<div class="panel panel-default">
    <div class="panel-heading">New Entry</div>
    <div class="panel-body">

        <?php if ($error) { ?>
            <div class="alert alert-danger" role="alert">
                Please fill out the form completely!
            </div>
        <?php } ?>

        <form action="./guestbook" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?= (($error && $title == '') ? 'has-error' : '') ?>">
                        <label for="title" class="control-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                               placeholder="Enter title of entry" <?= 'value="' . $title . '"' ?>>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?= (($error && $email == '') ? 'has-error' : '') ?>">
                        <label for="email" class="control-label">Email address</label>
                        <input type="email" name="email" id="email" class="form-control"
                               placeholder="Enter email" <?= 'value="' . $email . '"' ?>>
                    </div>
                </div>
            </div>
            <div class="form-group <?= (($error && $text == '') ? 'has-error' : '') ?>">
                <textarea name="text" class="form-control" rows="3"
                          placeholder="Enter your message"><?= $text ?></textarea>
            </div>
            <br/>
            <button type="submit" name="send" class="btn btn-primary" value="send">Send</button>
        </form>
    </div>
</div>