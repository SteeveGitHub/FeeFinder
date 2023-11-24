<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="../../styles/index.css">
</head>

<body>
    <section class="employees">
        <h1>Employés</h1>
        <table class="renderer employees">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Numéro</th>
                <th>Status</th>
                <th>Action</th>
                <th>Assigner voiture</th>
            </tr>

            <?php
            include('../../models/admins/admin.php');
            foreach ($row as $employe) {
                echo "<tr>";
                echo "<td>" . $employe["id"] . "</td>";
                echo "<td>" . $employe["nom"] . "</td>";
                echo "<td>" . $employe["prenom"] . "</td>";
                echo "<td>" . $employe["numero"] . "</td>";
                echo "<td>" . $employe["status"] . "</td>";
                echo "<td><a href='modifier_profil.php?id=" . $employe["id"] . "'>Modifier</a></td>";


                echo "<td>";
                echo "<select onchange=\"changeRole(this.value, " . $employe["id"] . ")\">";
                echo "<option value='visiteur' " . ($employe["status"] == 1 ? "selected" : "") . ">Visiteur</option>";
                echo "<option value='admin' " . ($employe["status"] == 2 ? "selected" : "") . ">Admin</option>";
                echo "<option value='comptable' " . ($employe["status"] == 3 ? "selected" : "") . ">Comptable</option>";
                echo "<option value='bloqué' " . ($employe["status"] == 4 ? "selected" : "") . ">Bloqué</option>";
                echo "</select>";
                echo "</td>";

                echo "<td>";
                echo "<select onchange=\"assignCar(this.value, " . $employe["id"] . ")\">";
                echo "<option value='3'>3 CV</option>";
                echo "<option value='4'>4 CV</option>";
                echo "<option value='5'>5 CV</option>";
                echo "<option value='6'>6 CV</option>";
                echo "<option value='7'>7 CV</option>";
                echo "</select>";
                echo "</td>";
                // ...


                echo "</tr>";
            }
            ?>
        </table>

        <h2>Modifier les frais forfaitaires</h2>
        <form id="updateFraisForm">
            <?php
            // Afficher les frais forfaitaires
            $sql = "SELECT * FROM fraisforfait";
            $result = $dbh->query($sql);

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div>";
                echo "<label for='frais_" . $row['id'] . "'>" . $row['libelle'] . ": </label>";
                echo "<input type='text' name='frais_" . $row['id'] . "' id='frais_" . $row['id'] . "' value='" . $row['montant'] . "'>";
                echo "</div>";
            }
            ?>
            <button type="button" onclick="updateFrais()">Mettre à jour</button>
        </form>

        <script>
            function changeRole(role, userId) {
                $.ajax({
                    url: '../../models/admins/passAdmin.php',
                    method: 'POST',
                    data: {
                        action: role,
                        id: userId
                    },
                    success: function(response) {
                        alert('Rôle changé avec succès');
                        location.reload();
                    },
                    error: function(error) {
                        alert('Erreur lors du changement de rôle');
                    }
                });
            }

            function updateFrais() {
                var formData = $("#updateFraisForm").serialize();

                $.ajax({
                    url: '../../models/admins/updateFrais.php',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Frais forfaitaires mis à jour avec succès');
                    },
                    error: function(error) {
                        alert('Erreur lors de la mise à jour des frais forfaitaires');
                    }
                });
            }

            function assignCar(cvValue, userId) {
                $.ajax({
                    url: '../../models/admins/updateCvCar.php',
                    method: 'POST',
                    data: {
                        cv_car: cvValue,
                        user_id: userId
                    },
                    success: function(response) {
                        alert('CV Car mis à jour avec succès');
                        location.reload();
                    },
                    error: function(error) {
                        alert('Erreur lors de la mise à jour de CV Car');
                    }
                });
            }
        </script>
    </section>
</body>

</html>