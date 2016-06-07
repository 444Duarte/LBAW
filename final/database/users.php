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
      $stmt1 = $conn->prepare(
        'SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;');
      
      if(!$stmt1)
        throw new PDOException("Error Processing Request", 1);
        
      $stmt1->execute();
      
      $stmt2 = $conn->prepare("INSERT INTO users(email,username,password,type) VALUES (?, ?, ?, 'Client') RETURNING id");

      if(!$stmt2)
        throw new PDOException("Error Processing Request", 1);

      $result2 = $stmt2->execute(array($email, $username, crypt($password)));
      
      if(!$result2)
        throw new PDOException("Error Processing Request", 1);

      $result2 = $stmt2->fetch();
      $id = $result2['id'];

      $stmt3 = $conn->prepare("INSERT INTO clients(id,id_card,address,phone_number) VALUES (?, ?, ?, ?)");

      if (!$stmt3)
        throw new PDOException("Error Processing Request", 1);

      $result3 = $stmt3->execute(array($id, $id_card,$address,strval($phone)));
      if(!$result3)
        throw new PDOException("Error Processing Request", 1);

      $conn->commit();

      return true; 
    }catch(PDOException $e) {
      $conn->rollback();
      echo $e->getMessage();
      return false;
    }
  }

  function createInventoryManager($email, $username, $password){
    return createUser($email, $username, $password,'InventoryManager');
  }

  function getAllUsers($start, $nUsers, $banned){
    global $conn;
    $stmt = $conn->prepare(
      "SELECT users.id as id, users.username AS username, users.type AS type FROM users
       LEFT JOIN blocked_users
        ON users.id = blocked_users.id
        WHERE blocked_users.id IS " . ($banned? "NOT" : "") . " NULL
        ORDER BY username
        LIMIT ?
        OFFSET ?;"
      );
    $stmt->bindValue(1, $nUsers, PDO::PARAM_INT);
    $stmt->bindValue(2, $start, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }

  function isUserBanned($username){
    global $conn;
    $stmt = $conn->prepare(
      "SELECT 1 FROM blocked_users, users WHERE blocked_users.id = users.id AND users.username = ?"
      );
    $stmt->bindValue(1, $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    if ($result !== FALSE)
      return TRUE;
    return $result;
  }

  function getUserCount($banned){
    global $conn;
    $stmt = $conn->prepare(
      "SELECT COUNT(*) AS count FROM users
      LEFT JOIN blocked_users
        ON users.id = blocked_users.id
        WHERE blocked_users.id IS " . ($banned? "NOT" : "") . " NULL");
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['count'];
  }

  function isLoginCorrect($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT password
                            FROM users 
                            WHERE username = ?");
    $stmt->execute(array($username));
    $pass = $stmt->fetch()['password'];

    if ($pass == NULL){
      return false;
    }
    
    return crypt($password, $pass) == $pass;

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
    $result = $stmt->fetch();
    if(count($result) ===0 || $result == NULL){
      return false;
    }
    return $result;   
  }

  function getClientByUsername($username){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users where username = :username");
    $stmt->bindParam(":username", $username,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if(count($result) ===0){
      return 'user does not exist';
    }
    $id = $result[0]['id'];
    
    $stmt2 = $conn->prepare("SELECT * FROM clients where id = :id");
    $stmt2->bindParam(":id", $id,PDO::PARAM_INT);
    $stmt2->execute();
    $client = $stmt2->fetchAll();
    if(count($client) === 0){
      return 'client does not exist';
    }
    return $client[0];
  }

  function changeEmail($username, $newEmail){
    global $conn;
    $stmt = $conn->prepare("UPDATE users SET email = :email where username = :username");
    $stmt->bindParam(":username", $username,PDO::PARAM_STR);
    $stmt->bindParam(":email", $newEmail,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if(count($result) ===0){
      return false;
    }
    return $result[0];
  }

  function changePassword($newPassword, $username){
    global $conn;
    $stmt = $conn->prepare("UPDATE users SET password = :password where username = :username");
    $stmt->bindParam(":username", $username,PDO::PARAM_STR);
    $stmt->bindParam(":password", crypt($newPassword),PDO::PARAM_STR);
    return $stmt->execute();
  }

  function changePasswordByMail($newPassword, $email){
    global $conn;
    $stmt = $conn->prepare("UPDATE users SET password = :password WHERE email = :email");
    $stmt->bindParam(":email", $email,PDO::PARAM_STR);
    $stmt->bindParam(":password", crypt($newPassword),PDO::PARAM_STR);
    return $stmt->execute();
  }

  function getUserBookings($username){
    global $conn;
    
    $stmt = $conn->prepare("SELECT items.name AS name, categories.name AS category, subcategories.name AS subcategory,reservations.start_time AS start_date, reservations.end_time AS end_date,  reservations.id AS id
        FROM categories, subcategories, items, item_instances, reservations, users
        WHERE users.username = :user AND users.id = reservations.id_client AND 
              reservations.id_item_instance = item_instances.id AND item_instances.id_item = items.id AND
              items.id_subcategory = subcategories.id AND subcategories.id_category = categories.id");
    $stmt->bindParam(":user", $username,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    if(count($result) ===0){
      return false;
    }
    return $result;  
  }

  function getUserHistory($username, $limit, $offset){
    global $conn;
    
    $stmt = $conn->prepare("SELECT items.name AS name, categories.name AS category, subcategories.name AS subcategory, item_history_records.date AS DATE, 
      item_history_records.type AS TYPE
      FROM items, item_instances, item_history_records, categories, subcategories, users, lend_records, return_records
      WHERE users.username = :USER AND users.id = lend_records.id_client AND lend_records.id = item_history_records.id
      AND item_history_records.id_item_instance = item_instances.id AND
      item_instances.id_item = items.id AND items.id_subcategory = subcategories.id AND subcategories.id_category = categories.id
      UNION
      SELECT items.name AS name, categories.name AS category, subcategories.name AS subcategory, item_history_records.date AS DATE, 
      item_history_records.type AS TYPE
      FROM items, item_instances, item_history_records, categories, subcategories, users, lend_records, return_records
      WHERE users.username = :USER AND users.id = return_records.id_client AND return_records.id = item_history_records.id
      AND item_history_records.id_item_instance = item_instances.id AND
      item_instances.id_item = items.id AND items.id_subcategory = subcategories.id AND subcategories.id_category = categories.id
      ORDER BY DATE DESC
      LIMIT :LIMIT
      OFFSET :offset;");
    $stmt->bindParam(":USER", $username,PDO::PARAM_STR);
    $stmt->bindParam(":LIMIT", $limit,PDO::PARAM_INT);
    $stmt->bindParam(":offset", $offset,PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    if(count($result) ===0){
      return false;
    }
    return $result; 
  }


  function getUserHistoryCount($id){
    global $conn;
    $stmt = $conn->prepare(
      "SELECT COUNT(*) AS count FROM lend_records, return_records WHERE lend_records.id_client = :id AND return_records.id_client = :id;");
    $stmt->bindParam(":id", $id,PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['count'];
  }

  function getUserType($username){
    return getUserByUsername($username)['type'];
  }

  function inventoryManagerPreRegister($email){
    global $conn;
    $hash = sha1($email);
    $type = 'InventoryManager';

    $stmt = $conn->prepare("INSERT INTO pre_registers(email,type,hash) VALUES (:email, :type, :hash)");
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":type", $type, PDO::PARAM_STR);
    $stmt->bindParam(":hash", $hash, PDO::PARAM_STR);
    $result = $stmt->execute();
    
    if(!$result){
      throw new Exception("Error Processing Request", 1);
    }

    return $hash;
  }

  function removeBooking($username, $id){

    global $conn;
    $stmt = $conn->prepare("SELECT id FROM users where username = :username");
    $stmt->bindParam(":username", $username,PDO::PARAM_STR);
    $stmt->execute();
    $idL = $stmt->fetchAll();
    if(count($idL) ===0){
      return false;
    }
    $idC = $idL[0]['id'];

    $stmt2 = $conn->prepare("DELETE FROM reservations WHERE id = :id AND id_client = :idC ");
    $stmt2->bindParam(":id", $id,PDO::PARAM_INT);
    $stmt2->bindParam(":idC", $idC,PDO::PARAM_INT);
    $stmt2->execute();
    $result = $stmt2->fetchAll();

    return $result;
  }

  function isValidHashPreRegister($hash){
    global $conn;
    $stmt = $conn->prepare("SELECT email FROM pre_registers where hash = :hash");
    $stmt->bindParam(":hash", $hash, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if(count($result) ===0){
      return false;
    }
    return $result[0]['email'];
  }

  function editBooking($id, $start, $end){
    global $conn;
    $stmt = $conn->prepare("UPDATE reservations SET start_time = :start , end_time = :end WHERE id = :id");
    $stmt->bindParam(":id", $id,PDO::PARAM_INT);
    $stmt->bindParam(":start", $start,PDO::PARAM_STR);
    $stmt->bindParam(":end", $end,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();
   
    return $result;
  }

  function getInstanceFromBookingID($id){
    global $conn;
    $stmt = $conn->prepare("SELECT id_item_instance FROM reservations WHERE reservations.id = :id");
    $stmt->bindParam(":id", $id,PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch()['id_item_instance'];
   
    return $result;
  }

  function getBookingsFromInstance($instance){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM reservations WHERE reservations.id_item_instance = :instance");
    $stmt->bindParam(":instance", $instance,PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
   
    return $result;
  }

  function bookItem($idClient, $itemInstance, $startDate, $endDate){
    global $conn;
    $stmt = $conn->prepare("INSERT INTO reservations (start_time,end_time,id_client,id_item_instance) VALUES (:start,:end,:client,:item)");
    $stmt->bindParam(":client", $idClient,PDO::PARAM_INT);
    $stmt->bindParam(":item", $itemInstance,PDO::PARAM_INT);
    $stmt->bindParam(":start", $startDate,PDO::PARAM_STR);
    $stmt->bindParam(":end", $endDate,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();

    return $result;
  }

  function blockUser($idUser, $note){
    global $conn;
    
    if($note == null){
      $stmt = $conn->prepare('INSERT INTO blocked_users(id) VALUES(:id);');
      $stmt->bindParam(":id", $idUser,PDO::PARAM_INT);
      return $stmt->execute();
    }else{
      $stmt = $conn->prepare('INSERT INTO blocked_users(id,note) VALUES(:id, :note);');
      $stmt->bindParam(":id", $idUser,PDO::PARAM_INT);
      $stmt->bindParam(":note", $note, PDO::PARAM_STR);
      return $stmt->execute();
    }
  }

  function reviveUser($idUser){
    global $conn;
    
    $stmt = $conn->prepare('DELETE FROM blocked_users 
                            WHERE id = :id ;');
    $stmt->bindParam(":id", $idUser,PDO::PARAM_INT);
    return $stmt->execute();
    
  }

  function getUserEmail($idUser){
    return getUser($idUser)['email'];
  }

  function getUser($idUser){
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM users where id = :id');
    $stmt->bindParam(":id", $idUser,PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
  }
