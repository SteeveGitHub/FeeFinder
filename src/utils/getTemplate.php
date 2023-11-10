<?php
function getTemplate($pageType) {

    ob_start();
    include(__DIR__ . '/../views/navbar/navbarView.php');
    $navbar = ob_get_clean();

    ob_start();
    include($pageType);
    $content = ob_get_clean();

    ob_start();
    include (__DIR__ . '/../views/connexion/logoutView.php');
    $logout = ob_get_clean();

    return compact('navbar', 'content', 'logout');
}
?>
