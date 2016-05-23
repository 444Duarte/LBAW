<html>
{include file='common/header.tpl'}
<link rel="stylesheet" type="text/css" href="{$BASE_URL}css/inventory/item_list.css">

<body>
	{include file='common/topbar.tpl'}

	<div class="container-fluid">
	    <div class="row">
	    	{include file='common/sidebar.tpl'}
	    	<div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
	    		<ol class="breadcrumb">
				  <li class="active">Home</li>
				</ol>

				<div id="item-list">
	    		</div>

			
	    	<nav>
				  <ul id="pagination" class="pagination">
				    <li class="disabled">
				      <a href="#" aria-label="Previous">
				        <span aria-hidden="true">&laquo;</span>
				      </a>
				    </li>
				    <li class="active"><a href="#">1</a></li>
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
<script src="{$BASE_URL}javascript/inventory/item_list.js"></script>
</body>
</html>