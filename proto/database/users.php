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
    return $stmt->fetch();
  }

  function usernameExists($username){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :user");
    $stmt->bindParam(":user", $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) === 0) {
      return false;
    }
    return true;
  }

  function isInventoryManager($username){
    global $conn;
    $user = getUserByUsername($username);
    if($user === false)
      return false;
    if($user['type'] == 'InventoryManager'){
      return true;
    }else{
      return false;
    }
  }

  function getUserByUsername($username){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users where username = :username");
    $stmt->bindParam(":username", $username,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if(count($restult) ===0){
      return false;
    }
    return $result[0];
  }
?>
