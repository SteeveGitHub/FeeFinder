<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    if ($action === 'ajouterFrais') {
        header('Location: ../../views/frais/ajouterFraisView.php');
        exit();
    } elseif ($action === 'consulterFrais') {
        header('Location: ../../views/frais/consulterFraisView.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeeFinder</title>
</head>
<body>

    <h1>GSB - Gestion des Frais</h1>

    <div>
        <a href="?action=ajouterFrais"><button>Ajouter des frais</button></a>
        <a href="?action=consulterFrais"><button>Consulter mes frais</button></a>
    </div>

</body>
</html>
