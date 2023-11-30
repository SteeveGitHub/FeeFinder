<?php
session_start();
include '../../database.php';

if (isset($_SESSION['status'])) {
    $commercialId = $_SESSION['user'];
    $fichesFrais = [];
    $fichesHorsForfait = [];

    $queryFrais = $dbh->prepare("SELECT * FROM frais WHERE user_id = ?");
    $queryFrais->execute([$commercialId]);
    $fichesFrais = $queryFrais->fetchAll(PDO::FETCH_ASSOC);

    $queryHorsForfait = $dbh->prepare("SELECT * FROM hors_forfait WHERE user_id = ?");
    $queryHorsForfait->execute([$commercialId]);
    $fichesHorsForfait = $queryHorsForfait->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET['mois']) && $_GET['mois'] != "00") {
        $visiteurID = $_SESSION['user'];
        $moisSelectionne = $_GET['mois'];

        $queryFrais = $dbh->prepare("SELECT * FROM frais WHERE user_id = ? AND MONTH(date_debut) = ?");
        $queryFrais->execute([$visiteurID, $moisSelectionne]);
        $fichesFrais = $queryFrais->fetchAll(PDO::FETCH_ASSOC);

        $queryHorsForfait = $dbh->prepare("SELECT * FROM hors_forfait WHERE user_id = ? AND MONTH(created_at) = ?");
        $queryHorsForfait->execute([$visiteurID, $moisSelectionne]);
        $fichesHorsForfait = $queryHorsForfait->fetchAll(PDO::FETCH_ASSOC);
    }
?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Liste des Fiches de Frais</title>
        <link rel="stylesheet" href="../../styles/index.css">
    </head>

    <body>
        <?php include '../navbar/navbarView.php'; ?>
        <div class="consulter-frais-view">
            <h1>Liste des Fiches de Frais</h1>
            <form method="get">
                <label for="mois">Sélectionner un mois :</label>
                <select name="mois" id="mois">
                    <option value="00">-- Choisir un mois --</option>
                    <option value="01">Janvier</option>
                    <option value="02">Février</option>
                    <option value="03">Mars</option>
                    <option value="04">Avril</option>
                    <option value="05">Mai</option>
                    <option value="06">Juin</option>
                    <option value="07">Juillet</option>
                    <option value="08">Août</option>
                    <option value="09">Septembre</option>
                    <option value="10">Octobre</option>
                    <option value="11">Novembre</option>
                    <option value="12">Décembre</option>
                </select>
                <input type="submit" value="Filtrer">
            </form>
            <table>
                <thead>
                    <tr>
                        <th>Date de Début</th>
                        <th>Total Nuit</th>
                        <th>Quantité Nuit</th>
                        <th>Total Repas</th>
                        <th>Quantité Repas</th>
                        <th>KM</th>
                        <th>Type de Transport</th>
                        <th>Statut</th>
                        <th>Montant à charge</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $forfait_fees = 0;
                    foreach ($fichesFrais as $fiche) : $forfait_fees += $fiche['montantRestant'] ?>
                        <tr>
                            <td><?php echo $fiche['date_debut']; ?></td>
                            <td><?php echo $fiche['total_night_price']; ?></td>
                            <td><?php echo $fiche['night_quantity']; ?></td>
                            <td><?php echo $fiche['total_meal_price']; ?></td>
                            <td><?php echo $fiche['meal_quantity']; ?></td>
                            <td><?php echo $fiche['km']; ?></td>
                            <td><?php echo $fiche['transport_type']; ?></td>
                            <td><?php echo $fiche['valideComptable'] ? 'Validée' : 'En attente'; ?></td>
                            <td><?php echo $fiche['montantRestant']; ?></td>

                            <?php
                            if (!$fiche['valideComptable']) {
                                echo '<td><a href="detailsFicheFrais.php?id=' . $fiche['id'] . '&table=frais">Modifier</a></td>';
                            }
                            ?>
                        </tr>
                    <?php endforeach; ?>
                    <?php if ($forfait_fees <= 0)  echo "<h2 class='fees'>Aucun frais à payer</h2>";
                    else echo "<h2 class='fees'>Le total forfait à payer est de: " . $forfait_fees . "€</h2>" ?>
                </tbody>
            </table>
            <h2>Fiches Hors Forfait en Cours</h2>
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Total Price</th>
                        <th>Justificatif</th>
                        <th>Statut</th>
                        <th>Montant à charge</th>
                        <th>Pris en charge</th>
                        <th>Nombre de jours</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $hors_forfait_fees = 0;
                    foreach ($fichesHorsForfait as $horsForfait) : $hors_forfait_fees += $horsForfait['total_price']; ?>
                        <tr>
                            <td><?php echo $horsForfait['description']; ?></td>
                            <td><?php echo $horsForfait['total_price']; ?></td>
                            <td><?php echo $horsForfait['justificatif']; ?></td>
                            <td><?php echo $horsForfait['valideComptable'] ? 'Validée' : 'En attente'; ?></td>
                            <td><?php echo ($horsForfait['total_price'] - $horsForfait['pris_en_charge']); ?></td>
                            <td><?php echo $horsForfait['pris_en_charge']; ?></td>
                            <td><?php echo $horsForfait['number_days']; ?></td>
                            <?php
                            if (!$horsForfait['valideComptable']) {
                                echo '<td><a href="detailsFicheFrais.php?id=' . $horsForfait['id'] . '&table=hors_forfait">Modifier</a></td>';
                            }
                            ?>
                        </tr>
                    <?php endforeach; ?>
                    <?php if ($hors_forfait_fees <= 0)  echo "<h2 class='fees'>Aucun hors forfait à payer</h2>";
                    else echo "<h2 class='fees'>Le total hors forfait à payer est de: " . $hors_forfait_fees . "€</h2>" ?>
                </tbody>
            </table>
        </div>
        <?php
        if (($forfait_fees + $hors_forfait_fees) <= 0) {
            echo "<h2 class='fees'>Aucun frais à payer</h2>";
        } else {
            $total_fees = $forfait_fees + $hors_forfait_fees;
            echo "<h2 class='allfeestitle'>Le montant total à payer (forfait + hors forfait) est de: $total_fees €</h2>";
        }
        ?>

    </body>

    </html>

<?php
} else {
    header('Location: ../verifUserSessionCtrl.php');
}
?>