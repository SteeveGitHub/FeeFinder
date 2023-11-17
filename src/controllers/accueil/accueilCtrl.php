<?php
session_start();

if (isset($_SESSION['status'])) {
    header('Location: ../../../views/accueil/accueilView.php');
} else {
    header('Location: controllers/verifUserSessionCtrl.php');
}
