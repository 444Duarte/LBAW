<?php /* Smarty version Smarty-3.1.15, created on 2016-04-25 14:48:34
         compiled from "/opt/lbaw/lbaw1533/public_html/proto/templates/inventory/item_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:249207854571de889cfd0c4-92805551%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18f4651997511f0e778f159476a4755a8c70c398' => 
    array (
      0 => '/opt/lbaw/lbaw1533/public_html/proto/templates/inventory/item_list.tpl',
      1 => 1461588509,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '249207854571de889cfd0c4-92805551',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_571de889db3137_12253397',
  'variables' => 
  array (
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571de889db3137_12253397')) {function content_571de889db3137_12253397($_smarty_tpl) {?><html>
<?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
css/inventory/item_list.css">

<body>
	<?php echo $_smarty_tpl->getSubTemplate ('common/topbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


	<div class="container-fluid">
	    <div class="row">
	    	<?php echo $_smarty_tpl->getSubTemplate ('common/sidebar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	    	<div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
	    		<ol class="breadcrumb">
				  <li class="active">Home</li>
				</ol>

				<div id="item-list">
	    		</div>

			
	    	<nav>
				  <ul class="pagination">
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
	
<script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
lib/jquery-1.12.1.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
javascript/inventory/item_list.js"></script>
</body>
</html><?php }} ?>
