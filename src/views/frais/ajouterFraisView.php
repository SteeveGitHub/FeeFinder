<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../../database.php");

    // Récupérer les données du formulaire
    $user_id = $_SESSION['user'];
    $date_debut = date('Y-m-d', strtotime($_POST["date"]));

    // Traitement des hébergements
    $price_night = $_POST["priceNight"];
    $number_night = $_POST["numberNight"];
    $justificatif_hebergement = $_POST["justificatifNight"];
    $total_night_price = $price_night * $number_night; // Calcul du prix total pour les nuits

    // Traitement des repas
    $number_meal = $_POST["numberMeal"];
    $price_meal = $_POST["priceMeal"];
    $justificatif_repas = $_POST["justificatifRepas"];
    $total_meal_price = $price_meal * $number_meal; // Calcul du prix total pour les repas

    // Traitement des trajets
    $cars = isset($_POST["cars"]) ? 1 : 0;
    $horse_power = $_POST["horsePower"];
    $km = $_POST["km"];
    $transport_type = $_POST["transport"];
    $justificatif_trajet = isset($_POST["justificatifTrajet"]) ? $_POST["justificatifTrajet"] : NULL;

    // Traitement des autres frais
    $other_fee_name = $_POST["otherfeeName"];
    $other_fee_price = isset($_POST["otherfeePrice"]) ? (float)$_POST["otherfeePrice"] : NULL;



    // Exécuter la requête d'insertion
    $sql = "INSERT INTO frais (user_id, date_debut, total_night_price, justificatif_hebergement, total_meal_price, justificatif_repas, cars, horse_power, km, transport_type, justificatif_trajet, other_fee_name, other_fee_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$user_id, $date_debut, $total_night_price, $justificatif_hebergement, $total_meal_price, $justificatif_repas, $cars, $horse_power, $km, $transport_type, $justificatif_trajet, $other_fee_name, $other_fee_price]);

    $targetDir = "../../justificatifs/";

    move_uploaded_file($_FILES["justificatifHebergement"]["tmp_name"], $targetDir . basename($justificatif_hebergement));
    move_uploaded_file($_FILES["justificatifRepas"]["tmp_name"], $targetDir . basename($justificatif_repas));
    if (!empty($justificatif_trajet)) {
        move_uploaded_file($_FILES["justificatifTrajet"]["tmp_name"], $targetDir . basename($justificatif_trajet));
    }

    header("Location: ../accueilView.php");
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="../../styles/index.css" rel="stylesheet">
</head>

<body>
    <input type="button" value="Afficher la modal" onclick="toggleModal()">

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="toggleModal()">&times;</span>

            <h1>Fiche de frais</h1>
            <form method="POST" action="">
                <label for="date">Date de début:</label>
                <input type="date" id="date" name="date" required><br><br>
                <div class="hebergement">
                    <h2>Hébergements</h2>
                    <p>Informations: Nous prenons en charge 50€/nuit maximum</p>
                    <input type="text" name="priceNight" placeholder="Prix de la nuit" />
                    <input type="number" name="numberNight" placeholder="Nombre de nuits" />
                    <label for="justificatif">Justificatif :</label>
                    <input type="file" id="justificatif" name="justificatifNight"><br><br>
                </div>
                <div class="repas">
                    <h2>Repas</h2>
                    <p>Informations: Nous prenons en charge 10€/repas maximum</p>
                    <input type="number" name="numberMeal" placeholder="Nombre de repas" />
                    <input type="text" name="priceMeal" placeholder="Prix du repas" />
                    <label for="justificatif">Justificatif :</label>
                    <input type="file" id="justificatif" name="justificatifRepas"><br><br>
                </div>
                <div class="trajet">
                    <h2>Trajets</h2>
                    <label for="cars">Voitures</label>
                    <input type="checkbox" name="cars" />
                    <input type="checkbox" name="transports" />
                    <div class="cars-container">
                        <p>Nbr de chevaux fiscaux de la voiture</p>
                        <select id="horsePower" name="horsePower">
                            <option value="3cv">3cv</option>
                            <option value="4cv">4cv</option>
                            <option value="5cv">5cv</option>
                            <option value="6cv">6cv</option>
                            <option value="7cv">7cv +</option>
                        </select><br><br>
                        <p>Frais kilométriques</p>
                        <input type="number" name="km" placeholder="Nombre de KM" />
                        <br />
                    </div>
                    <div class="transports-container">
                        <label for="transports">Transports</label>
                        <select id="transportType" name="transport">
                            <option value="train">Train</option>
                            <option value="bus">bus</option>
                            <option value="taxi">Taxi</option>
                            <option value="metro&tram">Métro / Tramway</option>
                        </select><br><br>
                        <br />
                    </div>
                    <label for="justificatif">Justificatif :</label>
                    <input type="file" id="justificatif" name="justificatifTrajet"><br><br>
                </div>
                <div class="other">
                    <h2>Autres frais</h2>
                    <label>Renseigner un autre frais</label>
                    <input type="text" name="otherfeeName" placeholder="Votre frais" />
                    <input type="text" name="otherfeePrice" placeholder="Prix du frais" />
                </div>
                <input type="submit" value="Envoyer">
            </form>
        </div>
    </div>


    <script>
        function toggleModal() {
            var modal = document.getElementById('modal');
            modal.style.display = (modal.style.display === 'none' || modal.style.display === '') ? 'block' : 'none';
        }

        function handleCheckboxClick(clickedCheckbox) {
            // Get the checkbox elements
            var carsCheckbox = document.getElementsByName('cars')[0];
            var transportsCheckbox = document.getElementsByName('transports')[0];

            // Get the container elements
            var carsContainer = document.querySelector('.cars-container');
            var transportsContainer = document.querySelector('.transports-container');

            // Determine which checkbox was clicked
            var isChecked = clickedCheckbox.checked;

            // Uncheck the other checkbox
            if (clickedCheckbox === carsCheckbox && isChecked) {
                transportsCheckbox.checked = false;
            } else if (clickedCheckbox === transportsCheckbox && isChecked) {
                carsCheckbox.checked = false;
            }

            // Check the status of the checkboxes and show/hide containers accordingly
            if (carsCheckbox.checked) {
                carsContainer.style.display = 'block';
                transportsContainer.style.display = 'none';
            } else if (transportsCheckbox.checked) {
                carsContainer.style.display = 'none';
                transportsContainer.style.display = 'block';
            } else {
                carsContainer.style.display = 'none';
                transportsContainer.style.display = 'none';
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