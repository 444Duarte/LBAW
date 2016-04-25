<?php
  
  function createClient($email, $username, $password) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users(email,username,password,type) VALUES (?, ?, ?,'Client')");
    $stmt->execute(array($email, $username, sha1($password)));
    return true;
  }

  function isLoginCorrect($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM users 
                            WHERE username = ? AND password = ?");
    $stmt->execute(array($username, sha1($password)));
    return $stmt->fetch() == true;
  }

  function usernameExists($username){
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = :user');
    $stmt->bindParam(':user', $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) === 0) {
      return false;
    }
    return true;
  }

  function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }
?>
