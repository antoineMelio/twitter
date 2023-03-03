<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Timeline - Twitter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="timeline.php" class="active">Timeline</a></li>
                <li><a href="profile.php">Profil</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="tweets">
            <?php foreach ($tweets as $tweet): ?>
                <div class="tweet">
                    <div class="tweet-info">
                        <span class="tweet-author"><?= $tweet['username'] ?></span>
                        <span class="tweet-date"><?= $tweet['date'] ?></span>
                    </div>
                    <div class="tweet-content"><?= $tweet['content'] ?></div>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
</body>
</html>
