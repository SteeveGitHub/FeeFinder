<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../../styles/index.css">
</head>
<body>
<div class="burger-container">
<input type="checkbox" onclick="triggerMenu()" role="button" aria-label="Display the menu" class="menu">
<nav class="navbar-not-opened" id="navbar">
    <div class="menu-toggle" id="menuToggle">
        <a href="#" class="logo">
            <img class="logo-img" src="../../assets/images/LogoFeeFinder.png" alt="">
        </a>
    </div>
    <ul class="nav-links">
        <li><a href="../../controllers/accueil/accueilCtrl.php"><i class="fas fa-house-user"></i>Home</a></li>
        <li><a href="../../controllers/accueil/expensesCtrl.php"><i class="fas fa-address-card"></i>Expenses</a></li>
        <li><a href="../../controllers/accueil/reportCtrl.php"><i class="fas fa-lock"></i>Reports</a></li>
        <li><a href="../../controllers/accueil/insightCtrl.php"><i class="fas fa-sheet-plastic"></i>Insights</a></li>
        <li><a href="../../controllers/accueil/contactCtrl.php"><i class="fas fa-address-book"></i>Contact</a></li>
        <div class="active"></div>
    </ul>
</nav>
</div>
</body>
<script>
    let navbar = document.getElementById("navbar");
    let navbarClassname = "navbar-not-opened";

    function triggerMenu() {
        if (navbar.className === navbarClassname) {
            navbar.classList.add("navbar-opened");
            navbar.classList.remove("navbar-not-opened");
        } else {
            navbar.classList.add("navbar-not-opened");
            navbar.classList.remove("navbar-opened");
        }
    }
</script>
</html>
