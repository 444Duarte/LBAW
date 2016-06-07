{extends file="common/main.tpl"}
{block name="title"} Toolbox Signup {/block}
{block name="css" append}
	<link rel="stylesheet" type="text/css" href="css/auth/signup.css">
{/block}
{block name="content"}
	<div>
		<form id="signup_form" class="generic-element" action="actions/auth/register.php" method="post">
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
{/block}
{block name="js-code"}
	{if $ERROR_MESSAGES != NULL}
		<script>alert('{$ERROR_MESSAGES[0]}');</script>
	{/if}
{/block}
{block name="js" append}
	<script type="text/javascript" src="javascript/auth/signup.js"></script>
{/block}