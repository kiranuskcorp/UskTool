<?php 

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/layout/connection/GlobalCrud.php";
include_once($path);
$traineeData = GlobalCrud::getData('traineeSelect');
$employeeData = GlobalCrud::getData('employeeSelect');
$timeConstants = explode(',', GlobalCrud::getConstants("timeConstants"));
$supportConstants = explode(',', GlobalCrud::getConstants("supportConstants"));
$id = null;
date_default_timezone_set("Asia/Kolkata");
if ( !empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

if ( null==$id ) {
	header("Location: index.php?content=40");
}

if ( !empty($_POST)) {
	//supportedby traineeid startdate enddate allottedtime endclient status technologyused description
	$traineeid = $_POST['traineeid'];
	$supportedby=$_POST['supportedby'];
	$startdate=$_POST['startdate'];
	$enddate=$_POST['enddate'];
	$allottedtime=$_POST['allottedtime'];
	$endclient=$_POST['endclient'];
	$status=$_POST['status'];
	$technologyused=$_POST['technologyused'];
	$updateddate =  date("Y/m/d");
	$description = $_POST['description'];

	// validate input
	$valid = true;
	if (empty($traineeid)) {
		$valid = false;
	}
	if (empty($supportedby)) {
		$valid = false;
	}
	if (empty($startdate)) {
		$valid = false;
	}
	


	// update data
	if ($valid) {
		$sql = "supportUpdate";
		$sqlValuesForUpdate = array($traineeid,$supportedby,$startdate,$enddate,$allottedtime,$endclient,$status,$technologyused,$updateddate,$description,$id);
		GlobalCrud::update($sql,$sqlValuesForUpdate);
		header("Location:../?content=40");
	}
}

else {
	$sql = "supportSelectById";
	$sqlValues = array($id);
	$data = GlobalCrud::selectById($sql,$sqlValues);
	$traineeid = $data['trainee_id'];
	$supportedby=$data['supported_by'];
	$startdate=$data['start_date'];
	$enddate=$data['end_date'];
	$allottedtime=$data['allotted_time'];
	$endclient=$data['end_client'];
	$status=$data['status'];
	$technologyused=$data['technology_used'];
	//$createdDate = $data['created_date'];
	//$updatedDate = $data['updated_date'];
	$description = $data['description'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
function validate(){
	var supportedbyid =document.getElementById("supportedbyid").value;
	var traineeid =document.getElementById("traineeid").value;
	if(supportedbyid==0 ){
		
		document.getElementById("supportedbyidError").innerHTML="Employee Name Is Required";
		return false;
	}
	else if(traineeid==0){
		document.getElementById("traineeidError").innerHTML="Trainee Name Is Required";
		return false;
	} 
	else{
		location.reload();
		return true;
	}
}
</script>
</head>

<body>
	<div class="container">

		<div class="span10 offset1">
			<div class="row">
				<h3>Update a Support</h3>
			</div>

			<form class="form-horizontal"
				action="./support/update.php?id=<?php echo $id?>" method="post" onsubmit="return validate()">



				<div class="control-group">
				<div class="form-group required">
					<label class="control-label">Employee Name</label>
					<div class="controls">
						<select name="supportedby" id="supportedbyid">
							<option value="0">Select</option>
							<?php foreach ($employeeData as $row): ?>
							<option <?php if($row['id'] == $supportedby) {  ?>
								selected="selected" value="<?=$row['id']?>">
								<?php
}
else {
								?>
								value="<?=$row['id']?>" >
								<?php
							}
							echo $row ['name'];
							?>
							</option>

							<?php endforeach ?>
						</select><span id="supportedbyidError" style="color: red"></span>
						</div>
					</div>
				</div>


				<div class="control-group">
				<div class="form-group required">
					<label class="control-label">Trainee Name</label>
					<div class="controls">
						<select name="traineeid" id="traineeid">
							<option value="0">Select</option>
							<?php foreach ($traineeData as $row): ?>
							<option <?php if($row['id'] == $traineeid) {  ?>
								selected="selected" value="<?=$row['id']?>">
								<?php
}
else {
								?>
								value="<?=$row['id']?>" >
								<?php
							}
							echo $row ['name'];
							?>
							</option>

							<?php endforeach ?>
						</select><span id="traineeidError" style="color: red"></span>
						</div>
					</div>
				</div>


				<div class="control-group">
				<div class="form-group required">
					<label class="control-label">Start Date</label>
					<div class="controls">
						<input name="startdate" type="date" placeholder="start date"
							value="<?php echo !empty($startdate)?$startdate:'';?>" required>
</div>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">End Date</label>
					<div class="controls">
						<input name="enddate" type="date" placeholder="end date"
							value="<?php echo !empty($enddate)?$enddate:'';?>" >

					</div>
				</div>


				<div class="control-group">
					<label class="control-label">Allotted Time</label>
					<div class="controls">
						<select name="allottedtime" type="text">
						<option value="">Select</option>
							<?php foreach ($timeConstants as $timeConstant): ?>
							<option <?php if($timeConstant == $allottedtime) {?>
								selected="selected" value="<?=$timeConstant?>">
								<?php }else {?>
								value="<?=$timeConstant?>">
								<?php }
								echo $timeConstant;
								?>
							</option>

							<?php endforeach ?>
							</option>
						</select>
					</div>
				</div>



				<div class="control-group">
					<label class="control-label">End Client</label>
					<div class="controls">
						<input name="endclient" type="text" placeholder="end client"
							value="<?php echo !empty($endclient)?$endclient:'';?>" >

					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Status</label>
					<div class="controls">
						<select name="status" type="text">
							<option value="none">Select</option>
							<?php foreach ($supportConstants as $supportConstant): ?>
							<option <?php if($supportConstant == $status) {?>
								selected="selected" value=" <?=$supportConstant?>">
								<?php }else {?>
								value="<?=$supportConstant?>">
								<?php }
								echo $supportConstant;
								?>
							</option>

							<?php endforeach ?>
							</option>
						</select>
					</div>
				</div>


				<div class="control-group">
					<label class="control-label">Technology Used</label>
					<div class="controls">
						<input name="technologyused" type="text"
							placeholder="technology used"
							value="<?php echo !empty($technologyused)?$technologyused:'';?>"
							>

					</div>
				</div>

				<!-- <div class="control-group"> 
					    <label class="control-label">Created Date</label>
					    <div class="controls">
					      	<input name="createdDate" type="date" placeholder="Created Date" value="<?php echo !empty($createdDate)?$createdDate:'';?>" required>
					      	
					    </div>
					  </div>
					  <div class="control-group"> 
					    <label class="control-label">Updated Date</label>
					    <div class="controls">
					      	<input name="updatedDate" type="date"  placeholder="Updated Date" value="<?php echo !empty($updatedDate)?$updatedDate:'';?>" required>
					      
					    </div>
					  </div> -->

				<div class="control-group">
					<label class="control-label">Description</label>
					<div class="controls">
						<textarea name="description" type="text" placeholder="description">
							<?php echo !empty($description)?$description:'';?>
					      		</textarea>
					</div>
				</div>

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Update</button>
					<a class="btn" href="index.php">Back</a>
				</div>
			</form>
		</div>

	</div>
	<!-- /container -->
</body>
</html>
