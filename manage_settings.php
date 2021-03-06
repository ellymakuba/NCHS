<?PHP
	require 'data_access_object.php';
	$dao=new DAO();
	$dao->checkLogin();
	$pageSecurity=1;
	$users=$dao->getAllUsers();
?>
<html>
	<?PHP $dao->includeHead('Settings | Users',1); ?>
	<body class="container">
		<?PHP
				$dao->includeMenu(9);
		?>
		<div id="menu_main">
			<a href="manage_settings.php" id="item_selected">User List</a>
			<a href="user.php">User</a>
			<a href="roles.php" >Roles</a>
      <a href="drug_list.php">Drugs</a>
      <a href="cust_search.php">Lab Tests</a>
      <a href="cust_search.php">Operations</a>
      <a href="cust_search.php">Nurses</a>
      <a href="cust_search.php">Doctors</a>
      <a href="cust_search.php">Labs</a>
      <a href="cust_search.php">Departments</a>
			<a href="cust_search.php">Rooms</a>
		</div>
		<?php if(in_array($pageSecurity, $_SESSION['AllowedPageSecurityTokens'])){?>
		<div class="container">
			<div class="col-sm-3 col-md-3 pull-left">
	          <form class="navbar-form" role="search">
	          <div class="input-group">
	              <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
	              <div class="input-group-btn">
	                  <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
	              </div>
	          </div>
	          </form>
	  </div>
			<form action="set_ugroup.php" method="post">
				<table class="table table-striped">
					<tr>
						<th>User Name</th>
						<th>Security Role</th>
						<th>Changed</th>
					</tr>
					<?PHP
					foreach ($users as $user){
						echo '<td><a href="user.php?selectedUser='.$user['user_name'].'">'.$user['user_name'].'</a></td>
									<td>'.$user['role'].'</td>
									<td>'.$user['date_created'].'</td>
								</tr>';
					}
					?>
				</table>
			</form>
		</div>
		<?php }
		else{
			echo '<div class="alert alert-danger">
				<strong>You do not have permission to access this page, please confirm with the system administrator</strong>
			</div>';
		}
		require 'footer.php';?>
	</body>
</html>
