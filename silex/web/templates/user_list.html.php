<?php
/** Template User List
 *
 * Shows list of users.
 *
 * Required
 *      $users      array of users (assocArray)
 *      $grid       to decide if the users are shown in grid or among each other
 *
 * User: Tobias Wittwer
 * Date: 25.02.2015
 * Time: 12:50
 *
 * @var $users
 * @var $grid
 */
?>

<?php foreach ($users as $user) { ?>
    <div class="<?= $grid ? ((count($users) > 2) ? 'col-md-4' : 'col-md-6') : 'col-md-12' ?>">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="link-unseen" href="/static/profile/<?= $user['username'] ?>">
                    <?= $user['firstname'] != '' ? $user['firstname'] . '&nbsp;' . $user['lastname'] : $user['username'] ?>
                    &nbsp;
                    <small><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></small>
                    <div class="pull-right small">
                        <?php if ($user['firstname'] != '') { ?>
                            <i><?= $user['username'] ?></i>
                        <?php } ?>
                    </div>
                </a>
            </div>
        </div>
    </div>
<?php } ?>