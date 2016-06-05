{extends file="common/main.tpl"}

{function print_stars}
	{for $i = 1 to $n_stars}
		<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
	{/for}
	{for $i = $n_stars + 1 to 5}
		<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
	{/for}
{/function}

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
					<li><a href="pages/inventory/subcategory.php?category={$item.category}&amp;subcategory={$item.subcategory}">{$item.subcategory}</a></li>
					<li class="active">{$item.name}</li>
				</ol>
				<div>
					<!-- Nav tabs -->
						<div class="row">
						<ul class="nav nav-tabs nav-justified" role="tablist">
							<li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Info</a></li>
							<li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab">History</a></li>
							<li role="presentation"><a href="#instances" aria-controls="instances" role="tab" data-toggle="tab">Instances</a></li>
						</ul>
					</div>

					<!-- Tab panes -->
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
								<div class="row">
									<div class="form-group">
										<div class="row">
											<div class="col-md-8">
												<div id="datetimepicker12"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="history">
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
					                <tr>
									  <td>000003</td>
					                  <td>Maintenance</td>
					                  <td>12/03/2016</td>
					                  <td>Pedro Ferreira</td>
									  <td>MarMan - Manutencao de Martelos, Lda</td>
					                </tr>
									<tr>
									  <td>000003</td>
					                  <td>Return</td>
					                  <td>12/03/2016</td>
									  <td>Pedro Ferreira</td>
									  <td><a href="pages/user/user_profile.php">Marcelo Rebelo de Sousa</a></td>
					                </tr>
					                <tr>
									  <td>000003</td>
					                  <td>Lend</td>
					                  <td>10/03/2016</td>
									  <td>Afonso Castro</td>
									  <td><a href="user_profile.php">Marcelo Rebelo de Sousa</a></td>
					                </tr>
									<tr>
									  <td>000005</td>
					                  <td>Add Instance</td>
					                  <td>10/03/2016</td>
									  <td>Afonso Castro</td>
									  <td>---</td>
					                </tr>    
									<tr>
									  <td>000003</td>
					                  <td>Add Instance</td>
					                  <td>10/03/2016</td>
									  <td>Afonso Castro</td>
									  <td>---</td>
					                </tr>    
					                <tr>
									  <td>000001</td>
					                  <td>Add Instance</td>
					                  <td>10/03/2016</td>
									  <td>Afonso Castro</td>
									  <td>---</td>
					                </tr>               
					              </tbody>
					            </table>
							</div>
							<div role="tabpanel" class="tab-pane" id="instances">
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
														<thead>
															<th> ID </th>
															<th> State </th>
															<th> Condition </th>
															<th> Actions </th>
														</thead>
														<tr>
															<td> 000001 </td>
															<td> Available </td>
										                    <td>
															<a href="#" title="Lend"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>
															<a href="#" title="Maintenance"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
															<a href="#" title="Return"><span class="glyphicon glyphicon-log-in transparent" aria-hidden="true"></span></a>
															<a href="#" title="Remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
															</td>
														</tr>
														<tr>
															<td> 000003 </td>
															<td> Maintenance </td>
										                    <td>
															<a href="#" title="Lend"><span class="glyphicon glyphicon-log-out transparent" aria-hidden="true"></span></a>
															<a href="#" title="Maintenance"><span class="glyphicon glyphicon-wrench transparent" aria-hidden="true"></span></a>
															<a href="#" title="Return"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></a>
															<a href="#" title="Remove"><span class="glyphicon glyphicon-remove transparent" aria-hidden="true"></span></a>
															</td>
														</tr>
														<tr>
															<td> 000005 </td>
															<td> Available </td>
										                    <td>
															<a href="#" title="Lend"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>
															<a href="#" title="Maintenance"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
															<a href="#" title="Return"><span class="glyphicon glyphicon-log-in transparent" aria-hidden="true"></span></a>
															<a href="#" title="Remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="settings">...</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="remove-instance-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              	<span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">Remove Instance</h4>
            </div> 
            <div class="modal-body">
              <form id="remove-instance-form" action="" method="post">
                Condition: {print_stars n_stars = 2}
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="submit_form_button" class="btn btn-primary">Remove Instance</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
	
	<div id="add-instance-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              	<span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">Add Instance</h4>
            </div> 
            <div class="modal-body">
              <form id="add-instance-form" action="" method="post">
                Condition:
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="submit_form_button" class="btn btn-primary">Add Instance</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
{/block}