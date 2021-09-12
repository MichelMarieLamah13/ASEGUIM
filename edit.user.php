
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
    }

} else {
    //--Si l'id n'existe pas, on le redirige avec les bons
    redirect("profile.php?id=" . get_session('user_id'));
}

if (isset($_POST['update'])) {
    $errors = [];
    require_once('upload.php');
//--Si tous les champs ne sont pas vides
    if (not_empty(['name', 'city', 'country','sex','bio'])) {
        extract($_POST);
        if (mb_strlen($name) < 3) {
            $errors[] = "Nom trop court: (Minimum 3 caractères) ";
        }

        if (mb_strlen($country) < 3) {
            $errors[] = "Nom Pays trop court: (Minimum 3 caractères) ";
        }

        if (mb_strlen($city) < 3) {
            $errors[] = "Nom Ville trop court: (Minimum 3 caractères) ";
        }

        if (count($errors) == 0) {
            //---Requete pour selectionner les users
            //--Ayant l'email ou le pseudo

            $q = $db->prepare("UPDATE users
            SET name=:name,city=:city, country=:country, sex=:sex,
            bio=:bio,twitter=:twitter,github=:github,available_for_hiring=:available_for_hiring
            WHERE id=:id
            ");
            $q->execute([
                'name' => $name,
                'city' => $city,
                'country' => $country,
                'sex' => $sex,
                'bio' => $bio,
                'twitter' => $twitter,
                'github' => $github,
                'available_for_hiring' => not_empty(['available_for_hiring'])?'1':'0',
                'id' => $_GET['id']
            ]);

            set_flash('Votre profile a été mis à jour avec succes', 'info');
            redirect("profile.php?id=" . get_session("user_id"));

        } else {
            save_input_data();
        }
    } else {
        $errors[] = "Veuillez, remplir tous les champs";
//--On sauvegarde les valeurs en session
        save_input_data();
    }
} else {
    clear_input_data();
}
require_once("views/edit.user.view.php");

