<?PHP
	require 'data_access_object.php';
	$dao=new DAO();
	$dao->checkLogin();
  ?>
  <html>
  <?PHP $dao->includeHead('Patient List',0) ?>
  </head>
  <body class="container">
  <?PHP $dao->includeMenu(3); ?>
	<div id="menu_main">
    <a href="manage_doctor.php" id="item_selected">Encounter List</a>
		<a href="appointment_list.php">Appointments</a>
		<a href="new_appointment.php">New Appointment</a>
    </div>
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
  <form  method="POST">
    <th>#</th>
          <th>Patient Name</th>
          <th>Temperature</th>
          <th>Blood Pressure</th>
					<th>Patient Type</th>
					<th>Action</th>
  </form>
  </tr>
  <?php
  if(isset($_REQUEST['srch-term'])){
    $patients=$dao->getPatientPendingEncounters($_REQUEST['srch-term']);
    foreach($patients as $patient){
			$patientType="OP";
			if($patient['admitted']==1){
				$patientType="IP";
			}
      printf("<tr><td><a href=\"new_patient.php?SelectedPatient=%s\">" .$patient['patient_id'] . "</a></td>
	    <td>%s</td>
	    <td>%s</td>
	    <td>%s</td>
			<td>%s</td>
			<td><a href=\"new_appointment.php?SelectedPatient=%s&selectedEncounter=%s&patientType=%s\">New Appointment</a></td>
	    </tr>",
	    $patient['patient_id'],
	    $patient['p_name'],
	    $patient['temperature'],
	    $patient['blood_pressure'],
			$patientType,
			$patient['patient_id'],
			$patient['encounter_id'],
			$patient['admitted']
	    );
    }
  }
  else{
    $patients=$dao->getNewPatientEncounters();
    foreach($patients as $patient){
			$patientType="OP";
			if($patient['admitted']==1){
				$patientType="IP";
			}
			printf("<tr><td><a href=\"new_patient.php?SelectedPatient=%s\">" .$patient['patient_id'] . "</a></td>
	    <td>%s</td>
	    <td>%s</td>
	    <td>%s</td>
			<td>%s</td>
			<td><a href=\"new_appointment.php?SelectedPatient=%s&selectedEncounter=%s&patientType=%s\">New Appointment</a></td>
	    </tr>",
	    $patient['patient_id'],
	    $patient['p_name'],
	    $patient['temperature'],
	    $patient['blood_pressure'],
			$patientType,
			$patient['patient_id'],
			$patient['encounter_id'],
			$patient['admitted']
	    );
    }
  }
  ?>
  </table>
    </div>
  </body>
  </html>
