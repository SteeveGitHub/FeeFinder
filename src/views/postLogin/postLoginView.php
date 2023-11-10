<?php
session_start();
include '../../utils/getTemplate.php';

// Obtenez le statut de l'utilisateur depuis la session
$userStatus = isset($_SESSION['status']) ? $_SESSION['status'] : null;

// Déterminez la page à afficher en fonction du statut de l'utilisateur
if ($userStatus === 1) {
    $pageType = "../accueil/accueilView.php";
} elseif ($userStatus === 2) {
    $pageType = "../admin/adminView.php";
} elseif ($userStatus === 3) {
    $pageType = "../comptable/comptableView.php";
} else {
    // Par défaut, affichez la page d'accueil
    $pageType = '../accueil/accueilView.php';
}

// Appel de la fonction getTemplate avec le type de page
$templateData = getTemplate($pageType);
