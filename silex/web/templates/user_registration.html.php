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
 * @var $error
 * @var $existingUser
 * @var $username
 * @var $email
 * @var $firstname
 * @var $lastname
 */

$slots = $view['slots'];
$view->extend('layout.html.php');
$slots->set('title', "Registration");
?>

<div class="panel panel-default">
    <div class="panel-heading">New Account</div>
    <div class="panel-body">

        <?php if ($error || $existingUser) { ?>
            <div class="alert alert-danger text-center" role="alert">
                <?= $error ? 'Please fill out the form completely!<br/>' : '' ?>
                <?= $existingUser ? "The username <i>$username</i> already exists!" : '' ?>
            </div>
        <?php } ?>

        <form action="./registration" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div
                        class="form-group <?= ((($error && $username == '') || $existingUser) ? 'has-error' : '') ?>">
                        <label for="username" class="control-label">Username <span
                                class="text-primary">*</span></label>
                        <input type="text" name="username" id="username" class="form-control"
                               placeholder="Username" <?= $existingUser ? '' : 'value="' . $username . '"' ?>>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?= (($error && $email == '') ? 'has-error' : '') ?>">
                        <label for="email" class="control-label">Email <span class="text-primary">*</span></label>
                        <input type="email" name="email" id="email" class="form-control"
                               placeholder="Email" <?= 'value="' . $email . '"' ?>>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?= ($error ? 'has-error' : '') ?>">
                        <label for="password" class="control-label">Password <span
                                class="text-primary">*</span></label>
                        <input type="password" name="password" id="password" class="form-control"
                               placeholder="Password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?= ($error ? 'has-error' : '') ?>">
                        <label for="passwd" class="control-label">Confirm Password <span
                                class="text-primary">*</span>
                        </label>
                        <input type="password" name="passwd" id="passwd" class="form-control"
                               placeholder="Password">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstname" class="control-label">First Name</label>
                        <input type="text" name="firstname" id="firstname" class="form-control"
                               placeholder="First Name" <?= 'value="' . $firstname . '"' ?>>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname" class="control-label">Last Name</label>
                        <input type="text" name="lastname" id="lastname" class="form-control"
                               placeholder="Last Name" <?= 'value="' . $lastname . '"' ?>>
                    </div>
                </div>
            </div>
            <button type="submit" name="register" class="btn btn-primary"
                    value="1">Sign up
            </button>
        </form>
    </div>
</div>