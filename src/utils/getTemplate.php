<?php
function getTemplate($pageType) {
    ob_start();
    include(__DIR__ . '/../views/navbar/navbarView.php');
    $navbar = ob_get_clean();

    ob_start();
    include($pageType);
    $content = ob_get_clean();

    ob_start();
    include(__DIR__ . '/../views/connexion/logoutView.php');
    $logout = ob_get_clean();

    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeeFinder ©</title>
    <link href="../styles/index.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/384fab6fc8.js" crossorigin="anonymous"></script>
</head>
<body>
    $navbar
    <main class="container">
        $content
    </main>
    $logout
</body>
</html>
HTML;
}
?>
