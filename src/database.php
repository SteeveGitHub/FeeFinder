<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=feefinder', "root", "");
} catch (PDOException $e) {
    die("erreur :" . $e);
}

