{extends file="common/main.tpl"}
{block name="title"} ToolBox Signup {/block}
{block name="css" append}
	<link rel="stylesheet" type="text/css" href="css/auth/signup.css">
{/block}
{block name="content"}
	<div>
		<form id="signup_form" class="generic-element" action="actions/auth/register_non_clients.php" method="post" style="height: 26em; margin-top: -13em;">
			<h1 class="form_name">Register</h1>
			<br>Username<br>
			<input id="hash" type="hidden" name="hash" value="{$HASH}" required>
			<input type="text" name="username" id="username" required>	
			<br>Email<br>
			<input type="email" name="email" value="{$EMAIL}" readonly required>
			<br>Password<br>
			<input type="password" name="password" required>
			<br>Confirm Password<br>
			<input type="password" name="confirm_password" required>
			<input type="submit" value="Register">
		</form>
	</div>
{/block}
{block name="js-code"}
	{if $ERROR_MESSAGES != NULL}
		<script>alert('{$ERROR_MESSAGES[0]}');</script>
	{/if}
{/block}
{block name="js}
	<script type="text/javascript" src="{$BASE_URL}javascript/auth/signup.js"></script>
{/block}