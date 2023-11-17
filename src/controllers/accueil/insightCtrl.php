<?php
session_start();

if (isset($_SESSION['status'])) {
    header('Location: ../../../views/accueil/insightsView.php');
} else {
    header('Location: ../verifUserSessionCtrl.php');
}
