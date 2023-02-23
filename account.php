<?php
  // on démarre la session
  // sinon, on n'aurait pas accès à $_SESSION
  session_start();

  // si pas de session utilisateur, c'est qu'il n'est pas connecté
  if(empty($_SESSION["user"])) {
    // donc on redirige vers la page de login
    // header("Location: login.php");

    // die permet d'arrêter l'exécution de ce script
    die();
  }

  // on copie la session dans $user
  // c'est plus pratique car plus court
  $user = $_SESSION["user"];

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
  <h1>Bienvenue <?php echo $user["email"]; ?> !</h1>
</body>
</html>
