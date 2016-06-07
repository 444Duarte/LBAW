{extends file="common/main.tpl"}

{block name="title"} Reservations List {/block}
{block name="content"}
	{include file='common/topbar.tpl'}
	<div class="container-fluid">
    <div class="row">
      {include file='common/sidebar.tpl' }
      <div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
      	<div class="generic-element">
          <div class="table-top-header">
            <h2 class="sub-header">Items List</h2>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
						  <thead>
						      <tr>
						        <th>Item</th>
						        <th>Instance</th>
						        <th>Client</th>
						        <th>Start</th>
						        <th>End</th>
						        <th>Delete</th>
						      </tr>
						  </thead>
						  <tbody id="item-list-table">
						    {foreach $reservations as $reserv}  
						      <tr>
						        <td>{$reserv.name}</a></td>
						        <td>{$reserv.id_item_instance}</td>
						        <td><a href="pages/user.php?user={$reserv.id_client}">{$reserv.username}</a></td>
						        <td> {$reserv.start_time} </td>
						        <td> {$reserv.end_time} </td>
						        <td>
							        <a href="javascript:;" class="submit-delete-form">
							        	<span class="glyphicon glyphicon-remove" href aria-hidden="true" ></span>
							        	<form action="actions/management/delete_reservation.php" method="post">
							        		<input type="hidden" name="reservation" value="{$reserv.id}">
							        	</form>
							        </a>
						        </td>
						      </tr>
						    {/foreach}                
						  </tbody>
						</table>
          </div>

        </div>
      </div>




  	</div> 
  </div>
{/block}
{block name="js-code"}
	{if $ERROR_MESSAGES != NULL}
		<script>alert('{$ERROR_MESSAGES[0]}');</script>
	{/if}
{/block}
{block name="js" append} 
<script src="javascript/management/delete_reservations.js"></script>
{/block}