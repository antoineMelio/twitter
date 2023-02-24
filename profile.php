<?php
require("function.php");
require_once("db.php");
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

try {
    $db = new PDO("mysql:host=localhost;dbname=twitter;", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}

$user_id = $_SESSION['user']['id'];

$query = "SELECT * FROM user WHERE id = :user_id LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();

$user = $stmt->fetch();

if (!$user) {
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Twitter - Profil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>Twitter</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <div class="profile">
        <h2>Profil de <?= $user['email'] ?></h2>
        <p>Nom : <?= $user['name'] ?></p>
        <p>@<?= $user['username'] ?></p>
        <p>Bio : <?= $user['biography'] ?></p>
    </div>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <textarea name="tweet" rows="3" cols="30"></textarea>
        <br>
        <input type="submit" value="Publier le tweet">
    </form>

<?php

// Traitement du formulaire de publication de tweet
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer le contenu du tweet soumis par le formulaire
  $tweet = $_POST['tweet'];

  // Enregistrer le tweet dans la base de données
  $stmt = $db->prepare("INSERT INTO tweets (content) VALUES (:tweet)");
  $stmt->bindParam(':tweet', $tweet);
  if ($stmt->execute()) {
    echo "Tweet publié avec succès";
  } else {
    echo "Erreur lors de la publication du tweet.";
  }
}

// Récupérer tous les tweets de la base de données
$stmt = $db->prepare("SELECT * FROM tweets ORDER BY id DESC");
$stmt->execute();
$tweets = $stmt->fetchAll();

// Afficher tous les tweets sur la page
foreach ($tweets as $tweet) {
  echo '<div class="tweet">' . $tweet["content"] . '</div>';
}

// ALTER TABLE tweets ADD  FOREIGN KEY (user_id) REFERENCES user(id)

?>

</body>
</html>
