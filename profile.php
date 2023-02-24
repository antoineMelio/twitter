<?php 
require_once('db.php');
require_once('function.php');

session_start();

if(!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

$user_id = $_SESSION['user_id'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_POST['tweet']) && $_POST['tweet'] !== '') {
    $tweet = htmlspecialchars($_POST['tweet'], ENT_QUOTES);
    postTweet($conn, $user_id, $tweet);
    header('Location: profile.php');
    exit;
  }
}

$tweets = $conn->query("SELECT * FROM tweets WHERE user_id = '{$_SESSION['user_id']}' ORDER BY date DESC");
$user = getUserById($conn, $user_id);

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Twitter Clone - Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="container">
      <h1>Profile</h1>
      <p>Welcome, <?php echo $user['username']; ?>!</p>
      <form method="post">
        <label for="tweet">What's happening?</label>
        <input type="text" name="tweet" id="tweet">
        <button type="submit">Tweet</button>
      </form>
      <h2>Tweets</h2>
      <?php while($tweet = mysqli_fetch_assoc($tweets)): ?>
        <div class="tweet">
          <div class="content">
            <p><?php echo $tweet['tweet']; ?></p>
            <small><?php echo $tweet['date']; ?></small>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </body>
</html>
