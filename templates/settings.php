<html>
<?php include_once 'header.html';?>
<link rel="stylesheet" type="text/css" href="css/settings.css">


<body>
	<?php include_once 'topbar.html';?>

	<div class="container-fluid">
	    <div class="row">
	      	<?php include_once 'sidebar.html';?>

	      	<div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
	      		<div class="editTable generic-element">
		      		<div class="editLine" >
		      			<div class="preview-field">
			      			<span class="EditTitle"><strong>E-mail:</strong></span>
		      				<span class="EditInfo">banana@gmail.com</span>	      				
		      			</div>

		      			<div class="edit-field">
			      			<form class="email_form" action="" method="post">
			      				<br>Email<br>
								<input type="email" required>

								<br>Password<br>
								<input type="password" name="password" required>
								<br>Confirm Password<br>
								<input type="password" name="confirm_password" required>
								<br>
								<input type="submit" value="editEmail">
							</form>
						</div>
		      			<a href="#" class="edit-button" id="editEmail">Edit</a>
		      		</div>
		      		<div class="editLine" >
		      			<div class="preview-field">
			      			<span><strong>Password:</strong></span>
			      			<span>***********</span>
		      			</div>
		      			<div class="edit-field">
							<form id="password_form" action="" method="post">
								<br><br>Password<br>
								<input type="password" name="password" required>
								<br>New Password<br>
								<input type="password" name="new_password" required>
								<br>Confirm Password<br>
								<input type="password" name="confirm_password" required>
								<br>
								<input type="submit" value="editPassword">
							</form>
			      		</div>
		      			<a href="#" class="edit-button" id="editPassword">Edit</a>
		      		</div>
	      		</div>
	      		
				
			</div>

		</div>

	   	</div>
	</div>

<script src="../lib/jquery-1.12.1.min.js"></script>
<script src="../lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="js/settings.js"></script>

</body>
</html>