<?php
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
        <p>Twitter : <?= $user['username'] ?></p>
        <p>Bio : <?= $user['biography'] ?></p>
    </div>
</body>
</html>
