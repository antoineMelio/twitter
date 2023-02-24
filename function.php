<?php

function check_member_exists($email) {
  global $conn;

  $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  return $result->num_rows > 0;
}

function login($email, $password) {
  global $conn;

  $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows === 1) {
    return $result->fetch_assoc();
  } else {
    return false;
  }
}

function postTweet($user_id, $tweet) {
  global $conn;

  $stmt = $conn->prepare("INSERT INTO tweets (user_id, tweet) VALUES (?, ?)");
  $stmt->bind_param("is", $user_id, $tweet);
  $stmt->execute();
}

function getUserById($conn, $user_id) {
  $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->bind_param("i", intval($user_id)); // convertir en entier
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->fetch_assoc();
}

