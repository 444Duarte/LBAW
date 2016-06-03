<?php
	if(!isset($username)){
		$_SESSION['error_messages'][] = 'Invalid Access';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}