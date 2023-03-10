<?php

require_once('db.php');

function check_member_exists($conn, $email) {
  $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  return $result->num_rows > 0;
}

function login($conn, $email, $password) {
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

function postTweet($conn, $userid, $content) {
    $stmt = $conn->prepare("INSERT INTO tweets (user_id, content) VALUES (?, ?)");
    $stmt->bind_param("is", $userid, $content);
    $stmt->execute();
    $stmt->close();
}








function getTweetsByUserId($conn, $user_id) {
  $stmt = $conn->prepare("SELECT * FROM tweets WHERE user_id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  return $result->fetch_all(MYSQLI_ASSOC);
}

function getUserById($conn, $user_id) {
  $stmt = $conn->prepare("SELECT * FROM user WHERE id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->fetch_assoc();
}

