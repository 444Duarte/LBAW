<?
  if (!isset($_POST['username'])) die('No username given');
	
  include_once('../database/users.php'); 
  

  try {
    $user = usernameExists($_POST['username']);
    if ($user === false){
      $response = array("false", "username does not exist");
      echo json_encode($response);
    }
    else if ($user === true){
      $response = array("true", "username exists");
      echo json_encode($response);
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
?>