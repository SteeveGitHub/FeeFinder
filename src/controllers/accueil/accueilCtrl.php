<?php
session_start();
include (__DIR__ . '../../../utils/getTemplate.php');

if (isset($_SESSION['status'])) {
    header('Location: ../../../views/accueil/accueilView.php');
} else {
    header('Location: controllers/verifUserSessionCtrl.php');
}
