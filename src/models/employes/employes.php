<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Employés</title>
</head>

<body>
    <h1>Liste des Employés</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Numéro</th>
            <th>Status</th>
            <th>Admin</th>
            <th>Commercial</th>
        </tr>

        <?php
        // Inclure votre fichier de connexion à la base de données
        include('./database.php');

        // Requête SQL pour récupérer les données des employés
        $requete = $dbh->prepare("SELECT id, nom, prenom, numero, status FROM visiteur"); // Assurez-vous d'ajuster la condition WHERE en fonction de vos besoins
        $requete->execute();

        // Parcourir les résultats et les afficher dans le tableau
        while ($row = $requete->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['prenom'] . "</td>";
            echo "<td>" . $row['numero'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td><a href='./passAdmin.php?action=admin&id=" . $row['id'] . "'>Mettre Admin</a></td>";
            echo "<td><a href='./passAdmin.php?action=commercial&id=" . $row['id'] . "'>Mettre Commercial</a></td>";
            echo "</tr>";
        }

        // Fermer la requête et la connexion à la base de données
        $requete->closeCursor();
        ?>

    </table>
</body>

</html>