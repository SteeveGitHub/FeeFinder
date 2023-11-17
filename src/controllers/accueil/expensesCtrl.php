<?php
session_start();

if (isset($_SESSION['status'])) {
    header('Location: ../../views/accueil/expensesView.php');

} else {
    header('Location: ../verifUserSessionCtrl.php');
}
?>
