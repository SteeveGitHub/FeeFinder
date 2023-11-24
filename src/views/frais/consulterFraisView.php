<?php
session_start();

if (isset($_SESSION['status'])) {
    include '../../database.php';

    // Récupérer les fiches de frais du commercial depuis la base de données
    $commercialId = $_SESSION['user'];

    // Utilisez une requête préparée pour éviter les injections SQL
    $queryFrais = $dbh->prepare("SELECT * FROM frais WHERE user_id = ?");
    $queryFrais->execute([$commercialId]);

    // Récupérer les résultats de la table 'frais'
    $fichesFrais = $queryFrais->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer les fiches hors forfait du commercial depuis la base de données
    $queryHorsForfait = $dbh->prepare("SELECT * FROM hors_forfait WHERE user_id = ?");
    $queryHorsForfait->execute([$commercialId]);

    // Récupérer les résultats de la table 'hors_forfait'
    $fichesHorsForfait = $queryHorsForfait->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Liste des Fiches de Frais</title>
    </head>
    <body>
        <h1>Liste des Fiches de Frais</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date de Début</th>
                    <th>Total Nuit</th>
                    <th>Quantité Nuit</th>
                    <th>Total Repas</th>
                    <th>Quantité Repas</th>
                    <th>KM</th>
                    <th>Type de Transport</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fichesFrais as $fiche) : ?>
                    <tr>
                        <td><?php echo $fiche['id']; ?></td>
                        <td><?php echo $fiche['date_debut']; ?></td>
                        <td><?php echo $fiche['total_night_price']; ?></td>
                        <td><?php echo $fiche['night_quantity']; ?></td>
                        <td><?php echo $fiche['total_meal_price']; ?></td>
                        <td><?php echo $fiche['meal_quantity']; ?></td>
                        <td><?php echo $fiche['km']; ?></td>
                        <td><?php echo $fiche['transport_type']; ?></td>
                        <td><?php echo $fiche['valideComptable'] ? 'Validée' : 'En attente'; ?></td>
                        <td><?php echo $fiche['montantRestant']; ?></td>
                        <td>
                            <a href="detailsFicheFrais.php?id=<?php echo $fiche['id']; ?>">Détails</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h2>Fiches Hors Forfait en Cours</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Total Price</th>
                    <th>Justificatif</th>
                    <th>Statut</th>
                    <th>Montant Restant</th>
                    <th>Nombre de jours</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fichesHorsForfait as $horsForfait) : ?>
                    <tr>
                        <td><?php echo $horsForfait['id']; ?></td>
                        <td><?php echo $horsForfait['description']; ?></td>
                        <td><?php echo $horsForfait['total_price']; ?></td>
                        <td><?php echo $horsForfait['justificatif']; ?></td>
                        <td><?php echo $horsForfait['valideComptable'] ? 'Validée' : 'En attente'; ?></td>
                        <td><?php echo $horsForfait['montantRestant']; ?></td>
                        <td><?php echo $horsForfait['number_days']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
    </html>
<?php
} else {
    header('Location: ../verifUserSessionCtrl.php');
}
?>
