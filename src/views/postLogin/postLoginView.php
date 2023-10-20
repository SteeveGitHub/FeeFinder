<?php
    include '../../utils/getTemplate.php';
session_start();
    if (isset($_SESSION['status'])) {
        if ($_SESSION['status'] === "1"){
            echo getTemplate('../accueil/accueilView.php');
        } else if($_SESSION['status'] === "2"){
            echo getTemplate('../admin/adminView.php');
        } else if($_SESSION['status'] === "3"){
            echo getTemplate('../comptable/comptableView.php');
        }
    } else {
        echo getTemplate('../accueil/accueilView.php');
    }
?>