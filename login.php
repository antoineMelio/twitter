<?php
  require_once("db.php");
  require_once("function.php");

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
          $_SESSION["user_id"] = $user['id'];
          header("Location: profile.php");
          exit;
        } else {
          array_push($errors, "Mauvais email / mot de passe.");
        }
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
  <h1>Se connecter</h1>

  <ul class="errors">
    <?php
      for($i = 0; $i < count($errors); $i++) {
        ?>

        <li><?php echo $errors[$i]; ?></li>

        <?php
      }
    ?>
  </ul>

  <form action="login.php" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">

    <button type="submit">Se connecter</button>
  </form>

</body>
</html>
