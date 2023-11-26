<?php
session_start();
include '../../database.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../connexion/loginView.php');
    exit();
}

$ficheId = $_GET['id'];
$table = $_GET['table'];

$query = $dbh->prepare("SELECT * FROM $table WHERE id = :ficheId");
$query->bindParam(':ficheId', $ficheId, PDO::PARAM_INT);
$query->execute();

$fiche = $query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Détails et Modification de la Fiche</title>
</head>

<body>
    <?php
    include '../navbar/navbarView.php';
    ?>
    <h1>Détails et Modification de la Fiche</h1>

    <?php if ($table === 'frais') : ?>
        <h2>Informations pour la fiche "Frais"</h2>
        <form action="updateFiche.php" method="post">
            <input type="hidden" name="table" value="<?php echo $table; ?>">
            <input type="hidden" name="id" value="<?php echo $fiche['id']; ?>">

            <label for="date_debut">Date de Début:</label>
            <input type="text" name="date_debut" value="<?php echo $fiche['date_debut']; ?>">

            <label for="total_night_price">Prix total (€):</label>
            <input type="text" name="total_night_price" value="<?php echo $fiche['total_night_price']; ?>">

            <label for="night_quantity">Quantité:</label>
            <input type="text" name="night_quantity" value="<?php echo $fiche['night_quantity']; ?>">

            <!-- Ajoutez d'autres champs si nécessaire -->

            <input type="submit" value="Modifier">
        </form>

    <?php elseif ($table === 'hors_forfait') : ?>
        <h2>Informations pour la fiche "Hors Forfait"</h2>
        <form action="updateFiche.php" method="post">
            <input type="hidden" name="table" value="<?php echo $table; ?>">
            <input type="hidden" name="id" value="<?php echo $fiche['id']; ?>">

            <label for="description">Description:</label>
            <input type="text" name="description" value="<?php echo $fiche['description']; ?>">

            <label for="total_price">Prix Total(€):</label>
            <input type="text" name="total_price" value="<?php echo $fiche['total_price']; ?>">

            <label for="number_days">Nombre de jours:</label>
            <input type="text" name="number_days" value="<?php echo $fiche['number_days']; ?>">

            <input type="submit" value="Modifier">
        </form>
    <?php endif; ?>
</body>

</html>