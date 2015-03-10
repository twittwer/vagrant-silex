<?php
/** Template Blog Post List
 *
 * Shows list of blog posts.
 *
 * Required
 *      $posts      array of blog posts (assocArray)
 *      $grid       to decide if the posts are shown in grid or among each other
 *
 * User: Tobias Wittwer
 * Date: 18.02.2015
 * Time: 15:50
 *
 * @var $posts
 * @var $grid
 */
?>

<?php foreach ($posts as $post) { ?>
    <div class="<?= $grid ? 'col-md-6' : 'col-md-12' ?>">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="link-unseen"
                   href="/static/blog_post/<?= $post['id'] . '/' . urlencode($post['title']) ?>"><?= $post['title'] ?>
                    &nbsp;
                    <small><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></small>
                </a>

                <div class="pull-right small">
                    <i>
                        <?= date('D, d.m.', strtotime($post['created_at'])) ?>&nbsp;&ndash;&nbsp;
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