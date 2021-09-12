<?php
session_start();
require_once("includes/init.php");
require_once("filters/auth.filter.php");
if(!empty($_GET['id'])){
    if(micropost_has_already_been_liked($_GET['id'])){
        unlike_micropost($_GET['id']);
    }else{
        set_flash("Vous n'avez d'abord pas aimée cette publication",'danger');
    }
}
redirect('profile.php?id='.get_session('user_id').'#micropost'.$_GET['id']);
