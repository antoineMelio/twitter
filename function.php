<?php
// le 'once' permet de ne pas réimporter db.php si jamais il a déjà été importé avant
require_once("db.php");

/**
 * Connecte l'utilisateur
 */
function login($email) {
  global $db;

  $q = $db->prepare("SELECT email, password FROM user WHERE email = :email");
  
  $q->bindParam(":email", $email);

  $q->execute();

  $user = $q->fetch();

  // si ce n'est pas le bon mot de passe, on retourne faux
  if(!password_verify($_POST["password"], $user["password"])) {
    return false;
  }

  // sinon, on retourne le $user
  // cela permettra de le stocker dans la $_SESSION
  return $user;
}

/**
 * Crée un utilisateur
 */
function add_user($email, $password) {
  global $db;

  $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

  $q = $db->prepare("INSERT INTO user(email, password) VALUES(:email, :password)");
  
  $q->bindParam(":email", $email);
  $q->bindParam(":password", $encrypted_password);

  $q->execute();
}

/**
 * Vérifie si le compte existe déjà
 */
function check_member_exists($email) {
  global $db;

  $q = $db->prepare("SELECT id FROM user WHERE email = :email");
  
  $q->bindParam(":email", $email);

  $q->execute();

  // rowCount retourne le nombre de résultats retournés par la requête 
  return $q->rowCount() > 0;
}
?>