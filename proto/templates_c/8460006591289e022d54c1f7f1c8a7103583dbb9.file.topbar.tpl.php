<?php /* Smarty version Smarty-3.1.15, created on 2016-04-25 14:48:34
         compiled from "/opt/lbaw/lbaw1533/public_html/proto/templates/common/topbar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2014846870571d864ac0ccf9-41935100%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8460006591289e022d54c1f7f1c8a7103583dbb9' => 
    array (
      0 => '/opt/lbaw/lbaw1533/public_html/proto/templates/common/topbar.tpl',
      1 => 1461588508,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2014846870571d864ac0ccf9-41935100',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_571d864ac20017_58417096',
  'variables' => 
  array (
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571d864ac20017_58417096')) {function content_571d864ac20017_58417096($_smarty_tpl) {?><nav id="topbar" class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
">ToolBox</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

	<ul id="loginButton" class="nav navbar-nav navbar-right">
		<li><a href="actions/auth/logout.php">Logout</a></li>
	</ul>	  
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>

    </div>
  </div>
</nav>

<?php }} ?>
