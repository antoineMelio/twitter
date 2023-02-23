<?php
  session_start();

  // détruit la session
  session_destroy();

  // et redirige vers login.php
  header("Location: login.php");
?>