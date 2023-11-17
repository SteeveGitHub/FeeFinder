
        <?php
        // Inclure votre fichier de connexion à la base de données
        include('../../database.php');

        // Requête SQL pour récupérer les données des employés
        $requete = $dbh->prepare("SELECT id, nom, prenom, numero, status FROM visiteur"); // Assurez-vous d'ajuster la condition WHERE en fonction de vos besoins
        $requete->execute();
        $row = $requete->fetchAll(PDO::FETCH_ASSOC);
            // Fermer la requête et la connexion à la base de données
        $requete->closeCursor();
        ?>
