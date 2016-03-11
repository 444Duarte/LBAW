<html>
<?php include_once 'header.html';?>
<link rel="stylesheet" type="text/css" href="css/item.css">


<body>
	<?php include_once 'topbar.html';?>
	
	<div class="container-fluid">
	    <div class="row">
	      	<?php include_once 'sidebar.html';?>
	    	
	    	<div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
	    		<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li><a href="#">Users</a></li>
					<li class="active">Marcelo Rebelo de Sousa</li>
				</ol>
				<div>
					<!-- Nav tabs -->
					<div class="row">
						<ul class="nav nav-tabs nav-justified" role="tablist">
							<li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Info</a></li>
							<li role="presentation"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Bookings</a></li>
							<li role="presentation"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Settings</a></li>
						</ul>
					</div>

					<div class="row" id="item-pane">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="info">
								<div class="row">
									<div class="col-sm-4">
										<a href="#" class="thumbnail">
											<img src="res/Marcelo.jpg" alt="User_Photo" class="img-thumbnail">
										</a>
									</div>
									<div class="col-sm-4">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">Marcelo Rebelo de Sousa</h3>
											</div>
											<div class="panel-body">
												<p><strong>Address: </strong>Palacio de Belem</p>
												<p><strong>Phone: </strong>800 000 000	</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="../lib/jquery-1.12.1.min.js"></script>
	<script src="../lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
	<script src="../lib/moment.min.js"></script>
	<script type="text/javascript">
	  $(document).ready( function() {
		  $(".username").hide();
		  $("#loginButton");
		   $(function () {
				$('#datetimepicker12').datetimepicker({
					inline: true,
					sideBySide: true
				});
			});
	  });
	</script>
</body>
</html>