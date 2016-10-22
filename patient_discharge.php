<?PHP
	require 'data_access_object.php';
	$dao=new DAO();
	$dao->checkLogin();
	if (isset($_POST['discharge'])){
		if(isset($_SESSION['encounter']) && isset($_SESSION['patient'])){
			  $dao->closePatientEncounter($_SESSION['encounter']);
				$dao->dischargePatient($_SESSION['encounter']);
				unset($_SESSION['encounter']);
				unset($_SESSION['patient']);
				header('Location:manage_nurse.php');
			}
	}
  ?>
  <html>
  <?PHP $dao->includeHead('Patient Discharge',0) ?>
	<script>
	</script>
  </head>
  <body class="container">
    <?PHP $dao->includeMenu(2); ?>
  	<div id="menu_main">
      <a href="manage_nurse.php">Active Encounters</a>
			<a href="admission_list.php">Admission List</a>
  		<a href="patient_discharge.php" id="item_selected">Discharge Patient</a>
      </div>
      <?php
			if(isset($_REQUEST['SelectedPatient']) && isset($_REQUEST['selectedEncounter'])){
				$_SESSION['patient']=$_REQUEST['SelectedPatient'];
				$_SESSION['encounter']=$_REQUEST['selectedEncounter'];
			}
			if(isset($_SESSION['patient'])){
				$encounter=$dao->getEncounterByID($_SESSION['encounter']);
				$patient=$dao->getPatientByID($_SESSION['patient']);
				$admission=$dao->getAdmissionByEncounterId($_SESSION['encounter']);
				if(isset($_REQUEST['SelectedAdmission'])){
        $_SESSION['patient_id']=$_REQUEST['SelectedPatient'];
      ?>
			<form class="form-signin" method="POST"  action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<h2 class="form-signin-heading">Edit Discharge</h2>
				</form>
  <?php }
  else{
		?>
		<form class="form-signin" method="POST"  action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<h2 class="form-signin-heading">Discharge Patient</h2>
			<div class="form-inline">
				<label for="patient_id">Patient ID:</label>
				<input type="text"  name="patient_id" class="form-control" style="width:90%;float:right;"
				placeholder="Patient Name" required value="<?php echo $patient['patient_id']?>" readonly="">
			</div>
			<div style="clear:both;"></div>
			<div class="form-inline">
				<label for="patient_name">Patient Name:</label>
				<input type="text"  name="patient_name" class="form-control" style="width:90%;float:right;"
				placeholder="Patient Name" required value="<?php echo $patient['p_name']; ?>" readonly="">
			</div>
			<div style="clear:both;"></div>
			<div class="form-inline">
				<label for="encounter_date">Admission Date:</label>
				<input type="text"  name="encounter_date" class="form-control" style="width:90%;float:right;"
				placeholder="Encounter Date" required value="<?php echo $admission['admission_date']; ?>" readonly="">
			</div>
			<div style="clear:both;"></div>
			<div class="form-inline">
				<label for="ward">Ward:</label>
				<input type="text"  name="ward" class="form-control" style="width:90%;float:right;"
				placeholder="Ward" value="<?php echo $admission['ward_name']; ?>" readonly="">
			</div>
			<div style="clear:both;"></div>
		<div style="clear:both;"></div>
		<div class="form-inline">
			<label for="bed_no">Bed Number:</label>
			<input type="number"  name="bed_no" class="form-control"  style="width:90%;float:right;" value="<?php echo $admission['bed_no']; ?>" readonly="">
		</div>
		<div style="clear:both;"></div>
		<?php if($encounter['bill_cleared']==1){?>
			<input type="submit" name="discharge" class="btn btn-lg btn-primary" value="Discharge Patient"
					style="display: block; margin: 0 auto;width:200px;"></input>
	<?php }?>
			</form>
</div>
      <?php }}?>
  </body>
  </html>
