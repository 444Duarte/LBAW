<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<span class="panel-title">Available Items</span>
				<span class="pull-right">
				<button id="add-instance-button"  type="button" class="btn btn-default btn-lg add-button flipthis-highlight" data-toggle="modal" data-target="#add-instance-modal" data-whatever="@getbootstrap">           
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Instance
				</button>
				</span>
			</div>
			<div class="panel-body">
				<table class="table table-striped">
					<thead><tr>
						<th> ID </th>
						<th> State </th>
						<th> Condition </th>
						<th> Actions </th>
					</tr></thead>
					<tbody>
					{foreach from=$instances item=ins}
					<tr>
						<td>{$ins.id}</td>
						<td>{$ins.state}</td>
						<td>{print_stars n_stars=$ins.condition}</td>
						<td>
							{if $ins.state == 'Available'}
								<button onClick="updateLendForm({$ins.id})" title="Lend" type="button" data-toggle="modal" data-target="#lend-item-modal" data-whatever="@getbootstrap"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></button>
								<button onClick="updateMaintenance({$ins.id})" title="Maintenance" type="button" data-toggle="modal" data-target="#maintenance-item-modal" data-whatever="@getbootstrap"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></button>
								<button title="Return" type="button"><span class="glyphicon glyphicon-log-in transparent" aria-hidden="true"></span></button>
								<button title="Remove" type="button" data-toggle="modal" data-target="#remove-item-modal" data-whatever="@getbootstrap"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
							{elseif $ins.state == 'Removed'}
								<button title="Lend" type="button"><span class="glyphicon glyphicon-log-out transparent" aria-hidden="true"></span></button>
								<button title="Maintenance" type="button"><span class="glyphicon glyphicon-wrench transparent" aria-hidden="true">
								<button title="Return" type="button"><span class="glyphicon glyphicon-log-in transparent" aria-hidden="true"></span></button>
								<button title="Remove" type="button"><span class="glyphicon glyphicon-remove transparent" aria-hidden="true"></span></button>
							{else}
								<button title="Lend" type="button" data-whatever="@getbootstrap"><span class="glyphicon glyphicon-log-out transparent" aria-hidden="true"></span></button>
								<button title="Maintenance" type="button" data-whatever="@getbootstrap"><span class="glyphicon glyphicon-wrench transparent" aria-hidden="true">
								<button title="Return" onClick="updateReturnForm({$ins.id}, '{$ins.state}')" type="button" data-toggle="modal" data-target="#return-item-modal" data-whatever="@getbootstrap"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></button>
								<button title="Remove" type="button" data-whatever="@getbootstrap"><span class="glyphicon glyphicon-remove transparent" aria-hidden="true"></span></button>
							{/if}
						</td>
					</tr>
					{/foreach}
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="lend-item-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Lend Item</h4>
      </div> 
      <div class="modal-body">
        <form id="lend-item-form" action="actions/inventory/lend_item.php" method="post" enctype="multipart/form-data">
          <label>Client</label> 
          <input type="text" name="client" required>
          <br><label>End Date</label>
          <input type="date" name="end_date" required>
          <input type="hidden" name="id">
          <input type="hidden" name="today">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="lend-item-form">Lend Item</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="maintenance-item-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Send for Maintenance</h4>
      </div> 
      <div class="modal-body">
        <form id="maintenance-item-form" action="actions/inventory/maintenance.php" method="post" enctype="multipart/form-data">
          <label>Maintenance Provider</label>
          <input type="text" name="provider" required>
          <br><label>End Date</label>
          <input type="date" name="end_date" required>
          <input type="hidden" name="id">
          <input type="hidden" name="today">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" form="maintenance-item-form" class="btn btn-primary">Send for Maintenance</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="return-item-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Return Item</h4>
      </div> 
      <div class="modal-body">
      	Are you sure you want to return the item?
        <form id="return-item-form" action="actions/inventory/return_item.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="{$ins.id}">
          <input type="hidden" name="today">
          <input type="hidden" name="state">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="return-item-form">Return Item</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="remove-item-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Remove Item</h4>
      </div> 
      <div class="modal-body">
      	Are you sure you want to remove the item?
        <form id="remove-item-form" action="actions/inventory/lend_item.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Remove Item</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{block name="js-code" append}
<script type="text/javascript"> 
  var item = {$item|@json_encode};
  var itemInstances = {$itemInstances|@json_encode};
  var reservations = {$reservations|@json_encode};
  //console.log(item);
  //console.log(itemInstances);
  //console.log(reservations);
</script> 
{if $ERROR_MESSAGES != NULL}
    <script>alert('{$ERROR_MESSAGES[0]}');</script>
{/if}
{/block}
