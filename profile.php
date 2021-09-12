<?php
session_start();
require_once('includes/init.php.');
require_once('filters/auth.filter.php');
?>
<?php
//--On teste l'existence de l'id dans l'adresse
if (!empty($_GET['id'])) {
    //--Si l'id existe, on recupère les données en bd
    $user = find_user('id', $_GET['id'], 'users');
    if (!$user) {
        redirect('index.php');
    } else {
        $q = $db->prepare("SELECT U.id user_id, U.pseudo, U.email, U.avatar,
                                  M.id m_id, M.content,M.like_count, M.created_at
                           FROM users U, microposts M, friends_relationships F
                           WHERE M.user_id = U.id
                           AND
                           CASE
                                WHEN F.user_id1 = :user_id
                                THEN F.user_id2 = M.user_id
                                WHEN F.user_id2 = :user_id
                                THEN F.user_id1 = M.user_id
                           END
                           AND F.status > 0
                           ORDER BY M.id DESC");
        $q->execute([
            'user_id' => $_GET['id']
        ]);
        $microposts = $q->fetchAll(PDO::FETCH_OBJ);
    }

} else {
    //--Si l'id n'existe pas, on le redirige avec les bons
    redirect("profile.php?id=" . get_session('user_id'));
}

require_once("views/profile.view.php");

