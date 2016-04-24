<?
  if (!isset($_POST['username'])) die('No username given');
	
  include_once('../database/users.php'); 
  

  try {
    $user = usernameExists($_POST['username']);
    global $response
    if ($user === false){
      $response = {false, "username does not exist"};
      echo json_encode($response);
    }
    else if ($user === true){
      $response = {true, "username exists"};
      echo json_encode($response);
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
?>