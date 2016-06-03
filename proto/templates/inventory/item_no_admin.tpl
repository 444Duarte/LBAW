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
					<li><a href="#">{$item.category}</a></li>
					<li><a href="#">{$item.subcategory}</a></li>
					<li class="active">{$item.name}</li>
				</ol>
				<div class="row" id="item-pane">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="info">
							<div class="row">
								<div class="col-sm-6">
									<a href="#" class="thumbnail">
										<img src="images/res/{$item.picture}" alt="{$item.name}" class="img-thumbnail">
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
							<div class="row">
								<div class="col-sm-6">
									<button type="button" class="btn btn-primary btn-lg btn-block">Book Item</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
{/block}