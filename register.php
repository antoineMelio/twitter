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

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <!-- utile pour le responsive -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- titre de la page -->
  <title>Mon super titre</title>
  <!-- lien vers le fichier de style CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- le contenu de votre site -->
  <h1>S'inscrire</h1>

  <!-- on affiche les erreurs s'il y en a -->
  <ul class="errors">
    <?php
      for($i = 0; $i < count($errors); $i++) {
        ?>

        <li><?php echo $errors[$i]; ?></li>

        <?php
      }
    ?>
  </ul>

  <div class="register">
    <h2>S'inscrire</h2>
    <form action="register.php" method="post">
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>

        <label for="username">@</label>
        <input type="text" id="username" name="username">

        <label for="biography">Bio</label>
        <textarea id="biography" name="biography"></textarea>

        <button type="submit">Suivant</button>
    </form>
</div>

</body>
</html>
