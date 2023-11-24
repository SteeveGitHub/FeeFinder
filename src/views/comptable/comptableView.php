<?php
include('../../database.php');

function updateValideComptable($table, $id, $value, $comment)
{
    global $dbh;
    $requete = $dbh->prepare("UPDATE $table SET valideComptable = ?, comment = ? WHERE id = ?");
    $requete->execute([$value, $comment, $id]);
}

// Récupérer les données de la table frais
$requeteFrais = $dbh->prepare("SELECT * FROM frais");
$requeteFrais->execute();
$fraisData = $requeteFrais->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les données de la table hors_forfait
$requeteHorsForfait = $dbh->prepare("SELECT * FROM hors_forfait");
$requeteHorsForfait->execute();
$horsForfaitData = $requeteHorsForfait->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="../../styles/index.css">
</head>

<body>
    <section class="comptable">
        <h1>Frais Forfait</h1>
        <table class="renderer comptable">
            <tr>
                <th>User ID</th>
                <th>Date de début</th>
                <th>Total Night Price</th>
                <th>Night Quantity</th>
                <th>Total Meal Price</th>
                <th>Meal Quantity</th>
                <th>KM</th>
                <th>Transport Type</th>
                <th>Valide Comptable</th>
                <th>Montant Restant</th>
                <th>Commentaire</th>
                <th>Action</th>
            </tr>

            <?php
            foreach ($fraisData as $frais) {
                echo "<tr style='background-color: #c2f0c2;'>";
                echo "<td>" . $frais["user_id"] . "</td>";
                echo "<td>" . $frais["date_debut"] . "</td>";
                echo "<td>" . $frais["total_night_price"] . "€</td>";
                echo "<td>" . $frais["night_quantity"] . "</td>";
                echo "<td>" . $frais["total_meal_price"] . "€</td>";
                echo "<td>" . $frais["meal_quantity"] . "</td>";
                echo "<td>" . $frais["km"] . "</td>";
                echo "<td>" . $frais["transport_type"] . "</td>";
                echo "<td>" . $frais["valideComptable"] . "</td>";
                echo "<td>" . $frais["montantRestant"] . "€</td>";
                echo "<td><input type='text' name='comment_frais_" . $frais["id"] . "'></td>";
                echo "<td>";
                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='id_frais' value='" . $frais["id"] . "'>";
                echo "<button type='button' onclick='updateValideComptable(\"frais\", {$frais["id"]}, 1, document.querySelector(\"#comment_frais_{$frais["id"]}\"))'>Valider</button>";
                echo "<button type='button' onclick='updateValideComptable(\"frais\", {$frais["id"]}, 0, document.querySelector(\"#comment_frais_{$frais["id"]}\"))'>Refuser</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>

        </table>

        <h1>Hors Forfait</h1>
        <table class="renderer comptable">
            <tr>
                <th>User ID</th>
                <th>Description</th>
                <th>Total Price</th>
                <th>Justificatif</th>
                <th>Valide Comptable</th>
                <th>Montant Restant</th>
                <th>Number Days</th>
                <th>Pris en charge</th>
                <th>Commentaire</th>
                <th>Action</th>
            </tr>

            <?php
            foreach ($horsForfaitData as $horsForfait) {
                echo "<tr style='background-color: #ffb6b6;'>";
                echo "<td>" . $horsForfait["user_id"] . "</td>";
                echo "<td>" . $horsForfait["description"] . "</td>";
                echo "<td>" . $horsForfait["total_price"] . "€</td>";
                echo "<td>" . $horsForfait["justificatif"] . "</td>";
                echo "<td>" . $horsForfait["valideComptable"] . "</td>";
                echo "<td>" . $horsForfait["montantRestant"] . "€</td>";
                echo "<td>" . $horsForfait["number_days"] . "</td>";
                echo "<td>" . $horsForfait["pris_en_charge"] . "€</td>";
                echo "<td><input type='text' name='comment_hors_forfait_" . $horsForfait["id"] . "'></td>";
                echo "<td>";
                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='id_hors_forfait' value='" . $horsForfait["id"] . "'>";
                echo "<button type='button' onclick='updateValideComptable(\"hors_forfait\", {$horsForfait["id"]}, 1, document.querySelector(\"#comment_hors_forfait_{$horsForfait["id"]}\"))'>Valider</button>";
                echo "<button type='button' onclick='updateValideComptable(\"hors_forfait\", {$horsForfait["id"]}, 0, document.querySelector(\"#comment_hors_forfait_{$horsForfait["id"]}\"))'>Refuser</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </section>
    <script>
        function updateValideComptable(table, id, value, commentInput) {
            console.log("tabekl : ", table, id, value, commentInput)
            $.ajax({
                url: '../../models/comptable/comptable.php',
                method: 'POST',
                data: {
                    table: table,
                    id: id,
                    value: value,
                    comment: commentInput ? commentInput.value : ''
                },
                success: function(response) {
                    alert('Opération réussie');
                    location.reload();
                },
                error: function(error) {
                    alert('Erreur lors de l\'opération');
                }
            });
        }
    </script>

</body>

</html>