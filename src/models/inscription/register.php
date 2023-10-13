<?php
session_start();
if (isset($_POST['login']) && isset($_POST['name']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST["phone"]) && isset($_POST['adress']) && isset($_POST['postal']) && isset($_POST['city']) && isset($_POST['password'])) {
    try {
        include('./database.php');
        $login = htmlspecialchars($_POST['login']);
        $name = htmlspecialchars($_POST['name']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $adress = htmlspecialchars($_POST['adress']);
        $postal = htmlspecialchars($_POST['postal']);
        $city = htmlspecialchars($_POST['city']);
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $status = 1;

        $checkPasswordQuery = $dbh->prepare("SELECT COUNT(1) FROM visiteur WHERE mdp = ?");
        $checkPasswordQuery->execute([$passwordHash]);
        $resultPassword = $checkPasswordQuery->fetch();
        if ($resultPassword[0] != 0) {
            echo "<script>alert('Mot de passse déjà utilsé');
                window.location.href='../../views/inscription/registerView.html';
            </script>";
        }

        $checkLoginQuery = "SELECT COUNT(1) FROM visiteur WHERE login = ?";
        $checkLoginQuery = $dbh->prepare("SELECT COUNT(1) FROM visiteur WHERE login = ?");
        $checkLoginQuery->execute([$login]);
        $resultLogin = $checkLoginQuery->fetch();
        if ($resultLogin[0] != 0) {
            echo "<script>alert('login déjà utilsé');
            window.location.href='../../views/inscription/registerView.html';
        </script>";
        }

        $checkEmailQuery = "SELECT COUNT(1) FROM visiteur WHERE email = ?";
        $checkEmailQuery = $dbh->prepare("SELECT COUNT(1) FROM visiteur WHERE email = ?");
        $checkEmailQuery->execute([$email]);
        $resultEmail = $checkEmailQuery->fetch();
        if ($resultEmail[0] != 0) {
            echo "<script>alert('email déjà utilsé');
            window.location.href='../../views/inscription/registerView.html';
        </script>";
        }

        // Utilise des marqueurs de paramètres dans la requête préparée
        $requete = $dbh->prepare("INSERT INTO visiteur (nom, prenom, numero, login, mdp, adresse, cp, ville, email, status) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $requete->execute([$name, $prenom, $phone, $login, $passwordHash,$adress, $postal, $city,$email, $status]);

        // Lie les valeurs aux marqueurs de paramètres

        header('Location: loginView.html?success=1');
        exit();
    

    } catch (PDOException $e){
        echo 'erreur'.$e;
    }
}
