<?php session_start(); ?>
<?php require_once('includes/init.php.');?>
<?php require_once('filters/auth.filter.php'); ?>
<?php
if (!empty($_GET['id'])) {
    $data = find_user('id',$_GET['id'],'codes');
    if (!$data) {
        redirect('share.code.php');
    }

} else {
    redirect('share.code.php');
}
require_once("views/show.code.view.php");
