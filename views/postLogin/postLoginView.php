<?php
session_start();

// Obtenez le statut de l'utilisateur depuis la session
$userStatus = isset($_SESSION['status']) ? $_SESSION['status'] : null;

// Déterminez la page à afficher en fonction du statut de l'utilisateur
if ($userStatus === 1) {
    header('Location: /views/frais/consulterFraisView.php');
} elseif ($userStatus === 2) {
    header('Location: /views/admin/adminView.php');
} elseif ($userStatus === 3) {
    header('Location: /views/comptable/dashboardView.php');
} else {
    if (!isset($_SESSION['user'])) {
        header('Location: /views/connexion/loginView.php');
    } else {
        header('Location: /views/postLogin/postLoginView.php');
    }
}

