<?php
session_start();

// destroy session to deconnect the user
session_destroy();
header("Location: loginView.php");
exit();
