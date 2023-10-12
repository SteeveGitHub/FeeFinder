<?php
include('./database.php');
// recuperation des fiches dans la base de donnée
?>

<!DOCTYPE html>
<html>
<head>
    <title>Interface Comptable</title>
</head>
<body>
    <h1>Enregistrement des dépenses et des revenus</h1>
    <form method="post" action="<?php echo $_SERVER['fiche.php']; ?>">
        <label for="type">Type :</label>
        <select name="type">
            <option value="depense">Dépense</option>
            <option value="revenu">Revenu</option>
        </select><br>

        <label for="montant">Montant :</label>
        <input type="number" name="montant" step="0.01" required><br>

        <label for="description">Description :</label>
        <input type="text" name="description"><br>

        <input type="submit" name="enregistrer" value="Enregistrer">
    </form>

    <h2>Liste des transactions</h2>
    <table>
        <tr>
            <th>Type</th>
            <th>Montant</th>
            <th>Description</th>
        </tr>
        <?php
        // Gérer l'enregistrement des transactions
        if (isset($_POST['enregistrer'])) {
            $type = $_POST['type'];
            $montant = $_POST['montant'];
            $description = $_POST['description'];
            
            // Afficher la transaction dans le tableau
            echo "<tr><td>$type</td><td>$montant</td><td>$description</td></tr>";
        }
        ?>
    </table>
</body>
</html>