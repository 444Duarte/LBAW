<nav id="topbar" class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{$BASE_URL}">ToolBox</a>
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

