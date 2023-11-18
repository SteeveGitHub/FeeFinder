<?php
session_start();

if (isset($_SESSION['status'])) {
    header('Location: ../../views/accueil/reportView.php');
} else {
    header('Location: ../verifUserSessionCtrl.php');
}
