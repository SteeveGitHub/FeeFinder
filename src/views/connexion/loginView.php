<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FeeFinder - Login Page</title>
    <link href="../../styles/index.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=News+Cycle:wght@400;700&display=swap" rel="stylesheet">
  </head>
  <body>
  <main class="main-login">
    <section class="login-container">
    <h3>Bienvenue sur FeeFinder !</h3>
    <form action="../../models/connexion/login.php" method="post">
      <label for="email">Adresse email :</label>
        <input type="email" name="email" class="email" id="email" placeholder="...email"/>
      <label for="password">Mot de passe :</label>
      <input type="password" name="password" class="password" id="password" placeholder="...mot de passe"/>
     <button type="submit" class="button">connexion</button>
    </form>
  <div><button class="button"><a href="../inscription/registerView.php">S'inscrire</a></button></div>
    </section>
  </main>
  </body>
</html>
