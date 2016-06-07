{extends file="common/main.tpl"}

{block name="title"} Inventory Management {/block}

{block name="css" append}
<link rel="stylesheet" type="text/css" href="css/user/settings.css">
{/block} 


{block name="content"}

	{include file='common/topbar.tpl'}

	<div class="container-fluid">
	    <div class="row">
	      	{include file='common/sidebar.tpl'}

	      	<div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
	      		<div class="editTable generic-element">
		      		<div class="editLine" >
		      			<div class="preview-field">
			      			<span class="EditTitle"><strong>E-mail:</strong></span>
		      				<span class="EditInfo">{$EMAIL|escape:html}</span>	      				
		      			</div>

		      			<div class="edit-field">
			      			<form class="email_form" action="actions/user/change_email.php" method="post">
			      				<br><label>New Email</label><br>
								<input type="email" name="email" required>
								<br><label>Confirm Email</label><br>
								<input type="email" name="confirm_email" required>
								<br><label>Password</label><br>
								<input type="password" name="password" required>
								<br><br>
								<input type="submit" value="Change Email" >
							</form>
						</div>
		      			<a class="edit-button" id="editEmail">Edit</a>
		      		</div>
		      		<div class="editLine" >
		      			<div class="preview-field">
			      			<span><strong>Password:</strong></span>
			      			<span>***********</span>
		      			</div>
		      			<div class="edit-field">
							<form id="password_form" action="actions/user/change_password.php" method="post">
								<br><label>Password</label><br>
								<input type="password" name="password" required>
								<br><label>New Password</label><br>
								<input type="password" name="new_password" required>
								<br><label>Confirm Password</label><br>
								<input type="password" name="confirm_password" required>
								<br><br>
								<input type="submit" value="Change Password">
							</form>
			      		</div>
		      			<a class="edit-button" id="editPassword">Edit</a>
		      		</div>
	      		</div>
	      		
				
			</div>

		</div>

	   	</div>
{/block}
{block name="js" append}
<script src="javascript/user/settings.js"></script>
{/block}
</body>
</html>