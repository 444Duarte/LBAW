{extends file="common/main.tpl"}

{block name="title"} {$item.name} Item Page {/block}
{block name="css" append}
	<link rel="stylesheet" type="text/css" href="css/inventory/item.css">
	
{/block}

{block name="content"}
	{include file='common/topbar.tpl'}
	<div class="container-fluid">
	    <div class="row">
		{include file='common/sidebar.tpl'}	
	    	<div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
	    		<ol class="breadcrumb">
					<li><a href="">Home</a></li>
					<li><a href="pages/inventory/category.php?category={$item.category}">{$item.category}</a></li>
					<li><a href="pages/inventory/subcategory.php?category={$item.category}&amp;subcategory={$item.subcategory}">{$item.subcategory}</a></li>
					<li class="active">{$item.name}</li>
				</ol>
				<div class="row" id="item-pane">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="info">
							<div class="row">
								<div class="col-sm-6">
									<a href="#" class="thumbnail">
										<img src="{$item.picture}" alt="{$item.name}" class="img-thumbnail">
									</a>
								</div>
								<div class="col-sm-6">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h3 class="panel-title">{$item.name}</h3>
										</div>
										<div class="panel-body">
											{$item.description}
										</div>
									</div>
								</div>
							</div>
							{if $USERNAME != NULL}
							<div class="row">
								<div class="col-sm-6">
									<button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#bookModal" onClick="updateSelectedInstance()">Book Item</button>
								</div>
							</div>
							{/if}
						</div>
					</div>
					<div id="reservations" style="display: none;">{$reservations|@json_encode}</div>
				</div>
				{if $USERNAME != NULL}
				<!-- Modal -->
				<div id="bookModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">{$item.name}</h4>
				      </div>
				      <div class="modal-body">
				      	<form action="actions/user/book_item.php" id="bookForm" method="POST">
				      		<table name="form" style="width:100%">
							  	<tr>
							  		<td>Instance:</td> 
								  	<td><select name="item_instance" id="selectForm">
								  		{foreach from=$itemInstances item=it}
								  			<option value="{$it}">{$it}</option>
								  		{/foreach}
									</select></td>
								</tr>
								<tr>
								 	<td>Start Date:</td>
								  	<td><input type="text" class="datepicker" name="start_date"></td>
								</tr>
								<tr>
								  	<td>End Date:</td>
								  	<td><input type="text" class="datepicker" name="end_date"></td>
								</tr>
								<tr>
									<td><input type="submit" value="Submit"></td>
						  		</tr>
						  	</table>
						</form>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal" id="closeButton">Close</button>
				      </div>
				    </div>

				  </div>
				</div>
				{/if}
			</div>
		</div>
	</div>
{/block}

{block name="js" append}
	{if $USER_TYPE == 'Client'}
	<script src="{$BASE_URL}javascript/inventory/item.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( ".datepicker" ).datepicker();
  });
  </script>
	{/if}
{/block}