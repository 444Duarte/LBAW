<?php /* Smarty version Smarty-3.1.15, created on 2016-04-25 04:54:40
         compiled from "/opt/lbaw/lbaw1533/public_html/proto/templates/management/inventory_management.tpl" */ ?>
<?php /*%%SmartyHeaderCode:824525396571d769c866022-93793115%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a9b279314c6a9a2e00cd994727ad7b15bffd0aa' => 
    array (
      0 => '/opt/lbaw/lbaw1533/public_html/proto/templates/management/inventory_management.tpl',
      1 => 1461552878,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '824525396571d769c866022-93793115',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_571d769c958357_13450921',
  'variables' => 
  array (
    'BASE_URL' => 0,
    'items' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571d769c958357_13450921')) {function content_571d769c958357_13450921($_smarty_tpl) {?><html>
<?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
css/management/inventory_management.css">

<body>
	<?php echo $_smarty_tpl->getSubTemplate ('common/topbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


	<div class="container-fluid">
    <div class="row">
      <?php echo $_smarty_tpl->getSubTemplate ('common/sidebar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

      <div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
      	<div class="generic-element">
          <div class="table-top-header">
            <h2 class="sub-header">Items List</h2>
            <button id="add-item-button" type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#add-item-modal" data-whatever="@getbootstrap">           
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Item
            </button>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                  <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Sub-Category</th>
                    <th>State</th>
                    <th>Average Condition</th>
                    <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                  <tr>
                    <td><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/inventory/item.php"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a></td>
                    <td><a href="#"><?php echo $_smarty_tpl->tpl_vars['item']->value['category'];?>
</a></td>
                    <td><a href="#"><?php echo $_smarty_tpl->tpl_vars['item']->value['subcategory'];?>
</a></td>
                    <td>Available</td>
                    <td>  </td>
                    <td><a href="" title="Remove item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                  </tr>
                <?php } ?>                
              </tbody>
            </table>
          </div>
        </div>
      </div>

			<div id="add-item-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              	<span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">Add Item</h4>
            </div> 
            <div class="modal-body">
              <form id="add-item-form" action="" method="post">
                Name:<br>
                <input type="text" name="name" required>
                <br>Category<br>
                <select name="category">
								  <option value="inf">Informatics</option>
								  <option value="video">Video</option>
								  <option value="audio">Audi</option>
								  <option value="room">Room</option>
								  <option value="cleaning">Cleaning</option>
								</select>
               	<br>Sub-Category<br>
                <select name="sub_category">
								  <option value="peripheral">Peripheral</option>
								  <option value="computers">Computers</option>
								  <option value="adapters">Adapters</option>
								  <option value="cables">Cables</option>
								  <option value="cd">CDs</option>
								</select>
								<br>Image<br>
								<input type="file" name="pic" accept="image/*">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="submit_form_button" class="btn btn-primary">Add Item</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

    </div>
  </div>

<script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
lib/jquery-1.12.1.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
javascript/admin/admin_user_list.js"></script>
<script type="text/javascript">
  $(".username").html('manager001<span class="caret"></span>');
  $("#loginButton").hide();
</script>
</body>
</html>
  <?php }} ?>
