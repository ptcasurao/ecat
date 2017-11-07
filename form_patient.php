<!DOCTYPE html>
<html>
	<head>
		<title>Luke Foundation Eye Program: Patient Form</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="references/bootstrap.min.css">
		<link rel="stylesheet" href="references/font-awesome.min.css">
		<link rel="stylesheet" href="references/typeahead.css">
		<script src="references/jquery.min.js"></script>
		<script src="references/bootstrap.min.js"></script>
		<script src="references/typeahead.bundle.js"></script>
		<link rel="stylesheet" type="text/css" href="theme2.css">
	</head>
	<body style="justify-content: center;">
		<!-- HEAD AND NAVIGATION -->
		<?php include("nav.php"); ?>
		<!-- HEAD AND NAVIGATION END -->
		<div id="body">
			<!-- MAIN -->
			<div class="container-fluid" id="outer">
				<!-- TITLE -->
				<div class="container-fluid" style="color: #337ab7; text-shadow: 0px 0px 10px #ffffff; margin-bottom: 10px;">
					<h4>Eye Program: Patient Form</h4> 
				</div>
				<!-- TITLE -->

				<?php //CODE SECTION START
					//PATIENT INFORMATION FIELDS MAX CHAR VALUES
					$ID_LENG = 15;
					$PHYL_LENG = 50;
					$MAX_NAME = 40;
					$STAFFL_LENG = 50;
					$VD_MAX = 15;
					$DC_MAX = 30;
					$REA_MAX = 12;
					$LEA_MAX = 12;
					$VA_choice = array("U", "20/10", "20/12.5", "20/16", "20/20", "20/25", "20/32", "20/40", "20/50", "20/63","20/70", "20/80", "20/100", "20/120", "20/160", "20/200", "CF 1'", "CF 2'", "CF 3'", "CF 4'", "CF 5'", "CF 6'", "CF 7'", "CF 8'", "CF 9'", "CF 10'", "CF 11'", "CF 12'", "CF 13'", "CF 14'", "CF 15'", "CF 16'", "CF 17'", "CF 18'", "CF 19'", "CF 20'", "HM", "+LP", "-LP");
					//PATIENT INFORMATION FIELDS END
					
					//DETERMINE NEXT PAT_ID
					include('dbconnect.php');
					$current_year = getdate()['year'];
					$output = $mydatabase->prepare("select PAT_ID_NUM from EYEPATIENT where PAT_ID_NUM like 'CAT".$current_year."-%' order by PAT_ID_NUM DESC LIMIT 1");
					$output->execute();
					$line = $output->get_result();
					$dataline = $line->fetch_assoc();
					
					if(sizeof($dataline) == 0){
						$NEXT_ID = "CAT".$current_year."-000";
					}else{
						$LAST_VAL = explode("-", $dataline["PAT_ID_NUM"])[1];
						if(intval($LAST_VAL)+1 < 10){
							$NEXT_ID = "CAT".$current_year."-00".( (string) intval($LAST_VAL)+1);
						}else if(intval($LAST_VAL)+1 < 100){
							$NEXT_ID = "CAT".$current_year."-0".( (string) intval($LAST_VAL)+1);
						}else{
							$NEXT_ID = "CAT".$current_year."-".( (string) intval($LAST_VAL)+1);
						}
					}
					//DETERMINE NEXT PAT_ID END
					
					//CODE SECTION END
				?>

				<!-- PATIENT'S FORM -->
				<div class="container-fluid" id="basic" style="padding-top: 10px;">
					<div id="inner" style="background-color:;">
						<!-- CONTENT -->
						<div class="container-fluid" >
							<!-- FORMS -->
							<div class="container-fluid">
								<h3>Patient Information</h3>
								<hr>
								<p style="margin-bottom: 20px; color:#666666;">
									Please do not leave the required<span style="color: #d9534f">*</span> fields blank.
								</p>
								<form method="post" action="submit.php">
									<!-- PATIENT -->
									<div class="form-group row">
										<label class="control-label col-md-3" for="P_ID" style="float:left; width:170px;">Patient<span style="color: #d9534f">*</span> </label>
										<div class="" style="width: 180px; float: left; margin-right:10px;">
											<input type="text" class="form-control" id="P_ID" name="P_ID"  placeholder="Patient ID" maxlength="<?php echo $ID_LENG; ?>" value=<?php echo $NEXT_ID ?> required readonly>
										</div>
			  
										<div class="" style="width: 200px; float: left; margin-right:10px;">
											<input type="text" class="form-control" id="P_FNAME" placeholder="First Name" maxlength="20" name="P_FNAME" required>
										</div>
			  
										<div class="" style="width: 200px; float: left; margin-right:10px;">
											<input type="text" class="form-control" id="P_LNAME" placeholder="Last Name" maxlength="20" name="P_LNAME" required>
										</div>
									</div>
									<!-- PATIENT END-->
									<!-- PHIL HEALTH -->
									<div class="form-group row">
										<label class="control-label col-md-3" for="P_PH" style="float:left; width:170px;">Has PhilHealth?<span style="color: #d9534f">*</span> </label>
										<div class="col-md-4" style="width: 280px; float: left;">
											<label class="radio-inline" id="P_PH"><input name="P_PH" type="radio" value="Y">Yes</label>
											<label class="radio-inline" id="P_PH"><input name="P_PH" type="radio" value="N" required>No</label>
										</div>
									</div>
									<!-- PHIL HEALTH END -->
		
									<div class="row">
										<!-- PATIENT AGE AND SEX -->
										<div style="width:40%; float:left;">
										<div class="container-fluid well"  style="margin: 0px 15px;">
											<div class="form-group row">
												<label class="control-label col-md-2" for="P_AGE" style="float:left; width:90px;">Age:<span style="color: #d9534f">*</span> </label>
												<div class="col-md-3" style="width: 180px; float: left;">
													<input type="text" class="form-control" id="P_AGE" name="P_AGE" placeholder="Patient Age" maxlength="6" required>
												</div>
											</div>
											<div class="form-group row" style="margin-bottom:6px;">
												<label class="control-label col-md-2" for="P_SEX" style="float:left; width:90px;">Sex:<span style="color: #d9534f">*</span> </label>
												<div class="col-md-4" style="width: 180px; float: left;">
													<label class="radio-inline" id="P_SEX"><input name="P_SEX" type="radio" value="M" required>Male</label>
													<label class="radio-inline" id="P_SEX"><input name="P_SEX" type="radio" value="F">Female</label>
												</div>
											</div>
										</div>
									</div>

										<!-- PATIENT AGE AND SEX END -->
									<div style="width:60%; float: left;">
										<div class="container-fluid well" style="margin: 0px 15px;">
											<!-- PHYSICIAN LICENSE NUMBER -->
											<div class="form-group row">
												<label class="control-label" for="P_PHYLIC" style="float:left; width:30%; padding-left:15px;">Examined by:<span style="color: #d9534f">*</span> </label>
												<div class="col-md-2" style="width: 70%; float: left; ">
												<div class="input-group">
													<input pattern="^(([a-zA-Z](\w*)[ ][a-zA-Z](\w*)[-])*)(\d{7}$)" class="form-control typeahead tt-query" autocomplete="off" id="P_PHYLIC" placeholder="Physician Name or License" maxlength="<? echo $PHYL_LENG ?>" name="P_PHYLIC" required>
													<span class="input-group-addon" role="button" id="add_doctor" onclick="add_on_d()" data-toggle="modal" data-target="#add_new" ><span class="fa fa-stethoscope" style="padding:0px; margin:0px; font-size:16px; color:#337ab7;"></span></span>
												</div>
												</div>
											</div>
											<!-- PHYSICIAN LICENSE NUMBER END -->
											<!-- STAFF LICENSE NUMBER -->
											<div class="form-group row" style="margin-bottom:0px;">
												<label class="control-label" for="P_STAFFLIC" style="float:left; width:30%; padding-left:15px;">Screened by:<span style="color: #d9534f">*</span> </label>
												<div class="col-md-2" style="width: 70%; float: left; ">
												<div class="input-group">
													<input pattern="^(([a-zA-Z](\w*)[ ][a-zA-Z](\w*)[-])*)(\d{7}$)" class="form-control typeahead tt-query" autocomplete="off" id="P_STAFFLIC" placeholder="Staff Name or License" maxlength="<?php echo $STAFFL_LENG; ?>" name="P_STAFFLIC" required>
													<span class="input-group-addon" role="button" id="add_staff" onclick="add_on_s()" data-toggle="modal" data-target="#add_new"><span class="fa fa-user" style="padding:0px; margin:0px; font-size:16px; color:#337ab7;"></span></span>
												</div>
												</div>
											</div>
											<!-- STAFF LICENSE NUMBER END -->
										</div>
									</div>
								</div>
		  
									<!-- VISUAL ACUITY -->
									<div class="panel-group" style="margin-top:25px; margin-bottom:0px;">
										<div class="panel panel-default" style="">
											<div class="panel-heading" id="panelh">Pre Surgery Visual Acuity</div>
											<div class="panel-body">
												
												<table class="table">
													<thead>
														<th></th>
														<th>Left Eye Visual Acuity</th>
														<th>Right Eye Visual Acuity</th>
													</thead>
													<tbody>
														<tr>
															<td><strong>With Spectacles</strong><span style="color: #d9534f">*</span></td>
															<!-- LEFT EYE W/ SPECT -->
															<td>
																<select class="form-control" id="P_VASL1"  name="P_VASL1" style="width: 200px;" required>
																  <?php for ($j=0; $j < count($VA_choice); $j++) { 
																	echo "<option>".$VA_choice[$j]."</option>";
																   } ?>
																</select>
															</td>
															<!-- LEFT EYE W/ SPECT END-->
															
															<!-- RIGHT EYE W/ SPECT -->
															<td>
																<select class="form-control" id="P_VASR1"  name="P_VASR1" style="width: 200px;" required>
																  <?php for ($j=0; $j < count($VA_choice); $j++) { 
																	echo "<option>".$VA_choice[$j]."</option>";
																   } ?>
															   </select>
															</td>
															<!-- RIGHT EYE W/ SPECT END -->
														</tr>
														<tr>
															<td><strong>Without Spectacles</strong><span style="color: #d9534f">*</span></td>
															<!-- LEFT EYE W/OUT SPECT -->
															<td>
																<select class="form-control" id="P_VAL1"  name="P_VAL1" style="width: 200px;" required>
																  <?php for ($j=0; $j < count($VA_choice); $j++) { 
																	echo "<option>".$VA_choice[$j]."</option>";
																   } ?>
															   </select>
															</td>
															<!-- LEFT EYE W/OUT SPECT END-->
															
															<!-- RIGHT EYE W/OUT SPECT -->
															<td>
																<select class="form-control" id="P_VAR1"  name="P_VAR1" style="width: 200px;" required>
																  <?php for ($j=0; $j < count($VA_choice); $j++) { 
																	echo "<option>".$VA_choice[$j]."</option>";
																   } ?>
															   </select>
															</td>
															<!-- RIGHT EYE W/OUT SPECT END -->
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- VISUAL ACUITY END -->
									
									<div class="row">
										<div class="col-md-7">
											<!-- DESCRIPTION OF VISUAL PROBLEM -->
											<div class="panel-group" style="margin-top:25px;">
												<div class="panel panel-default" style="">
													<div class="panel-heading" id="panelh">Description of Visual Problem</div>
													<div class="panel-body">
														<!-- VISUAL DISABILITY -->
														<div class="form-group row">
															<label class="control-label col-md-1" for="P_VD" style="float:left; width:35%; float:left;">Visual Disability </label>
															<div class="col-md-4" style="width: 60%; float:left;">
															<div style="max-width:300px;">
																<input type="text" class="form-control" id="P_VD" placeholder="Patient's Visual Disability" maxlength="<?php echo $VD_MAX; ?>" name="P_VD">
															</div>
														</div>
														</div>
														<!-- VISUAL DISABILITY -->
														<!-- CAUSE OF DISABILITY -->
														<div class="form-group row">
															<label class="control-label col-md-1" for="P_DC" style="float:left; width:35%; float:left;">Cause </label>
															<div class="col-md-4" style="width: 60%; float:left;">
															<div style="max-width:300px;">
																<input type="text" class="form-control" id="P_DC" placeholder="Cause of Disability" maxlength="<?php echo $DC_MAX; ?>" name="P_DC">
															</div>
															</div>
														</div>
														<!-- CAUSE OF DISABILITY END -->
						  
														<!-- DIAGNOSIS -->
														<div class="form-group row">
															<label class="control-label col-md-1" for="P_DIAG" style="float:left; width:35%; float:left;">Diagnosis </label>
															<div class="col-md-4" style="width: 60%; float:left;">
															<div style="max-width:300px;">
																<input type="text" class="form-control" id="P_DIAG" placeholder="Doctor's Diagnosis" maxlength="15" name="P_DIAG">
															</div>
															</div>
														</div>
														<!-- DIAGNOSIS END -->
						  
														<!-- PROCEDURE -->
														<div class="form-group row">
															<label class="control-label col-md-1" for="P_PROC" style="float:left; width:35%;">Procedure </label>
															<div class="col-md-4" style="width: 60%; float:left;">
															<div style="max-width:300px;">
																<input type="text" class="form-control" id="P_PROC" placeholder="Procedure to do" maxlength="15" name="P_PROC">
															</div>
															</div>
														</div>
														<!-- PROCEDURE END -->
													</div>
												</div>
											</div>
											<!-- DESCRIPTION OF VISUAL PROBLEM END -->
										</div>
			
										<div class="col-md-5">
											<!-- AFFECTED EYE -->
											<div class="panel-group" style="margin-top:25px;">
												<div class="panel panel-default" style="">
													<div class="panel-heading" id="panelh">Affected Eye</div>
													<div class="panel-body">
														<!-- AFFECTED PART OF RIGHT EYE -->
														<div class="form-group row">
															<label class="control-label col-md-1" for="P_REA" style="float:left; width:40%; float:left;">Right Eye</label>
															<div class="col-md-4" style="width: 60%; float:left;">
															<div style="max-width:300px;">
																<input type="" class="form-control" id="P_REA" placeholder="Affected Area of Eye" maxlength="<?php echo $REA_MAX; ?>" name="P_REA">
															</div>
															</div>
														</div>
														<!-- AFFECTED PART OF RIGHT EYE END -->
							
														<!-- AFFECTED PART OF LEFT EYE -->
														<div class="form-group row">
															<label class="control-label col-md-1" for="P_LEA" style="float:left; width:40%; float:left;">Left Eye</label>
															<div class="col-md-4" style="width: 60%; float:left;">
															<div style="max-width:200px;">
																<input type="" class="form-control" id="P_LEA" placeholder="Affected Area of Eye" maxlength="<?php echo $LEA_MAX; ?>" name="P_LEA">
															</div>
															</div>
														</div>
														<!-- AFFECTED PART OF LEFT EYE END -->
													</div>
												</div>
											</div>
											<!-- AFFECTED EYE END -->
										</div>
									</div>
									<!-- ENTER -->
									<div class="text-center" style="margin-bottom: 20px;">
										<button type="submit" class="btn" id="go" name="patients_info">Submit</button>
									</div>
									<!-- ENTER END -->
								</form>
							</div>
							<!-- FORMS END -->
						</div>
						<!-- CONTENT END -->
					</div>
				</div>
				<?php
					//ERROR CHECKING

					//...code
				?>
			</div>
			<!-- MAIN END -->
		</div>
	</body>
