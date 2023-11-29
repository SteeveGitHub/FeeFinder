<?php
session_start();

include('../../database.php');

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user'])) {
    // $userId = $_SESSION['user'];

    // l'id doit être récupéré depuis l'url avec id=...

    $userId = $_GET['id'];

    // Effectuez une requête pour récupérer les informations de l'utilisateur avec l'ID spécifié
    $requete = $dbh->prepare("SELECT * FROM visiteur WHERE id = ?");
    $result = $requete->execute([$userId]);
    $user = $requete->fetch();

    if ($user) {
        // Traitement du formulaire de modification lorsqu'il est soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Effectuez les mises à jour dans la base de données avec les nouvelles valeurs
            $newName = htmlspecialchars($_POST['name']);
            $newPrenom = htmlspecialchars($_POST['prenom']);
            $newEmail = htmlspecialchars($_POST['email']);
            $newPhone = htmlspecialchars($_POST['phone']);
            $newAdress = htmlspecialchars($_POST['adress']);
            $cp = htmlspecialchars($_POST['cp']);
            $newCity = htmlspecialchars($_POST['city']);

            $updateQuery = "UPDATE visiteur SET nom=?, prenom=?, email=?, numero=?, adresse=?, cp=?, ville=? WHERE id=?";
            $updateStatement = $dbh->prepare($updateQuery);
            $updateResult = $updateStatement->execute([$newName, $newPrenom, $newEmail, $newPhone, $newAdress, $cp, $newCity, $userId]);

            if ($updateResult) {
                if($_SESSION['status'] === 2){
                echo "Les informations ont été mises à jour avec succès.";
                header('Location: ../admin/adminView.php');
                die();
            }else if($_SESSION['status'] === 1){
                header('Location: ../frais/consulterFraisView.php');
                die();

            }else if($_SESSION['status'] === 3){
                header('Location: ../comptable/comptableView.php');
                die();

            }}else{
                header('Location: ../connexion/loginView.php');
                die();

            }
        }

        // Affichez le formulaire de modification avec les informations de l'utilisateur pré-remplies
        ?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../../styles/index.css">
            <title>Modifier le profil</title>
        </head>

        <body>
            <?php include_once "../../views/navbar/navbarView.php"?>
            <div class="update-profile-view">
            <h1>Modifier le profil</h1>
            <form action="modifier_profil.php" method="post">
                <label for="name">Nom:</label>
                <input type="text" name="name" id="name" value="<?= $user['nom'] ?>" required><br>

                <label for="prenom">Prénom:</label>
                <input type="text" name="prenom" id="prenom" value="<?= $user['prenom'] ?>" required><br>

                <label for="email">Adresse email:</label>
                <input type="email" name="email" id="email" value="<?= $user['email'] ?>" required><br>

                <label for="phone">Numéro de portable:</label>
                <input type="number" name="phone" id="phone" value="<?= $user['numero'] ?>" required><br>

                <label for="adress">Adresse:</label>
                <input type="text" name="adress" id="adress" value="<?= $user['adresse'] ?>" required><br>

                <label for="cp">Code postal:</label>
                <input type="number" name="cp" id="cp" value="<?= $user['cp'] ?>" required><br>

                <label for="city">Ville:</label>
                <input type="text" name="city" id="city" value="<?= $user['ville'] ?>" required><br>

                <button type="submit">Enregistrer les modifications</button>
            </form>
    </div>
        </body>

        </html>
        <?php
    } else {
        echo "Utilisateur non trouvé.";
    }
} else {
    echo "Utilisateur non connecté.";
}
?>
