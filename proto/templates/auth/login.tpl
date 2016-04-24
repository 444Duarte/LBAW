<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
    <title>ToolBox Login</title>
  	<link href="{$BASE_URL}lib/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{$BASE_URL}css/lavish-bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="{$BASE_URL}css/login.css">
	</head>

	<body>
		<div>
			<form id="login_form" class="generic-element" action="{$BASE_URL}actions/auth/validate_login.php" method="post">
				<div>
					<img class="login_entity" src="{$BASE_URL}images/res/User_Avatar-64.png">
					<input class="login_entity" class= type="text" name="username" placeholder="Username ex: up203012345">
				</div>
				<br>
				<div>
					<img class="login_entity" src="{$BASE_URL}images/res/Key_icon_64.png">
					<input class="login_entity" type="password" name="password" placeholder="Password">
				</div>
				<br>
				<div id="login_options">
					<a href="">Forgot your password?</a>
					<a href="{$BASE_URL}pages/auth/signup.php">Not a member?</a>
				</div>

				<input type="submit" value="Login">
			</form>
		</div>
	</body>	

</html>