<?php 

include_once('../../config/init.php');

if(isset($_SESSION['username'])){
	session_destroy();
}

header('Location: ' . $BASE_URL);