</html>

<!--GO TO SECTION-->
<?php include("confirm.php");
?>

<script>
	function add_on_d(){
		document.getElementById("add_head").innerHTML = "Add New Doctor";
		document.getElementById("add_para").innerHTML = "doctor";
	}
	function add_on_s(){
		document.getElementById("add_head").innerHTML = "Add New Staff";
		document.getElementById("add_para").innerHTML = "staff";
	}
</script>

<!--GO TO SECTION END-->

<!--TYPE AHEAD SECTION-->

<?php
	include("dbconnect.php");
 $surgeon = $mydatabase->query("SELECT FIRST_NAME,LAST_NAME,DOC_LICENSE_NUM from DOCTOR");
 $arr = array();
 
 while ($row = $surgeon->fetch_assoc()) {
  unset($id, $name1, $name2);
  $id = $row['FIRST_NAME']." ".$row['LAST_NAME']."-".$row['DOC_LICENSE_NUM'];
  //$name1 = $row['FIRST_NAME'];
  //$name2 = $row['LAST_NAME'];
  array_push($arr, $id/*.", ".$name2." ".$name1*/);
 }
				
	$patient = $mydatabase->query("SELECT PAT_FNAME,PAT_LNAME,PAT_ID_NUM from EYEPATIENT");
    $arr1 = array();
    
 while ($row = $patient->fetch_assoc()) {
		unset($id, $name1, $name2);
  $id = $row['PAT_FNAME']." ".$row['PAT_LNAME']."-".$row['PAT_ID_NUM'];
  //$name1 = $row['FIRST_NAME'];
		//$name2 = $row['LAST_NAME'];
  array_push($arr1, $id/*.", ".$name2." ".$name1*/);    
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
		// Defining the local dataset
		var arrs= <?php echo json_encode($arr);?>;
		
		// Constructing the suggestion engine
		var arrs = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.whitespace,
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			local: arrs
		});
		
		// Initializing the typeahead
		$('.typeahead').typeahead({
			hint: true,
			highlight: true, /* Enable substring highlighting */
			minLength: 1 /* Specify minimum characters required for showing result */
		},
		{
			name: 'arrs',
			source: arrs
		});
	});
</script>

<!--TYPE AHEAD SECTION END-->
