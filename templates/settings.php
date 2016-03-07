<html>
<head>
	<title>ToolBox User List</title>
	<link href="../lib/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/generic_template.css">
  <link rel="stylesheet" type="text/css" href="css/settings.css">

</head>

<body>
	<?php include_once 'topbar.html';?>

	<div class="container-fluid">
	    <div class="row">
	      	<?php include_once 'sidebar.html';?>

	      	<div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
	      		<div class="editTable generic-element">
		      		<div class="editLine" >
		      			<span class="EditTitle"><strong>E-mail:</strong></span>
		      			<span class="EditInfo">banana@gmail.com</span>
		      			<span class="EditButton" id="editEmail">Edit</span>
		      		</div>
		      		<div class="editLine" >
		      			<span class="EditTitle"><strong>Password:</strong></span>
		      			<span class="EditInfo">***********</span>
		      			<span class="EditButton" id="editPassword">Edit</span>
		      		</div>
	      		</div>
	      		<div class="editField">
	      			<form id="editEmailForm" action="" method="post">
	      				<br>Email<br>
						<input type="email" required>

						<br>Password<br>
						<input type="password" name="password" required>
						<br>Confirm Password<br>
						<input type="password" name="confirm_password" required>


						<input type="submit" value="editEmail">
					</form>
				</div>
				<div class="editField">
					<form id="editPasswordForm" action="" method="post">
						<br><br>Password<br>
						<input type="password" name="password" required>
						<br>New Password<br>
						<input type="password" name="new_password" required>
						<br>Confirm Password<br>
						<input type="password" name="confirm_password" required>


						<input type="submit" value="editPassword">
					</form>
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