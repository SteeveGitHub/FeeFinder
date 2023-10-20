<?php
session_start();
include (__DIR__ . '../../../utils/getTemplate.php');

if (isset($_SESSION['status'])) {
    $template = getTemplate(__DIR__ . '../../../views/accueil/reportView.php');
    echo $template;
} else {
    header('Location: ../verifUserSessionCtrl.php');
}
