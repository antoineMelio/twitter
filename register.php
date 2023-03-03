<?php
  require("function.php");

  // on crée un tableau d'erreur
  // cela nous permettra de les afficher ensuite dans le HTML
  // s'il y en a
  $errors = array();

  // si on a bien envoyé le formulaire
  if(!empty($_POST)) {
    // cas où il manque un champs
    if(empty($_POST["email"]) || empty($_POST["password"])) {
      array_push($errors, "Merci de remplir tous les champs.");
    }
    else {
      // cas où le compte existe déjà
      if(check_member_exists($_POST["email"])) {
        array_push($errors, "Un compte avec cet email existe déjà.");
      }
      else {
        // cas où on peut créer le compte
        add_user($_POST["email"], $_POST["password"], $_POST["name"], $_POST["username"], $_POST["biography"]);
        header("Location: login.php");
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Twitter Clone</title>
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
        <h2>Inscription</h2>
        <form action="register.php" method="POST">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="S'inscrire">
        </form>
    </main>
</body>
</html>
