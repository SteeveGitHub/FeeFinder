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

// Afficher la page complète
echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeeFinder ©</title>
    <link href="../styles/index.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/384fab6fc8.js" crossorigin="anonymous"></script>
</head>
<body>
    {$templateData['navbar']}
    <main class="container">
        {$templateData['content']}
    </main>
    {$templateData['logout']}
</body>
</html>
HTML;
?>
