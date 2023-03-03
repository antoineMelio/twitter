<?php
require_once('db.php');
require_once('function.php');

session_start();

$errors = array();
if(!empty($_POST)) {
  if(empty($_POST["email"]) || empty($_POST["password"])) {
    array_push($errors, "Merci de remplir tous les champs.");
  }

  if(!empty($_POST["email"]) && !empty($_POST["password"])) {
    if(!check_member_exists($_POST["email"])) {
      array_push($errors, "Ce compte n'existe pas.");
    }
    else {
      $user = login($_POST["email"], $_POST["password"]);

      if($user) {
        $_SESSION["user_id"] = $user["id"];
        header("Location: profile.php");
        exit;
      } else {
        array_push($errors, "Mauvais email / mot de passe.");
      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Twitter Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Twitter Clone</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="profile.php">Profil</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Connexion</h2>
        <form action="login.php" method="POST">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Se connecter">
        </form>
    </main>
</body>
</html>

