<?php
  
  function createUser($email, $username, $password) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users VALUES (?, ?, ?)");
    $stmt->execute(array($username, $email, sha1($password)));
  }

  function isLoginCorrect($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM users 
                            WHERE username = ? AND password = ?");
    $stmt->execute(array($username, $password));
    return $stmt->fetch() == true;
  }
?>
