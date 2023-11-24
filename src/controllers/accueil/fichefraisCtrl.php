<?php
session_start();

if (isset($_SESSION['status'])) {
    
    header('Location: ../../views/frais/selectionCasFraisView.php');

} else {
    header('Location: ../verifUserSessionCtrl.php');
}
