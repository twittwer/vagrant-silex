<?php
/** Template Search
 *
 * Lets the user search in the database for blog posts and users.
 * Shows search results of navbar search.
 *
 * User: Tobias Wittwer
 * Date: 25.02.2015
 * Time: 09:37
 *
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 *
 * @var $searchkey
 * @var $postsTitle
 * @var $postsText
 * @var $users
 */

$slots = $view['slots'];
$view->extend('layout.html.php');
$slots->set('title', "Search");
?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="jumbotron">
                <form method="post" action="/static/search" class="search-form">
                    <div class="col-md-11">
                        <input type="text" name="searchkey" class="form-control input-lg" placeholder="Search"
                               value="<?= $searchkey ?>">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" name="search" class="btn btn-lg btn-primary pull-right">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php if ($searchkey != '') { ?>

    <?php if ($postsTitle == null && $postsText == null && $users == null) { ?>
        <div class="col-md-8 col-md-offset-2">
            <div class="alert alert-info text-center" role="alert">Sorry, your search had no results.</div>
        </div>
    <?php } else { ?>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingUsers">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseUsers" aria-expanded="true"
                           aria-controls="collapseUsers">
                            <span class="badge"><?= count($users) ?></span>&nbsp;&nbsp;Users
                        </a>
                    </h4>
                </div>
                <div id="collapseUsers" class="panel-collapse collapse <?= ($users != null) ? 'in' : '' ?>"
                     role="tabpanel"
                     aria-labelledby="headingUsers">
                    <div class="panel-body">
                        <div class="row search-results">
                            <?php if ($users != null) { ?>
                                <?= $view->render('user_list.html.php', array('users' => $users, 'grid' => true)) ?>
                            <?php } else { ?>
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="alert alert-info text-center" role="alert">Sorry, no users found.</div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingPosts">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsePosts"
                           aria-expanded="false" aria-controls="collapsePosts">
                            <span class="badge"><?= count($postsTitle) + count($postsText) ?></span>&nbsp;&nbsp;Posts
                        </a>
                    </h4>
                </div>
                <div id="collapsePosts"
                     class="panel-collapse collapse <?= ($postsTitle != null || $postsText != null) ? 'in' : '' ?>"
                     role="tabpanel" aria-labelledby="headingPosts">
                    <div class="panel-body">
                        <div class="row search-results">
                            <?php if ($postsTitle != null || $postsText != null) { ?>
                                <?= $view->render('blog_posts.html.php', array('posts' => $postsTitle, 'grid' => false)) ?>
                                <?= $view->render('blog_posts.html.php', array('posts' => $postsText, 'grid' => false)) ?>
                            <?php } else { ?>
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="alert alert-info text-center" role="alert">Sorry, no blog posts found.
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>