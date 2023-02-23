<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer le contenu du tweet soumis par le formulaire
  $tweet = $_POST['tweet'];

  // Afficher le tweet sur la page
  echo '<div class="tweet">' . $tweet . '</div>';
}
?>
