<?php
session_start();
include (__DIR__ . '../../../utils/getTemplate.php');

if (isset($_SESSION['status'])) {
    $template = getTemplate(__DIR__ . '../../../views/accueil/accueilView.php');
    echo $template;
} else {
    header('Location: controllers/verifUserSessionCtrl.php');
}
