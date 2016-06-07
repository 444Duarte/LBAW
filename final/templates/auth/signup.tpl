{extends file="common/main.tpl"}
{block name="title"} Toolbox Signup {/block}
{block name="css" append}
	<link rel="stylesheet" type="text/css" href="css/auth/signup.css">
{/block}
{block name="content"}
	<div>
		<form id="signup_form" class="generic-element" action="actions/auth/register.php" method="post">
			<h1 class="form_name">Register</h1>
			<label>Username</label>
			<input type="text" name="username" id="username" data-toggle="tooltip" data-placement="right" title="Please specify the desired username. It must be unique." required>
			<label>Email</label>
			<input type="email" name="email" id="email" data-toggle="tooltip" data-placement="right" title="Please specify your email. It must be a valid email address and unique." required>
			<label>Password</label>
			<input type="password" name="password" data-toggle="tooltip" data-placement="right" title="Please specify the desired password." required>
			<br><label>Confirm Password</label><br>
			<input type="password" name="confirm_password" data-toggle="tooltip" data-placement="right" title="Please confirm your password. It must match the password provided before." required>
			<label>Identification Card</label>
			<input type="text" name="id_card" data-toggle="tooltip" data-placement="right" title="Please specify your identification card. It must be unique." required>
			<label>Address</label>
			<input type="text" name="address" data-toggle="tooltip" data-placement="right" title="Please specify your address." required>
			<label>Phone Number</label>
			<input type="number" name="phone" data-toggle="tooltip" data-placement="right" title="Please specify your phone number. It must have 9 digits." required>

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