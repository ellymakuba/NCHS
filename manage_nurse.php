<?PHP
	require 'data_access_object.php';
	$dao=new DAO();
	$dao->checkLogin();
  ?>
  <html>
  <?PHP $dao->includeHead('Admission List',0) ?>
  </head>
  <body class="container">
  <?PHP $dao->includeMenu(2); ?>
	<div id="menu_main">
		<a href="manage_nurse.php" id="item_selected">Active Encounters</a>
    </div>
  <div class="table-responsive">
    <div class="col-sm-3 col-md-3 pull-right">
          <form class="navbar-form" role="search">
          <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
              <div class="input-group-btn">
                  <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
              </div>
          </div>
          </form>
  </div>
  <table class="table table-striped">
  <tr>
  <form  method="POST">
		<h2 class="form-signin-heading">Awaiting Admission</h2>
    <th>Action</th>
          <th>Patient Name</th>
          <th>Temperature</th>
          <th>Blood Pressure</th>
					<th>Patient Type</th>
					<th>Action</th>
  </form>
  </tr>
  <?php
  if(isset($_REQUEST['srch-term'])){
    $patients=$dao->getPatientActiveEncounter($_REQUEST['srch-term']);
    foreach($patients as $patient){
			$patientType="OP";
			if($patient['admitted']==1){
				$patientType="IP";
			}
			echo '<tr>';
			echo '<td><a href="new_patient.php?SelectedPatient='.$patient['patient_id'].'">Edit</a></td>';
			echo '<td>'.$patient['p_name'].'</td>';
			echo '<td>'.$patient['temperature'].'</td>';
			echo '<td>'.$patient['blood_pressure'].'</td>';
			echo '<td>'.$patientType.'</td>';
			echo '<td><a href="patient_admission.php?SelectedPatient='.$patient['patient_id'].'&selectedEncounter='.$patient['encounter_id'].
			'&patientType='.$patient['admitted'].'">Edit</a></td>';
			echo '</tr>';
    }
  }
  else{
    $patients=$dao->getPatientActiveEncounterList();
    foreach($patients as $patient){
			$patientType="OP";
			if($patient['admitted']==1){
				$patientType="IP";
			}
			echo '<tr>';
			echo '<td><a href="new_patient.php?SelectedPatient='.$patient['patient_id'].'">Edit</a></td>';
			echo '<td>'.$patient['p_name'].'</td>';
			echo '<td>'.$patient['temperature'].'</td>';
			echo '<td>'.$patient['blood_pressure'].'</td>';
			echo '<td>'.$patientType.'</td>';
			echo '<td><a href="patient_admission.php?SelectedPatient='.$patient['patient_id'].'&selectedEncounter='.$patient['encounter_id'].
			'&patientType='.$patient['admitted'].'">Edit</a></td>';
			echo '</tr>';
    }
  }
  echo '</table>';
	require 'admission_list.php';
	?>
  </div>
  </body>
  </html>
