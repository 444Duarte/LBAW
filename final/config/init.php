<?php
  session_set_cookie_params(3600, '/~lbaw1533');
  session_start();

  error_reporting(E_ALL); 

  $BASE_LINK = 'https://gnomo.fe.up.pt';
  $BASE_DIR = '/opt/lbaw/lbaw1533/public_html/final/'; 
  $BASE_URL = '/~lbaw1533/final/'; 

  $conn = new PDO('pgsql:host=dbm;dbname=lbaw1533', 'lbaw1533', 'VN12B1N7'); 
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $conn->exec('SET SCHEMA \'public\''); 

  include_once($BASE_DIR . 'lib/smarty/Smarty.class.php');
  
  $smarty = new Smarty;
  $smarty->template_dir = $BASE_DIR . 'templates/';
  $smarty->compile_dir = $BASE_DIR . 'templates_c/';
  $smarty->assign('BASE_URL', $BASE_URL);

  $existing = $smarty->getPluginsDir();
  $existing[] = getcwd() . '/plugins';
  $smarty->setPluginsDir($existing);

  $username = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
  $userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : NULL;
  
  $smarty->assign('ERROR_MESSAGES', isset($_SESSION['error_messages']) ? $_SESSION['error_messages'] : NULL);  
  $smarty->assign('FIELD_ERRORS', isset($_SESSION['field_errors']) ? $_SESSION['field_errors'] : NULL);
  $smarty->assign('SUCCESS_MESSAGES', isset($_SESSION['success_messages']) ? $_SESSION['success_messages'] : NULL);
  $smarty->assign('FORM_VALUES', isset($_SESSION['form_values']) ? $_SESSION['form_values'] : NULL);
  $smarty->assign('USERNAME', $username);
  $smarty->assign('USER_TYPE', $userType);
  
  unset($_SESSION['success_messages']);
  unset($_SESSION['error_messages']);  
  unset($_SESSION['field_errors']);
  unset($_SESSION['form_values']);