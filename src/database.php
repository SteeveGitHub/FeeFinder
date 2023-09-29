<?php
try {

    $dbh = new PDO('mysql:host=localhost:8111;dbname=feefinder', "root", "");
} catch (PDOException $e) {
    die("erreur :" . $e);
}
