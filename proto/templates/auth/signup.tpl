<html>
{include file='common/header.tpl'}
<link rel="stylesheet" type="text/css" href="{$BASE_URL}css/inventory/item_list.css">
  <head>
  	<meta charset="utf-8">
    <title>ToolBox Signup</title>
  	<link href="{$BASE_URL}lib/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{$BASE_URL}css/lavish-bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="{$BASE_URL}css/auth/signup.css">
	</head>

	<body>
		<div>
			<form id="signup_form" class="generic-element" action="{$BASE_URL}actions/auth/register.php" method="post">
				<h1 class="form_name">Register</h1>
				<br>Username<br>
				<input type="text" name="username" id="username" required>	
				<br>Email<br>
				<input type="email" name="email" required>
				<br>Password<br>
				<input type="password" name="password" required>
				<br>Confirm Password<br>
				<input type="password" name="confirm_password" required>
				<br><br>Identification Card<br>
				<input type="text" name="id_card" required>
				<br>Address<br>
				<input type="text" name="address" required>
				<br>Phone Number<br>
				<input type="number" name="phone" required>

				<input type="submit" value="Register">
			</form>
		</div>
		{if $ERROR_MESSAGES != NULL}
			<script>alert('{$ERROR_MESSAGES[0]}');</script>
		{/if}
		<script src="{$BASE_URL}lib/jquery-1.12.1.min.js"></script>
		<script src="{$BASE_URL}lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{$BASE_URL}javascript/auth/signup.js"></script>
	</body>	

</html>