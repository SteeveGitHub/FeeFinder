<?php
include('../../database.php');

$requete = $dbh->prepare("SELECT id, nom, prenom, numero, status FROM visiteur");
$requete->execute();
$row = $requete->fetchAll(PDO::FETCH_ASSOC);
$requete->closeCursor();
