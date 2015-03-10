<?php
/** Template Response Panel
 *
 * Template to display the result of an action.
 *
 * Required
 *      $title             page title
 *      $responseType      panel class (primary, success, info, warning, danger)
 *      $responseTitle     title of panel
 *      $responseContent   content of panel
 * Optional
 *      [$returnLink]      link to site the user will be redirected with close button
 *
 * User: Tobias Wittwer
 * Date: 18.02.2015
 * Time: 11:55
 *
 * @var $view \Symfony\Component\Templating\PhpEngine
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 */

$slots = $view['slots'];
$view->extend('layout.html.php');
$slots->set('title', $title);
?>

<div class="panel panel-<?= $responseType ?>">
    <div class="panel-heading">
        <?php if (isset($returnLink)) { ?>
        <a type="button" href="<?= $returnLink ?>" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a>
        <?php } ?>
        <?= $responseTitle ?>
    </div>
    <div class="panel-body">
        <?= $responseContent ?>
    </div>
</div>