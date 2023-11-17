<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../../styles/index.css">
   
</head>
<body class="content-and-nav">
    <div class="burger-container">
        <img id="burger-icon" src="../../assets/images/hamburger.png" alt="Burger Icon" onclick="toggleBurger()">
<nav class=`${classname}` >
    <a href="#" class="logo">
        <img class="logo-img" src="../../assets/images/LogoFeeFinder.png" alt="feefinderlogo">
    </a>
    <ul class="nav-links">
        <li><a href="../../controllers/accueil/accueilCtrl.php"><i class="fa-solid fa-house-user"></i>Home</a></li>
        <li><a href="../../controllers/accueil/expensesCtrl.php"><i class="fa-solid fa-address-card"></i>Expenses</a></li>
        <li><a href="../../controllers/accueil/reportCtrl.php"><i class="fa-solid fa-lock"></i>Reports</a></li>
        <li><a href="../../controllers/accueil/insightCtrl.php"><i class="fa-solid fa-sheet-plastic"></i>Insights</a></li>
        <li><a href="../../controllers/accueil/contactView.php"><i class="fa-solid fa-address-book"></i>Contact</a></li>
        <div class="active"></div>
    </ul>
</nav>
</div>
<script>
    const nav = document.querySelector('nav');
    nav.className = "navbar-closed";
    let classname = "";
        let isOpen = false;
        function toggleBurger() {
    if (isOpen) {
        isOpen = false;
        classname = "navbar-closed";
    } else {
        isOpen = true;
        classname = "navbar-open";
    }
    nav.className = classname;
}
    </script>
</body>
</html>
