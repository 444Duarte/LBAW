<?php
  
  function createClient($email, $username, $password) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users(email,username,password,type) VALUES (?, ?, ?,'Client')");
    $stmt->execute(array($username, $email, sha1($password)));
    return true;
  }

  function isLoginCorrect($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM users 
                            WHERE username = ? AND password = ?");
    $stmt->execute(array($username, $password));
    return $stmt->fetch() == true;
  }

  public function usernameExists($username){
    
  }
?>
