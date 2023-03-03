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
    $tweet_content = $_POST['tweet'];
    postTweet($conn, $user_id, $tweet_content);
    header('Location: profile.php');
    exit;
}


// Récupération des tweets de l'utilisateur connecté
$tweets = getTweetsByUserId($conn, $user_id);

// Récupération des informations de l'utilisateur connecté
$user = getUserById($conn, $user_id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil - Twitter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="timeline.php">Timeline</a></li>
                <li><a href="profile.php" class="active">Profil</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="profile-info">
            <h1><?= $user['

