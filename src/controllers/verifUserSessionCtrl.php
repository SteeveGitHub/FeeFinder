<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: views/connexion/loginView.php');
} else {
    header('Location: views/postLogin/postLoginView.php');


    // si ouverte, rediriger vers la page d'accueil selon la page de l'utilisateur
   /* if ($_SESSION['status'] === 1) {
        header('Location: ../views/postLogin/postLoginView.php');
    } else if ($_SESSION['status'] === 2) {
        header('Location: ../views/postLogin/postLoginView.php');
    } else if ($_SESSION['status'] == 3) {
        header('Location: ../views/postLogin/postLoginView.php');
    }*/
}