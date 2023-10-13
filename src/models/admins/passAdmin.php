<?php
include('./database.php');
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action === 'admin') {
        $requete = $dbh->prepare("UPDATE visiteur SET status = 2 WHERE id = ?");
        $requete->execute([$id]);
    } elseif ($action === 'commercial') {
        $requete = $dbh->prepare("UPDATE visiteur SET status = 3 WHERE id = ?");
        $requete->execute([$id]);
    }

    header('Location: admin.php');
    exit();
} else {
    echo "Paramètres manquants.";
}
