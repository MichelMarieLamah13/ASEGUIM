<?php
session_start();
require_once("includes/init.php");
require_once("filters/auth.filter.php");
if(!empty($_GET['id'])){
    if(!micropost_has_already_been_liked($_GET['id'])){
        like_micropost($_GET['id']);
    }else{
        set_flash("Vous avez déjà aimée cette publication",'danger');
    }
}
redirect('profile.php?id='.get_session('user_id').'#micropost'.$_GET['id']);
