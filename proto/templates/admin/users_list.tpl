<html>
{include file='common/header.tpl'}
<link rel="stylesheet" type="text/css" href="{$BASE_URL}css/admin/admin_user_list.css">

<body>
	{include file='common/topbar.tpl'}

	<div class="container-fluid">
    <div class="row">
      {include file='common/sidebar.tpl'}
      <div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
        <div class="generic-element">
          <div class="table-top-header">
            <h2 class="sub-header">Users List</h2>
            <button id="add-user-button" type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#add-user-modal" data-whatever="@getbootstrap">           
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Inventory Manager
            </button>
          </div>
          <div class="table-responsive">
            <table id="active-users" class="table table-striped">
              <thead>
                  <tr>
                    <th>#</th>
                    <th>Account Type</th>
                    <th></th>
                  </tr>
              </thead>
              <tbody>                
                <tr>
                  <td>im01</td>
                  <td>Inventory Manager</td>
                  <td>
                    <a class="block-user-botton form-submit" href="javascript:;" title="Block Account">
                      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                      <form class="block-user-form" action="{$BASE_URL}actions/admin/block_user.php" method="post">
                        <input type="hidden" name="user" value="1">
                      </form>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        
        <div class="generic-element">
          <h2 class="sub-header">Blocked Users</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                  <tr>
                    <th>#</th>
                    <th>Account Type</th>
                    <th></th>
                  </tr>
              </thead>
              <tbody>
                <tr>
                  <td>im99</td>
                  <td>Inventory Manager</td>
                  <td>
                    <a href="javascript:;" class="form-submit" title="Revive Account">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                      <form class="revive-user-form" action="{$BASE_URL}actions/admin/revive_user.php" method="post">
                        <input type="hidden" name="user" value="9">
                      </form>
                    </a>
                  </td>                
                </tr>
                <tr>
                  <td>client20</td>
                  <td>Client</td>
                  <td>
                    <a href="javascript:;" class="form-submit" title="Revive Account">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                      <form class="revive-user-form" action="{$BASE_URL}actions/admin/revive_user.php" method="post">
                        <input type="hidden" name="user" value="20">
                      </form>
                    </a>
                  </td> 
                </tr>
              </tbody>
            </table>
          </div>
        </div>  
      </div>
      <div id="add-user-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add Inventory Manager</h4>
            </div> 
            <div class="modal-body">
              <form id="add-user-form" action="{$BASE_URL}api/admin/create_inventory_manager.php" method="post">
                <p>Email:</p>
                <input type="email" name="email" required>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="submit_form_button" class="btn btn-primary">Send registration email</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      </div>
    </div>
  </div>
{if $ERROR_MESSAGES != NULL}
  <script>alert('{$ERROR_MESSAGES[0]}');</script>
{/if}
<script src="{$BASE_URL}lib/jquery-1.12.1.min.js"></script>
<script src="{$BASE_URL}lib/jquery.validate.js"></script>
<script src="{$BASE_URL}lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
<script src="{$BASE_URL}javascript/admin/users_list.js"></script>
</body>
</html>
