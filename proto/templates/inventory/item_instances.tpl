<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<span class="panel-title">Available Items</span>
				<span class="pull-right">
				<button id="add-item-button" type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#add-instance-modal" data-whatever="@getbootstrap">           
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
								<a href="#" title="Lend"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>
								<a href="#" title="Maintenance"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
								<a title="Return"><span class="glyphicon glyphicon-log-in transparent" aria-hidden="true"></span></a>
								<a href="#" title="Remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
							{elseif $ins.state == 'Removed'}
								<a title="Lend"><span class="glyphicon glyphicon-log-out transparent" aria-hidden="true"></span></a>
								<a title="Maintenance"><span class="glyphicon glyphicon-wrench transparent" aria-hidden="true">
								<a title="Return"><span class="glyphicon glyphicon-log-in transparent" aria-hidden="true"></span></a>
								<a title="Remove"><span class="glyphicon glyphicon-remove transparent" aria-hidden="true"></span></a>
							{else}
								<a title="Lend"><span class="glyphicon glyphicon-log-out transparent" aria-hidden="true"></span></a>
								<a title="Maintenance"><span class="glyphicon glyphicon-wrench transparent" aria-hidden="true">
								<a href="#" title="Return"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></a>
								<a title="Remove"><span class="glyphicon glyphicon-remove transparent" aria-hidden="true"></span></a>
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