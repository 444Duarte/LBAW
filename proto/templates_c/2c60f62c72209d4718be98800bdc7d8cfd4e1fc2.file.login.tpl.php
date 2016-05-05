<?php /* Smarty version Smarty-3.1.15, created on 2016-04-25 14:48:37
         compiled from "/opt/lbaw/lbaw1533/public_html/proto/templates/auth/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:954893335571cbb85893233-46314462%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c60f62c72209d4718be98800bdc7d8cfd4e1fc2' => 
    array (
      0 => '/opt/lbaw/lbaw1533/public_html/proto/templates/auth/login.tpl',
      1 => 1461588508,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '954893335571cbb85893233-46314462',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_571cbb85947f65_11828006',
  'variables' => 
  array (
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571cbb85947f65_11828006')) {function content_571cbb85947f65_11828006($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
    <title>ToolBox Login</title>
  	<link href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
lib/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
css/lavish-bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
css/login.css">
	</head>

	<body>
		<div>
			<form id="login_form" class="generic-element" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/auth/validate_login.php" method="post">
				<div>
					<img class="login_entity" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/res/User_Avatar-64.png">
					<input class="login_entity" class= type="text" name="username" placeholder="Username ex: up203012345">
				</div>
				<br>
				<div>
					<img class="login_entity" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/res/Key_icon_64.png">
					<input class="login_entity" type="password" name="password" placeholder="Password">
				</div>
				<br>
				<div id="login_options">
					<a href="">Forgot your password?</a>
					<a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/auth/signup.php">Not a member?</a>
				</div>

				<input type="submit" value="Login">
			</form>
		</div>
	</body>	

</html><?php }} ?>
