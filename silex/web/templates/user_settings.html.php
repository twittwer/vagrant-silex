<?php
/** Template User Settings
 *
 * User: Tobias Wittwer
 * Date: 24.02.2015
 * Time: 17:00
 *
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 *
 * @var $errorPasswd
 */

$slots = $view['slots'];
$view->extend('layout.html.php');
$slots->set('title', "Settings");

if ($_SESSION['login']) {
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>Settings</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Set New Password</div>
                <div class="panel-body">
                    <form action="./settings" method="post">
                        <div class="form-group <?= ($errorPasswd ? 'has-error' : '') ?>">
                            <input type="password" name="password" class="form-control"
                                   placeholder="New Password">
                        </div>
                        <div class="form-group <?= ($errorPasswd ? 'has-error' : '') ?>">
                            <input type="password" name="passwd" class="form-control"
                                   placeholder="Confirm New Password">
                        </div>
                        <button type="submit" name="changePasswd" class="btn btn-primary btn-block"
                                value="1">Change Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>
    <?= $view->render('no_access.html.php'); ?>
<?php } ?>