<?php
session_start();
require_once('includes/init.php.');
require_once('filters/auth.filter.php');
if (!empty($_GET['id']) && $_GET['id'] !== get_session('user_id')) {
    if (!friend_request_has_been_sent($_GET['id'], get_session('user_id'))) {
        $q = $db->prepare("INSERT INTO friends_relationships(user_id1,user_id2)
                           VALUES(:user_id1,:user_id2)");
        $q->execute([
            'user_id1' => get_session('user_id'),
            'user_id2' => $_GET['id'],
        ]);
        $q = $db->prepare('INSERT INTO notifications(subject_id, name, user_id)
                           VALUES(:subject_id, :name, :user_id)');
        $q->execute([
            'subject_id' => $_GET['id'],
            'name' => 'friend_request_sent',
            'user_id' => get_session('user_id'),
        ]);

        set_flash("Votre d'amitié a été envoyé avec succès", "success");
        redirect("profile.php?id=" . $_GET['id']);
    } else {
        set_flash("Cet utilisateur vous a déjà envoyé une demande d'amitié", "warning");
        redirect("profile.php?id=" . $_GET['id']);
    }

} else {
    redirect("profile.php?id=" . get_session('user_id'));
}