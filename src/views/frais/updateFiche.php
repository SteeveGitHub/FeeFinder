<?php
session_start();
include '../../database.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../connexion/loginView.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table = $_POST['table'];
    $id = $_POST['id'];
    $user_id = $_SESSION['user'];

    $sql = "";
    $params = [];

    // Construire la requête SQL et les paramètres en fonction de la table
    if ($table === 'frais') {
        $sqlSelect = "SELECT montant FROM fraisforfait WHERE id = ?";
        $stmtSelect = $dbh->prepare($sqlSelect);
        $id_night = 1;
        $id_meal = 2;
        $id_transport = 3;

        // Calcul du montant à charge restant pour chaque type de frais
        $stmtSelect->execute([$id_night]);
        $montant_night = $stmtSelect->fetchColumn();

        $stmtSelect->execute([$id_meal]);
        $montant_meal = $stmtSelect->fetchColumn();

        $stmtSelect->execute([$id_transport]);
        $montant_transport = $stmtSelect->fetchColumn();

        $charge_night = $_POST['priceNight'] * $montant_night;
        $charge_meal = $_POST['numberMeal'] * $montant_meal;
        $charge_transport = $_POST['km'] * $montant_transport;
        $total_charge = $charge_night + $charge_meal + $charge_transport;


        $sqlSelectCV = "SELECT cv_car FROM visiteur WHERE id = ?";
        $stmtSelectCV = $dbh->prepare($sqlSelectCV);
        $stmtSelectCV->execute([$user_id]);
        $cv_fiscal = $stmtSelectCV->fetchColumn();
        function calculerMontantRembourse($distance, $table, $puissance, $dbhvar)
        {
            $sqlSelectKm = "SELECT distance_jusqu_5000_km, distance_5001_a_20000_km_coefficient, distance_5001_a_20000_km_fixe, distance_plus_20000_km FROM frais_kilometrique_gouvernement WHERE puissance_administrative = ?";
            $stmtSelectKm = $dbhvar->prepare($sqlSelectKm);
            $stmtSelectKm->execute([$puissance]);
            $donneesKm = $stmtSelectKm->fetch(PDO::FETCH_ASSOC);

            // Calculer le montant remboursé en fonction de la distance
            if ($distance <= 5000) {
                $remboursement = $distance * $donneesKm['distance_jusqu_5000_km'];
            } elseif ($distance <= 20000) {
                $remboursement = $distance * $donneesKm['distance_5001_a_20000_km_coefficient'] + $donneesKm['distance_5001_a_20000_km_fixe'];
            } else {
                $remboursement = $distance * $donneesKm['distance_plus_20000_km'];
            }
            return $remboursement;
        }

        // Calculer et afficher le montant remboursé
        $montantRembourse = calculerMontantRembourse($_POST['km'], 'frais_kilometrique_gouvernement', $cv_fiscal, $dbh);
        $total_charge -= $montantRembourse;



        $sql = "UPDATE frais SET date_debut = ?, total_night_price = ?, night_quantity = ?, total_meal_price = ?, meal_quantity = ?, km = ?, transport_type = ?, montantRestant = ? WHERE id = ?";
        $params = [
            $_POST['date'],
            $_POST['priceNight'],
            $_POST['numberNight'],
            $_POST['priceMeal'],
            $_POST['numberMeal'],
            $_POST['km'],
            $_POST['transport'],
            $total_charge,
            $id
        ];
    } elseif ($table === 'hors_forfait') {
        $sql = "UPDATE hors_forfait SET description = ?, total_price = ?, number_days = ? WHERE id = ?";
        $params = [
            $_POST['description-area'],
            $_POST['hors-forfait-prix'],
            $_POST['number_days'],
            $id
        ];
    }

    // Exécuter la requête SQL
    $requete = $dbh->prepare($sql);
    $requete->execute($params);

    header('Location: consulterFraisView.php');
    exit();
} else {
    echo "Erreur : méthode de requête incorrecte.";
}
