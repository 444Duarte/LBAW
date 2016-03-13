<?php
	function print_stars($nStars){
		$i = 0;		
		for (; $i < $nStars; $i++){
			echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span>' ;
		}
		for (; $i < 5; $i++){
			echo '<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>' ;
		}
	}
?>

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
					<li><a href="#">Tools</a></li>
					<li><a href="#">Hand Tools</a></li>
					<li class="active">Hammer</li>
				</ol>
				<div>
					<!-- Nav tabs -->
					<div class="row">
						<ul class="nav nav-tabs nav-justified" role="tablist">
							<li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Info</a></li>
							<li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab">History</a></li>
							<li role="presentation"><a href="#instances" aria-controls="instances" role="tab" data-toggle="tab">Instances</a></li>
							<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
						</ul>
					</div>

					<!-- Tab panes -->
					<div class="row" id="item-pane">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="info">
								<div class="row">
									<div class="col-sm-6">
										<a href="#" class="thumbnail">
											<img src="res/item_thumb_medium.png" alt="Hammer" class="img-thumbnail">
										</a>
									</div>
									<div class="col-sm-6">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">Hammer</h3>
											</div>
											<div class="panel-body">
												Exceptional tool for when those nails don't know how to stand down. <br>
												Montstar Cross Pien Hammer With Wooden Handle 4oz (100 gms)
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<button type="button" class="btn btn-primary btn-lg btn-block">Book Item</button>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="row">
											<div class="col-md-8">
												<div id="datetimepicker12"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="history">Item History</div>
							<div role="tabpanel" class="tab-pane" id="instances">
								<div class="row">
									<div class="col-sm-12">
										<div class="panel panel-default">
											<div class="panel-heading">
													<h3 class="panel-title">Available Items</h3>
												</div>
												<div class="panel-body">
													<table class="table table-striped">
														<thead>
															<th> ID </th>
															<th> State </th>
															<th> Condition </th>
															<th> Actions </th>
														</thead>
														<tr>
															<td> 000001 </td>
															<td> Available </td>
															<td><?php print_stars(5) ?></td>
										                    <td>
															<a href="#" title="Lend"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>
															<a href="#" title="Maintenance"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
															<a href="#" title="Return"><span class="glyphicon glyphicon-log-in transparent" aria-hidden="true"></span></a>
															</td>
														</tr>
														<tr>
															<td> 000003 </td>
															<td> Maintenance </td>
															<td><?php print_stars(4) ?></td>
										                    <td>
															<a href="#" title="Lend"><span class="glyphicon glyphicon-log-out transparent" aria-hidden="true"></span></a>
															<a href="#" title="Maintenance"><span class="glyphicon glyphicon-wrench transparent" aria-hidden="true"></span></a>
															<a href="#" title="Return"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></a>
															</td>
														</tr>
														<tr>
															<td> 000005 </td>
															<td> Available </td>
															<td><?php print_stars(3) ?></td>
										                    <td>
															<a href="#" title="Lend"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>
															<a href="#" title="Maintenance"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
															<a href="#" title="Return"><span class="glyphicon glyphicon-log-in transparent" aria-hidden="true"></span></a>
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="settings">...</div>
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