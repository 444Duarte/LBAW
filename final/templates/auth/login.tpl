{extends file="common/main.tpl"}

{block name="title"} ToolBox Login {/block}
{block name="css" append}
  	<link rel="stylesheet" type="text/css" href="css/auth/login.css">
{/block}
{block name="content"}
		<div>
			<form id="login_form" class="generic-element" action="actions/auth/login.php" method="post">
				<div>
					<img class="login_entity" src="images/res/User_Avatar-64.png" alt="user label icon">
					<input class="login_entity" type="text" name="username" placeholder="Username ex: up203012345" required>
				</div>
				<br>
				<div>
					<img class="login_entity" src="images/res/Key_icon_64.png" alt="password label icon">
					<input class="login_entity" type="password" name="password" placeholder="Password" required>
				</div>
				<br>
				<div id="login_options">
					<a href="">Forgot your password?</a>
					<a href="{$BASE_URL}pages/auth/signup.php">Not a member?</a>
				</div>

				<input type="submit" value="Login">
			</form>
		</div>
{/block}