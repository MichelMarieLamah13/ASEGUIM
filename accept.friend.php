<?php
session_start();
require_once('includes/init.php.');
require_once('filters/auth.filter.php');
if(!empty($_GET['id'])&&$_GET['id']!==get_session('user_id')){
    if(friend_request_has_been_sent($_GET['id'],get_session('user_id'))){
        if(is_already_friend()=='0'){
            $q = $db->prepare("UPDATE friends_relationships
                       SET status='1'
                       WHERE (user_id1=:user_id1 AND user_id2=:user_id2)
                       OR (user_id1=:user_id2 AND user_id2=:user_id1)");
            $q->execute([
                'user_id1'=>get_session('user_id'),
                'user_id2'=>$_GET['id'],
            ]);
            $q = $db->prepare('INSERT INTO notifications(subject_id, name, user_id)
                       VALUES(:subject_id, :name, :user_id)');
            $q->execute([
                'subject_id' => $_GET['id'],
                'name' => 'friend_request_accepted',
                'user_id' => get_session('user_id')
            ]);

            set_flash("Vous êtes à présent amis avec cet utilisateur","success");
            redirect("profile.php?id=" . $_GET['id']);
        }else{
            set_flash("Vous êtes déjà amis avec cet utilisateur","danger");
            redirect("profile.php?id=" . $_GET['id']);
        }
    }else{
        set_flash("Cette demande a déjà été supprimée","danger");
        redirect("profile.php?id=" . $_GET['id']);
    }
}else{
    set_flash("Vous ne pouvez pas acceder à cette page","danger");
    redirect("profile.php?id=" . get_session('user_id'));
}