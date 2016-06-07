{extends file="common/main.tpl"}

{block name="title"} Search Result {/block}
{block name="css" append}
<link rel="stylesheet" type="text/css" href="css/inventory/item_list.css">
{/block}

{block name="content"}
	{include file='common/topbar.tpl'}

	<div class="container-fluid">
	    <div class="row">
	    	{include file='common/sidebar.tpl'}
	    	<div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
	    		<ol class="breadcrumb">
				  <li class="active">Home</li>
				</ol>

				<div id="item-list">
					{foreach from=$search_result item=it}
						<div class="col-xs-6 col-md-3"><a class="thumbnail" href="pages/inventory/item.php?category={$it.category}&subcategory={$it.subcategory}&item={$it.name}"><img src="images/res/{$it.picture}" alt="{$it.name}"> <div class="caption"><h3>{$it.name}</h3></div></a></div>
					{/foreach}
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
{/block}

