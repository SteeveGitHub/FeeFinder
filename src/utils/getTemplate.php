<?php
function getTemplate($pageType) {

    ob_start();
    include(__DIR__ . '/../views/accueil/navbarView.php');
    $navbar = ob_get_clean();

    ob_start();
    include($pageType);
    $content = ob_get_clean();

    $template = <<<HTML
    <!DOCTYPE html>
    <html>
    <head>
        <title>Votre Titre</title>
    </head>
    <body>
        $navbar
        <main class="content">
            $content
        </main>
    </body>
    </html>
HTML;

    return $template;
}
?>