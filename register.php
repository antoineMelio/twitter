<?php
  require("functions.php");

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
        add_user($_POST["email"], $_POST["password"]);
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

  <form action="register.php" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">

    <button type="submit">Créer mon compte</button>
  </form>

</body>
</html>
