<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Visiteur</title>
</head>

<body>
    <header>
        <?php
        session_start();
        if (isset($_SESSION['status'])) {
            // Statut égal à 1 : Afficher un élément "Employés"
            if ($_SESSION['status'] === 1) {
                echo '<h1>Page Visiteur</h1>';
            }

            // Statut égal à 2 : Afficher un élément "Admin"
            if ($_SESSION['status'] === 2) {
                echo '<h1>Page Admin</h1>';
            }

            // Statut égal à 3 : Afficher un élément "Comptables"
            if ($_SESSION['status'] === 3) {
                echo '<h1>Page Comptable</h1>';
            }
        }
        ?>
    </header>

    <nav>
        <ul>
            <li><a href="/">Les fiches:<?php echo $_SESSION['status']; ?> </a></li>
            <?php
            include '../../utils/getTemplate.php';
            if (isset($_SESSION['status'])) {
                // Statut égal à 2 : Afficher un élément "Admin"
                if ($_SESSION['status'] === 2) {
                    echo getTemplate('../admin/adminView.php');
                    getTemplate('../admin/adminView.php');
                }

                // Statut égal à 3 : Afficher un élément "Comptables"
                if ($_SESSION['status'] === 3) {
                    getTemplate('../comptable/comptableView.php');
                }
                // Statut égal à 1 : Afficher un élément "Visiteurs"
                else {
                    echo getTemplate('../accueil/accueilView.php'); 
                }
            }
            ?>
        </ul>
    </nav>
    <?php include("../../views/connexion/logoutView.php"); ?>
</body>

</html>