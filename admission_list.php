<?PHP ?>
  <div class="col-sm-3 col-md-3 pull-right">
          <form class="navbar-form" role="search">
          <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" name="srch-admission" id="srch-admission">
              <div class="input-group-btn">
                  <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
              </div>
          </div>
          </form>
  </div>
  <table class="table table-striped">
  <tr>
  <form  method="POST">
		<h2 class="form-signin-heading">Admitted Patient List</h2>
    <th>Action</th>
    <th>Patient Name</th>
    <th>Admission Date</th>
    <th>Allergy</th>
		<th>Ward</th>
		<th>BedNo</th>
    <th>Action</th>
  </form>
  </tr>
  <?php
  if(isset($_REQUEST['srch-admission'])){
    $patients=$dao->getPatientPendingAdmission($_REQUEST['srch-term']);
    foreach($patients as $patient){
			$patientType="OP";
			if($patient['admitted']==1){
				$patientType="IP";
			}
      printf("<tr><td><a href=\"new_patient.php?SelectedPatient=%s\">View</a></td>
	    <td>%s</td>
	    <td>%s</td>
	    <td>%s</td>
			<td>%s</td>
			<td><a href=\"patient_admission.php?SelectedPatient=%s&selectedEncounter=%s&patientType=%s\">Admit</a></td>
	    </tr>",
	    $patient['patient_id'],
	    $patient['p_name'],
	    $patient['temperat'],
	    $patient['blood_pressure'],
			$patientType,
			$patient['patient_id'],
			$patient['encounter_id'],
			$patient['admitted']
	    );
    }
  }
  else{
    $admissions=$dao->getAdmissionList();
    foreach($admissions as $admission){
			$allergy=$dao->getAllergyById($admission['id']);
			$ward=$dao->getWardById($admission['ward']);
      $encounter=$dao->getEncounterByID($admission['encounter_id']);
      echo '<tr>';
			echo '<td><a href="patient_dashboard.php?selectedEncounter='.$admission['encounter_id'].'">View</a></td>';
			echo '<td>'.$admission['p_name'].'</td>';
			echo '<td>'.$admission['admission_date'].'</td>';
			echo '<td>'.$allergy['name'].'</td>';
			echo '<td>'.$ward['name'].'</td>';
      echo '<td>'.$admission['bed_no'].'</td>';
			if($encounter['allow_discharge']==1 && $encounter['bill_cleared']==1){
			echo '<td><a href="patient_discharge.php?SelectedPatient='.$encounter['patient_id'].'&selectedEncounter='.$admission['encounter_id'].'">Discharge</a></td>';
			}
			else{
				echo '<td></td>';
			}
			echo '</tr>';
    }
  }
  ?>
  </table>
