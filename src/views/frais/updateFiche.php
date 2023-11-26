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
    $sql = "UPDATE $table SET ";
    $params = [];

    foreach ($_POST as $colonne => $valeur) {
        if ($colonne !== 'table' && $colonne !== 'id') {
            $sql .= "$colonne = ?, ";
            $params[] = $valeur;
        }
    }

    $sql = rtrim($sql, ', ');
    $sql .= " WHERE id = ?";
    $params[] = $id;
    $requete = $dbh->prepare($sql);
    $requete->execute($params);

    echo "Opération réussie";
} else {
    echo "Erreur : méthode de requête incorrecte.";
}
