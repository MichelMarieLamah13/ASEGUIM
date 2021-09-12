<?php
session_start();
require_once('includes/init.php.');
require_once('filters/auth.filter.php');
if (!empty($_GET['id']) && $_GET['id'] !== get_session('user_id')) {
    if(friend_request_has_been_sent($_GET['id'],get_session('user_id'))){
        $q = $db->prepare("DELETE FROM friends_relationships
                       WHERE (user_id1=:user_id1 AND user_id2=:user_id2)
                       OR (user_id1=:user_id2 AND user_id2=:user_id1)");
        $q->execute([
            'user_id1' => get_session('user_id'),
            'user_id2' => $_GET['id'],
        ]);
        set_flash("Votre relation d'amitié a été annulé avec succès", "success");
        redirect("profile.php?id=" . $_GET['id']);
    }else{
        set_flash("Cette demande a déjà été supprimée","danger");
        redirect("profile.php?id=" . $_GET['id']);
    }
} else {
    set_flash("Vous ne pouvez pas acceder à cette page","danger");
    redirect("profile.php?id=" . get_session('user_id'));
}