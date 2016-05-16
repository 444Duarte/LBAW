<?php
  
  function createUser($email, $username, $password,$type) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users(email,username,password,type) VALUES (?, ?, ?,?)");
    $result = $stmt->execute(array($email, $username, crypt($password),$type));
    return $result;
  }

  function createClient($email, $username, $password,$id_card,$address,$phone){

    global $conn;
    try{
      $conn->beginTransaction();
      $stmt = $conn->prepare(
        'SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;');
      
      if(!$stmt)
        return false;
      $stmt1->execute();
      
      $stmt2 = $conn->prepare("INSERT INTO users(email,username,password,type) VALUES (?, ?, ?,?) RETURNING id");

      if(!$stmt2)
        return false;

      $stmt2->execute(array($email, $username, crypt($password),$type));

      $result2 = $stmt2->fetch();
      $id = $result2['id'];

      $stmt3 = $conn->prepare("INSERT INTO clients(id,id_card,address,phone_number) VALUES (?, ?, ?, ?)");

      if (!$stmt3)
        return false;

      $stmt3->execute(array($id, $id_card,$address,strval($phone)));

      $conn->commit();

      return true; 
    }catch(PDOException $e) {
      $conn->rollback();
      echo $e->$getMessage();
      exit();
    }
       
  }

  function isLoginCorrect($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM users 
                            WHERE username = ? AND password = ?");
    $stmt->execute(array($username, crypt($password)));
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
