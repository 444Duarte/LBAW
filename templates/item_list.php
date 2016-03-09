<html>
<?php include_once 'header.html';?>
<link rel="stylesheet" type="text/css" href="css/item_list.css">

<body>
	<?php include_once 'topbar.html';?>

	<div class="container-fluid">
	    <div class="row">
	      	<?php include_once 'sidebar.html';?>
	    	
	    	<div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
	    		<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Library</a></li>
					  <li class="active">Data</li>
					</ol>

					<div id="item-list">
						<div class="col-xs-6 col-md-3">
					    <a href="#" class="thumbnail">
					      <img src="res/item_thumb_medium.png" alt="Item Exemplo 1">
					      <h3>Item Exemplo 1</h3>
					    </a>
					  </div>
					  <div class="col-xs-6 col-md-3">
					    <a href="#" class="thumbnail">
					      <img src="res/item_thumb_medium.png" alt="Item Exemplo 2">
					      <h3>Item Exemplo 2</h3>
					    </a>
					  </div>
					  <div class="col-xs-6 col-md-3">
					    <a href="#" class="thumbnail">
					      <img src="res/item_thumb_medium.png" alt="Item Exemplo 3">
					      <h3>Item Exemplo 3</h3>
					    </a>
					  </div>
					  <div class="col-xs-6 col-md-3">
					    <a href="#" class="thumbnail">
					      <img src="res/item_thumb_medium.png" alt="Item Exemplo 4">
					      <h3>Item Exemplo 4</h3>
					    </a>
					  </div>
					  <div class="col-xs-6 col-md-3">
					    <a href="#" class="thumbnail">
					      <img src="res/item_thumb_medium.png" alt="Item Exemplo 5">
					      <h3>Item Exemplo 5</h3>
					    </a>
					  </div>
					  <div class="col-xs-6 col-md-3">
					    <a href="#" class="thumbnail">
					      <img src="res/item_thumb_medium.png" alt="Item Exemplo 6">
					      <h3>Item Exemplo 6</h3>
					    </a>
					  </div>
		    	</div>

		    	<nav>
					  <ul class="pagination">
					    <li class="disabled">
					      <a href="#" aria-label="Previous">
					        <span aria-hidden="true">&laquo;</span>
					      </a>
					    </li>
					    <li class="active"><a href="#">1</a></li>
					    <li><a href="#">2</a></li>
					    <li><a href="#">3</a></li>
					    <li><a href="#">4</a></li>
					    <li><a href="#">5</a></li>
					    <li>
					      <a href="#" aria-label="Next">
					        <span aria-hidden="true">&raquo;</span>
					      </a>
					    </li>
					  </ul>
					</nav>
				</div>
	    </div>
	</div>
	
<script src="../lib/jquery-1.12.1.min.js"></script>
<script src="../lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(".username").hide();
  $("#loginButton");
</script>
</body>
</html>