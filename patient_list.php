<?PHP
	require 'data_access_object.php';
	$dao=new DAO();
	$dao->checkLogin();
	$pageSecurity=12;
	?>
  <html>
  <?PHP $dao->includeHead('Patient List',0) ?>
  </head>
  <body class="container">
  <?PHP $dao->includeMenu(1); ?>
	<div id="menu_main">
    <a href="patient_list.php" id="item_selected">Patient List</a>
    <a href="new_patient.php">New Patient</a>
    </div>
		<?php if(in_array($pageSecurity, $_SESSION['AllowedPageSecurityTokens'])){?>
  <div class="table-responsive">
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
  <div class="col-sm-3 col-md-3 pull-right">
    <a href="new_patient.php" class="btn btn-default btn-primary">New Patient</a>
  </div>
  <table class="table table-striped">
  <tr>
  <form action="#list_drug" method="POST">
    <th>#</th>
          <th>Patient Name</th>
          <th>Age</th>
          <th>Phone</th>
					<th>New</th>
  </form>
  </tr>
  <?php
  if(isset($_REQUEST['srch-term'])){
    $patients=$dao->getPatientByName($_REQUEST['srch-term']);
    foreach($patients as $patient){
      printf("<tr><td><a href=\"new_patient.php?SelectedPatient=%s\">" .$patient['patient_id'] . "</a></td>
    <td>%s</td>
    <td>%s</td>
    <td>%s</td>
		<td><a href=\"new_encounter.php?SelectedPatient=%s\">New Encounter</a></td>
    </tr>",
    $patient['patient_id'],
    $patient['p_name'],
    $patient['age'],
    $patient['phno'],
		$patient['patient_id']
    );
    }
  }
  else{
    $patients=$dao->getAllPatients();
    foreach($patients as $patient){
      printf("<tr><td><a href=\"new_patient.php?SelectedPatient=%s\">" .$patient['patient_id'] . "</a></td>
    <td>%s</td>
    <td>%s</td>
    <td>%s</td>
		<td><a href=\"new_encounter.php?SelectedPatient=%s\">New Encounter</a></td>
    </tr>",
    $patient['patient_id'],
    $patient['p_name'],
    $patient['age'],
    $patient['phno'],
		$patient['patient_id']
    );
    }
  }
  ?>
  </table>
    </div>
		<?php }else{
			echo '<div class="alert alert-danger">
				<strong>You do not have permission to access this page, please confirm with the system administrator</strong>
			</div>';
		}
		require 'footer.php';?>
  </body>
  </html>
