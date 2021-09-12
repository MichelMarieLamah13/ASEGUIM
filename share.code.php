<?php session_start(); ?>
<?php require_once('includes/init.php.'); ?>
<?php require_once('filters/auth.filter.php'); ?>

<?php
if (!empty($_GET['id'])) {
    $data = find_user('id', $_GET['id'], 'codes');
    $code = (!$data) ? "" : $data->code;
} else {
    $code = "";
}
?>
<?php
if (isset($_POST['save'])) {
    if (not_empty(['code'])) {
        extract($_POST);
        $q = $db->prepare("INSERT INTO codes(code)
                         VALUES(?)");
        $success = $q->execute([$code]);
        if ($success) {
            $id = $db->lastInsertId();
            $fullURL = WEBSITE_URL . '/Reseau_social/show.code.php?id=' . $id;
            $content = "Je viens de créer un nouveau micropost à l'adresse: ". $fullURL;
            create_micropost($content);
            redirect('show.code.php?id=' . $id);
        } else {
            set_flash("Erreur lors de l'ajout du code source. Veuillez réessayer svp!");
            redirect('share.code.php');
        }
    } else {
        redirect('share.code.php');
    }
}
require_once("views/share.code.view.php");
