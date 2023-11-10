<?php
session_start();
include(__DIR__ . '../../../utils/getTemplate.php');

if (isset($_SESSION['status'])) {
    getTemplate("../../views/accueil/expensesView.php");
} else {
    header('Location: ../verifUserSessionCtrl.php');
}
?>
