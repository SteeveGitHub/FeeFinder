<?php
session_start();

// Inclure le fichier de connexion à la base de données
include 'database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Récupérer les détails de la fiche de frais depuis la base de données
$ficheId = $_GET['id'];

// Utilisez une requête préparée pour éviter les injections SQL
$query = $dbh->prepare("SELECT * FROM fichefrais WHERE id = :ficheId");
$query->bindParam(':ficheId', $ficheId, PDO::PARAM_INT);
$query->execute();

// Récupérer les résultats
$fiche = $query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Fiche de Frais</title>
</head>
<body>
    <h1>Détails de la Fiche de Frais</h1>
    <p>Mois: <?php echo $fiche['mois']; ?></p>
    <p>Montant Total: <?php echo $fiche['montantValide']; ?></p>
    <!-- Ajoutez d'autres détails de la fiche de frais ici -->
</body>
</html>
