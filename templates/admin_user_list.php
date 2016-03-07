<html>
<head>
	<title>ToolBox User List</title>
	<link href="../lib/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/generic_template.css">
</head>

<body>
	<?php include_once 'topbar.html';?>

	<div class="container-fluid">
    <div class="row">
      <?php include_once 'sidebar.html';?>


      <div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
        <h2 class="sub-header">Users List</h2>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
                <tr>
                  <th>#</th>
                  <th>Account Type</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td>im01</td>
                <td>Inventory Manager</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
              <tr>
                <td>im02</td>
                <td>Inventory Manager</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
              <tr>
                <td>im03</td>
                <td>Inventory Manager</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
              <tr>
                <td>im04</td>
                <td>Inventory Manager</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
              <tr>
                <td>im05</td>
                <td>Inventory Manager</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
              <tr>
                <td>client01</td>
                <td>Client</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
              <tr>
                <td>client02</td>
                <td>Client</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
              <tr>
                <td>client03</td>
                <td>Client</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
              <tr>
                <td>client04</td>
                <td>Client</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
              <tr>
                <td>client05</td>
                <td>Client</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
              <tr>
                <td>client06</td>
                <td>Client</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
              <tr>
                <td>client07</td>
                <td>Client</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
              <tr>
                <td>client08</td>
                <td>Client</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
              <tr>
                <td>client09</td>
                <td>Client</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
              <tr>
                <td>client10</td>
                <td>Client</td>
                <td><a href=""> <img class="delete_icon" src="res/delete-icon_32.png" alt="Block User" title="Block User"></a></td>
              </tr>
            </tbody>
          </table>
        </div>

        <h2 class="sub-header">Blocked Users</h2>
      	<div class="table-responsive">
          <table class="table table-striped">
            <thead>
                <tr>
                  <th>#</th>
                  <th>Account Type</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td>im99</td>
                <td>Inventory Manager</td>
                <td><a href=""> <img class="accept_icon" src="res/accept_icon_32.png" alt="Revive User Account" title="Revive User Account"></a></td>
              </tr>
              <tr>
                <td>client20</td>
                <td>Client</td>
                <td><a href=""> <img class="accept_icon" src="res/accept_icon_32.png" alt="Revive User Account" title="Revive User Account"></a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      </div>
    </div>
  </div>

<script src="../lib/jquery-1.12.1.min.js"></script>
<script src="../lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(".username").html('admin<span class="caret"></span>');
  $("#loginButton").hide();
</script>
</body>
</html>
