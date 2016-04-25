<html>
<?php include_once '{$BASE_URL}templates/common/header.html';?>
<link rel="stylesheet" type="text/css" href="{$BASE_URL}css/inventory/item_list.css">

<body>
	<?php include_once '{$BASE_URL}templates/common/topbar.tpl';?>

	<div class="container-fluid">
	    <div class="row">
	      	<?php include_once '{$BASE_URL}templates/common/sidebar.tpl';?>
	    	
	    	<div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
	    		<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Tools</a></li>
					  <li class="active">Hand Tools</li>
					</ol>

					<div id="item-list">
						<div class="col-xs-6 col-md-3">
					    <a href="{$BASE_URL}pages/inventory/item.php" class="thumbnail">
					      <img src="res/item_thumb_medium.png" alt="Item Exemplo 1">
					      <h3>Hammer</h3>
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
					  <div class="col-xs-6 col-md-3">
					    <a href="#" class="thumbnail">
					      <img src="res/item_thumb_medium.png" alt="Item Exemplo 7">
					      <h3>Item Exemplo 7</h3>
					    </a>
					  </div>
					  <div class="col-xs-6 col-md-3">
					    <a href="#" class="thumbnail">
					      <img src="res/item_thumb_medium.png" alt="Item Exemplo 8">
					      <h3>Item Exemplo 8</h3>
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
	
<script src="{$BASE_URL}lib/jquery-1.12.1.min.js"></script>
<script src="{$BASE_URL}lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(".username").hide();
  $("#loginButton");
</script>
</body>
</html>