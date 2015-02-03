<?php $view->extend('default_layout.html.php') ?>

<?php $view['slots']->set('title', "Title") ?>

Hello <?= $name; ?>!