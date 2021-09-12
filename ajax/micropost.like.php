<?php
session_start();
require_once("../config/database.php");
require_once("../includes/functions.php");
require_once('../filters/auth.filter.php');
extract($_POST);
if($action=='like'){
    if(!micropost_has_already_been_liked($micropost_id)){
        like_micropost($micropost_id);
    }else{
        set_flash("Vous avez déjà aimée cette publication",'danger');
    }
}else{
    if(micropost_has_already_been_liked($micropost_id)){
        unlike_micropost($micropost_id);
    }else{
        set_flash("Vous n'avez d'abord pas aimée cette publication",'danger');
    }
}

echo get_likers_text($micropost_id);