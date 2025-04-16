<?php
include_once "dbconn.php";
session_start();

if (isset($_POST['submit-register'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = md5($_POST['mot_de_passe']);

    $select = "SELECT * FROM `user` WHERE email='$email'";
    $resultSelect = mysqli_query($connect, $select);

    if (mysqli_num_rows($resultSelect) > 0) {
        $messageSignup[] = 'Cette utilisateur existe deja';
    } else {
        if (!empty($nom) && !empty($email) && !empty($mot_de_passe)) {
                $insert = "INSERT INTO `utilisateur`(nom, email, mot_de_passe) VALUES('$nom', '$email', '$mot_de_passe')";
                $resultInsert = mysqli_query($connect, $insert);

                if ($resultInsert) {
                    $messageSignup[] = "Inscription reussite";
                    header("Location: http://127.0.0.1:5500/GeeK.Io/Index.html");
                } else {
                    $messageSignup[] = "Echec de l'Inscription";
                }
            }
        } else {
            $messageSignup[] = "Tous les champs sont requies";
        }
    }



if (isset($_POST['submit-login'])) {
    $email_login = $_POST['email_login'];
    $mot_de_passe_login = md5($_POST['mot_de_passe_login']);

    $select = "SELECT * FROM `user` WHERE email='$email_login'";
    $resultSelect = mysqli_query($connect, $select);

    if (mysqli_num_rows($resultSelect) > 0) {

        if (!empty($email_login) && !empty($mot_de_passe_login)) {
            $selectUtilisateur = "SELECT * FROM `user` WHERE email='$email_login' AND mot_de_passe = '$mot_de_passe_login'";
            $resultUtilisateur = mysqli_query($connect, $selectUtilisateur);

            if (mysqli_num_rows($resultUtilisateur) > 0) {
                $row = mysqli_fetch_assoc($resultUtilisateur);
                $_SESSION['user_id'] = $row['id_utilisateur'];
                echo $_SESSION['user_id'];
                $messageLogin[] = 'connexion reussite';
                header("Location: http://127.0.0.1:5500/GeeK.Io/Index.html");
            } else {
                $messageLogin[] = 'Mot de passe incorrect';
            }
        }
    } else {
        $messageLogin[] = "Cette utilisateur n'existe pas";
    }
}
