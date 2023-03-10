<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Twitter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php" class="active">Accueil</a></li>
                <li><a href="timeline.php">Timeline</a></li>
                <li><a href="profile.php">Profil</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form method="post" action="post_tweet.php">
            <textarea name="tweet" id="tweet" placeholder="Exprimez-vous..."></textarea>
            <button type="submit">Tweeter</button>
        </form>
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
