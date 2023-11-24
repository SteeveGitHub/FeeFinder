<?php
include('../../database.php');

$table = $_POST['table'];
$id = $_POST['id'];
$value = $_POST['value'];
$comment = $_POST['comment'];

$requete = $dbh->prepare("UPDATE $table SET valideComptable = ?, comment = ? WHERE id = ?");
$requete->execute([$value, $comment, $id]);
