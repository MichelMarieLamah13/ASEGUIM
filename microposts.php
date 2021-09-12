<?php session_start(); ?>
<?php require_once('includes/init.php.');?>
<?php require_once('filters/auth.filter.php'); ?>

<?php
    if(isset($_POST['publish'])){
        extract($_POST);
        $errors=[];
        if(not_empty(['content'])){
            if (mb_strlen($content) < 3) {
                $errors[]="Micropost trop court: (Minimum 3 caractères) ";
                set_flash($errors[0],"danger");
            }

            if (mb_strlen($content) > 140) {
                $errors[]="Micropost trop long: (Maximum 140 caractères)";
                set_flash($errors[0],"danger");
            }

            if (count($errors) == 0) {
                create_micropost($content);
                set_flash("Votre status a été mis à jour");
            }
        }else{
            $errors[]="Aucun contenu n'a été fourni";
            set_flash($errors[0],"danger");
        }
    }
?>
<?php
redirect("profile.php?id=" . get_session('user_id'));

