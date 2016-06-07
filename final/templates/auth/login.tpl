{extends file="common/main.tpl"}

{block name="title"} ToolBox Login {/block}
{block name="css" append}
  	<link rel="stylesheet" type="text/css" href="css/auth/login.css">
{/block}
{block name="content"}
	<div>
		<form id="login_form" class="generic-element" action="actions/auth/login.php" method="post">
			<div>
				<img class="login_entity" src="images/res/User_Avatar-64.png" alt="user label icon">
				<input class="login_entity" type="text" name="username" placeholder="Username ex: up203012345" required>
			</div>
			<br>
			<div>
				<img class="login_entity" src="images/res/Key_icon_64.png" alt="password label icon">
				<input class="login_entity" type="password" name="password" placeholder="Password" required>
			</div>
			<br>
			<div id="login_options">
				<a href="javascript:;" data-toggle="modal" data-target="#forgot-password-modal">Forgot your password?</a>
				<a href="{$BASE_URL}pages/auth/signup.php">Not a member?</a>
			</div>

			<input type="submit" value="Login">
		</form>
	</div>

	<div id="forgot-password-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">Forgot Password?</h4>
        </div> 
        <div class="modal-body">
          <form id="forgot-password-form" action="actions/user/forgot_password.php" method="post" enctype="multipart/form-data">
            <label>Email</label><br>
            <input type="email" name="email" required>
          </form>
        </div>
				<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" form="forgot-password-form" id="submit_form_subcategory_button" class="btn btn-primary submit_form_button" value="Retrieve Password"></button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
{/block}
{block name="js-code"}
	{if $ERROR_MESSAGES != NULL}
		<script>alert('{$ERROR_MESSAGES[0]}');</script>
	{/if}
{/block}
