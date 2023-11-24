<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Comptable - Gestion des Frais</title>
    <style>
        body {
            background: linear-gradient(to right, #002E22, #01C372);
            color: #FFFAF0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Pour éviter le défilement horizontal lors de l'ouverture du menu */
        }

        h1, h2 {
            background-color: #03BB6D;
            color: #002e22;
            padding: 10px;
            text-align: center;
            margin: 0; /* Réduit la marge du titre pour une apparence plus nette */
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #002E22;
        }

        th, td {
            padding: 10px;
            text-align: left;
            color: white;
            background-color: #002E22;
        }

        tr:nth-child(even) {
            background-color: #002E22;
            color: #fff;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }

        .action-buttons button {
            padding: 8px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .action-buttons button.edit {
            background-color: #03BB6D;
            color: #002E22;
        }

        .action-buttons button.delete {
            background-color: #FF4500;
            color: #002e22;
        }

    </style>
</head>
<body>
<?php include "../navbar/navbarView.php" ?>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>

<h1>Interface Comptable - Gestion des Frais</h1>

<h2>Liste des Frais</h2>

<table>
<tr>
        <th>Date</th>
        <th>Employé</th>
        <th>Montant (€)</th>
        <th>Action</th>
    </tr>
    <?php
    // Connexion à la base de données avec PDO
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=feefinder', "root", "");
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    // Exécuter une requête pour récupérer les données de frais
    $query = "SELECT * FROM fichefrais";
    $stmt = $dbh->query($query);

    // Afficher les données dans le tableau
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['employe'] . "</td>";
        echo "<td>" . $row['montant'] . "</td>";
        echo "<td><a href='../frais/modifierFrais.php?id=" . $row['id'] . "'>Modifier</a> | <a href='../frais/supprimerFrais.php?id=" . $row['id'] . "'>Supprimer</a></td>";
        echo "</tr>";
    }

    // Fermer la connexion
    $dbh = null;
    ?>
</body>
</html>
