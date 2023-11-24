<?php
require_once("../../database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['forfaitSubmit'])) {
        // Traitement du formulaire "Fiche Forfait"
        $user_id = $_SESSION['user'];
        $date_debut = date('Y-m-d', strtotime($_POST["date"]));

        // Traitement des hébergements
        $price_night = $_POST["priceNight"];
        $number_night = $_POST["numberNight"];

        // Traitement des repas
        $number_meal = $_POST["numberMeal"];
        $price_meal = $_POST["priceMeal"];

        // Traitement des trajets
        $km = $_POST["km"];
        $transport_type = $_POST["transport"];


        // Exécuter la requête d'insertion pour "Fiche Forfait"
        $sql = "INSERT INTO frais (user_id, date_debut, total_night_price, night_quantity, total_meal_price, meal_quantity, km, transport_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$user_id, $date_debut, $price_night, $number_night, $price_meal, $number_meal, $km, $transport_type]);

        // Téléchargement des justificatifs
        $targetDir = "../../justificatifs/";
    } elseif (isset($_POST['horsForfaitSubmit'])) {
        // Traitement du formulaire "Fiche Hors Forfait"
        $user_id = $_SESSION['user'];
        $number_days = $_POST["number_days"];
        $description = $_POST["description-area"];
        $total_price = $_POST["hors-forfait-prix"];
        $justificatif = isset($_FILES["justificatif"]["name"]) ? $_FILES["justificatif"]["name"] : "";

        // Exécuter la requête d'insertion pour "Fiche Hors Forfait"
        $sql = "INSERT INTO hors_forfait (user_id, description, total_price, justificatif, number_days) VALUES (?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$user_id, $description, $total_price, $justificatif, $number_days]);

        // Téléchargement du justificatif pour "Fiche Hors Forfait"
        $targetDir = "../../justificatifs/";
        move_uploaded_file($_FILES["justificatif"]["tmp_name"], $targetDir . basename($justificatif));
    }

    header("Location: ../postLogin/postLoginView.php");
    exit();
}
?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="../../styles/index.css" rel="stylesheet">
</head>

<body>
    <?php include "../navbar/navbarView.php" ?>
    <!-- <input type="button" value="Afficher la modal" onclick="toggleModal()"> -->
    <!-- <div id="modal" class="modal"> -->
        <div class="modal-content">
            <!-- <span class="close" onclick="toggleModal()">&times;</span> -->

            <div id="formSelectorContainer">
                <input type="button" value="Fiche Forfait" onclick="showForfaitForm()">
                <input type="button" value="Fiche Hors Forfait" onclick="showHorsForfaitForm()">
            </div>

            <div id="forfaitFormContainer">
                <h2>Fiche de frais</h2>

                <form id="forfaitForm" method="POST" action="ajouterFraisView.php">
                    <label for="date">Date de début:</label>
                    <input type="date" id="date" name="date" required><br><br>
                    <div class="hebergement">
                        <h2>Hébergements</h2>
                        <p>Informations: Nous prenons en charge 50€/nuit maximum</p>
                        <input type="text" name="priceNight" placeholder="Prix total" />
                        <input type="number" name="numberNight" placeholder="Nombre de nuits" />
                    </div>
                    <div class="repas">
                        <h2>Repas</h2>
                        <p>Informations: Nous prenons en charge 10€/repas maximum</p>
                        <input type="text" name="priceMeal" placeholder="Prix Total" />
                        <input type="number" name="numberMeal" placeholder="Nombre de repas" />
                    </div>
                    <div class="trajet">
                        <h2>Trajets</h2>
                        <label for="cars">Voitures</label>
                        <input type="checkbox" name="cars" />
                        <label for="transports">Transports</label>
                        <input type="checkbox" name="transports" />
                        <div class="cars-container">
                            <p>Frais kilométriques</p>
                            <input type="number" name="km" placeholder="Nombre de KM" />
                            <br />
                        </div>
                        <div class="transports-container" id="transports-container">
                            <label for="transports">Transports</label>
                            <select id="transportType" name="transport">
                                <option value="">-- Choisir --</option>
                                <option value="train">Train</option>
                                <option value="bus">bus</option>
                                <option value="taxi">Taxi</option>
                                <option value="metro&tram">Métro / Tramway</option>
                            </select><br><br>
                            <br />
                        </div>
                    </div>
                    <input type="submit" value="Envoyer" name="forfaitSubmit">
                </form>
            </div>

            <div id="horsForfaitFormContainer">
                <h2>Fiche Hors Forfait</h2>

                <form id="horsForfaitForm" method="POST" action="ajouterFraisView.php">
                    <label for="description">Votre hors forfait:</label>
                    <textarea rows="5" cols="20" name="description-area"></textarea>
                    <label for="totalPrice">Prix total:</label>
                    <input type="text" name="hors-forfait-prix" />
                    <label for="number_days">Nombre de jours :</label>
                    <input type="number" name="number_days" required/>
                    <label for="justificatif">Justificatif:</label>
                    <input type="file" name="justficatif" accept=".pdf" />
                    <input type="submit" value="Envoyer" name="horsForfaitSubmit">
                </form>
            </div>
        </div>
    <!-- </div> -->


    <script>
        window.open(showForfaitForm())

        function showForfaitForm() {
            document.getElementById('forfaitFormContainer').style.display = 'block';
            document.getElementById('horsForfaitFormContainer').style.display = 'none';
            document.getElementById('transports-container').style.display = 'none'
        }

        function showHorsForfaitForm() {
            document.getElementById('forfaitFormContainer').style.display = 'none';
            document.getElementById('horsForfaitFormContainer').style.display = 'block';
        }

        function handleCheckboxClick(clickedCheckbox) {
            // Get the checkbox elements
            var carsCheckbox = document.getElementsByName('cars')[0];
            var transportsCheckbox = document.getElementsByName('transports')[0];

            // Get the container elements
            var carsContainer = document.querySelector('.cars-container');
            var transportsContainer = document.querySelector('.transports-container');

            // Hide both containers initially
            carsContainer.style.display = 'none';
            transportsContainer.style.display = 'none';

            // Determine which checkbox was clicked
            if (clickedCheckbox === carsCheckbox && carsCheckbox.checked) {
                // If "Voitures" is clicked, show the cars container and uncheck the transports checkbox
                carsContainer.style.display = 'block';
                transportsCheckbox.checked = false;
            } else if (clickedCheckbox === transportsCheckbox && transportsCheckbox.checked) {
                // If "Transports" is clicked, show the transports container and uncheck the cars checkbox
                transportsContainer.style.display = 'block';
                carsCheckbox.checked = false;
            }
        }




        // Attach the handleCheckboxClick function to the click events of both checkboxes
        document.getElementsByName('cars')[0].addEventListener('click', function() {
            handleCheckboxClick(document.getElementsByName('cars')[0]);
        });
        document.getElementsByName('transports')[0].addEventListener('click', function() {
            handleCheckboxClick(document.getElementsByName('transports')[0]);
        });
    </script>


</body>

</html>