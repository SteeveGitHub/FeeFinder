<?php
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
    include('./database.php');
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // A RAJOUTER : CRYPTAGE DU MDP ENVOYE
    $requete = $dbh->prepare("SELECT id, status, mdp FROM visiteur where email = ?");
    $result = $requete->execute([$email]);
    $row = $requete->fetch();

    if ($row && password_verify($password, $row["mdp"])) {
        $idUser = $row["id"];
        $status = $row["status"];
        $_SESSION['user'] = $idUser;
        $_SESSION['status'] = $status;
        header('Location: visiteur.php?success=1');
        exit();
    } else {
        header('Location: login.php?erreur=1');
        exit();
    }
}
