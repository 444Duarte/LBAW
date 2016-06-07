<table class="table table-striped">
  <thead>
	  <tr>
		<th>ID</th>
		<th>Action</th>
		<th>Date</th>
		<th>Manager</th>
		<th>Client</th>
	  </tr>
  </thead>
  <tbody>
	{foreach from=$records item=record}
		<tr>
		  <td>{$record.item_instance}</td>
		  <td>{$record.type}</td>
		  <td>{$record.date}</td>
		  <td>{$record.inventory_manager}</td>
		  <td>{$record.entity|default:'---'}</td>
		</tr>
	{/foreach}
  </tbody>
</table>