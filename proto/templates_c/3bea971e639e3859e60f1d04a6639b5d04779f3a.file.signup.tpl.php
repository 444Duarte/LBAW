<?php /* Smarty version Smarty-3.1.15, created on 2016-04-25 14:49:58
         compiled from "/opt/lbaw/lbaw1533/public_html/proto/templates/auth/signup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:304091517571bd1ce5d7860-45611513%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3bea971e639e3859e60f1d04a6639b5d04779f3a' => 
    array (
      0 => '/opt/lbaw/lbaw1533/public_html/proto/templates/auth/signup.tpl',
      1 => 1461588508,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '304091517571bd1ce5d7860-45611513',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_571bd1ce68cc50_49746999',
  'variables' => 
  array (
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571bd1ce68cc50_49746999')) {function content_571bd1ce68cc50_49746999($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
    <title>ToolBox Signup</title>
  	<link href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
lib/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
css/lavish-bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
css/signup.css">
	</head>

	<body>
		<div>
			<form id="signup_form" class="generic-element" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/auth/validate_register.php" method="post">
				<h1 class="form_name">Register</h1>
				<br>Username<br>
				<input type="text" name="username" id="username" required>	
				<br>Email<br>
				<input type="email" name="email" required>

				<br><br>Password<br>
				<input type="password" name="password" required>
				<br>Confirm Password<br>
				<input type="password" name="confirm_password" required>


				<input type="submit" value="Register">
			</form>
		</div>
		<script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
lib/jquery-1.12.1.min.js"></script>
		<script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
javascript/auth/signup.js"></script>
	</body>	

</html><?php }} ?>
