<?php
require_once('db.php');
require_once('function.php');

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Traitement du formulaire de tweet
if (isset($_POST['tweet']) && !empty($_POST['tweet'])) {
    $tweet = htmlspecialchars($_POST['tweet'], ENT_QUOTES);
    postTweet($conn, $user_id, $tweet);
    header('Location: profile.php');
    exit;
}

// Récupération des tweets de l'utilisateur connecté
$tweets = getTweetsByUserId($conn, $user_id);

// Récupération des informations de l'utilisateur connecté
$user = getUserById($conn, $user_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Twitter Clone - Profil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    <h1>Profil</h1>
    <p>Bienvenue, <?php echo $user['username']; ?>!</p>

    <!-- Formulaire de tweet -->
    <form method="post">
        <label for="tweet">Quoi de neuf?</label>
        <input type="text" name="tweet" id="tweet">
        <button type="submit">Tweeter</button>
    </form>

    <h2>Tweets</h2>

    <?php foreach ($tweets as $tweet) { ?>
        <div class="tweet">
            <div class="content">
                <p><?php echo $tweet['tweet']; ?></p>
                <small><?php echo $tweet['date']; ?></small>
            </div>
        </div>
    <?php } ?>
</div>
</body>
</html>
