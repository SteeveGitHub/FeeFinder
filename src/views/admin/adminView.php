<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/index.css">
</head>
<body>
    <div></div>
    <section class="employees">
        <?php
        include ('../../models/admins/admin.php');
        echo "<section class='employees'>";
        echo "<h1>Employés</h1>";
        echo "<table class='renderer employees'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nom</th>";
        echo "<th>Prénom</th>";
        echo "<th>Numéro</th>";
        echo "<th>Status</th>";
        echo "<th>Admin</th>";
        echo "<th>Commercial</th>";
        echo "</tr>"; // Ajout de cette ligne pour fermer la ligne d'en-tête

        foreach ($row as $employe) {
            echo "<tr>";
            echo "<td>" . $employe["id"] . "</td>";
            echo "<td>" . $employe["nom"] . "</td>";
            echo "<td>" . $employe["prenom"] . "</td>";
            echo "<td>" . $employe["numero"] . "</td>";
            echo "<td>" . $employe["status"] . "</td>";
            echo "<td><a href='../../models/admins/passAdmin.php?action=admin&id=" . $employe["id"] . "'>Mettre Admin</a></td>";
            echo "<td><a href='../../models/admins/passAdmin.php?action=commercial&id=" . $employe["id"] . "'>Mettre Commercial</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</section>";
        ?>
    </section>
</body>
</html>

