<?php
function getTemplate($pageType) {

    ob_start();
    include(__DIR__ . '/../views/accueil/navbarView.php');
    $navbar = ob_get_clean();

    ob_start();
    include($pageType);
    $content = ob_get_clean();

    ob_start();
    include (__DIR__ . '/../views/connexion/logoutView.php');
    $logout = ob_get_clean();

    $template = <<<HTML
    <!DOCTYPE html>
    <html>
    <body>
        $navbar
        <main class="content">
            $content
        </main>
        $logout
    </body>
    </html>
HTML;

    return $template;
}
?>