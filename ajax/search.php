<?php
session_start();
require_once("../config/database.php");
require_once("../includes/functions.php");
require_once('../filters/auth.filter.php');
extract($_POST);

$q = $db->prepare("SELECT * FROM users
                 WHERE name LIKE :query
                 OR pseudo LIKE :query
                 OR email LIKE :query
                 LIMIT 5");

$q->execute([
    'query' => '%' . $query . '%'
]);

$users = $q->fetchAll(PDO::FETCH_OBJ);
if (count($users) > 0) {
    foreach ($users as $user) {
        ?>
        <div class="display-box-user">
            <a href="profile.php?id=<?= $user->id ?>">
                <img src="<?= $user->avatar ?: get_avatar_url($user->email, 100); ?>"
                     alt="Image de profile de <?= e($user->pseudo); ?>"
                     class="avatar-xs">
                &nbsp;
                <?= e($user->name) ?>
                <br>
                <?= e($user->email) ?>
            </a>
        </div>
        <?php
    }
} else {
    ?>
    <div class="display-box-user">
       Aucun utilisateur trouvé
    </div>
    <?php
}
