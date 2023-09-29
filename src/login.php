<?php
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
    include('./database.php');
    $email = htmlspecialchars($_POST['email']); 
    $password = htmlspecialchars($_POST['password']);
    
    // A RAJOUTER : CRYPTAGE DU MDP ENVOYE
    $requete = $dbh->prepare("SELECT count(*), id, status FROM visiteur where email = ? and mdp = ?");
    $result = $requete->execute([$email, $password]);
    $rows = $requete->fetchAll();
    if (count($rows)!=0) // nom d'utilisateur et mot de passe correctes
    {
        foreach ($rows as $row) {
            $idUser = $row["id"];
            $status = $row["status"];
        }
        $_SESSION['user'] = $idUser;
        $_SESSION['status'] = $status;
        header('Location: visiteur.php?erreur=1');
    }
    else
        header('Location: login.php?erreur=1');
}
session_destroy();
?>