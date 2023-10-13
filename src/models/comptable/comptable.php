<!DOCTYPE html>
<html>
<head>
    <title>Interface Comptable - Gestion des Frais</title>
</head>
<body>

<h1>Interface Comptable - Gestion des Frais</h1>

<h2>Liste des Frais</h2>

<table border="1">
    <tr>
        <th>Date</th>
        <th>Employé</th>
        <th>Montant (€)</th>
        <th>Action</th>
    </tr>
    <?php
    // Exemple de données de frais
    $frais = [
        ["2023-10-01", "red", 100],
        ["2023-10-05", "nico", 150],
        // Ajoutez plus de données ici
    ];

    foreach ($frais as $fiche) {
        echo "<tr>";
        echo "<td>" . $fiche[0] . "</td>";
        echo "<td>" . $fiche[1] . "</td>";
        echo "<td>" . $fiche[2] . "</td>";
        echo "<td><a href='../frais/modifierFrais.php?id=1'>Modifier</a> | <a href='../frais/supprimerFrais.php?id=1'>Supprimer</a></td>";
        echo "</tr>";
    }
    ?>
</table>

<h2>Ajouter un Nouveau Frais</h2>

<form method="post" action="../frais/ajouterFrais.php">
    <label>Date :</label>
    <input type="date" name="date" required><br>

    <label>Employé :</label>
    <input type="text" name="employe" required><br>

    <label>Montant (€) :</label>
    <input type="number" name="montant" required><br>

    <input type="submit" value="Ajouter Frais">
</form>

</body>
</html>
