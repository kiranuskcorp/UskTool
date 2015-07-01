<!DOCTYPE html>
<html lang="en">
<body>

	<div class="container-fluid">
		
		<div class="row">
			<p>
			<b class="labelData">Trainee</b>
				<a href="?content=38" class="btn btn-default"><i
					class="fa fa-plus-square"></i>&nbsp;Add</a> <a
					href="./Excels/traineeexcel.php" class="btn btn-default btn-lg "
					role="button"><i class="fa fa-file-excel-o"></i> export</a> 
			</p>


			<!--  <div class="input-group"> <span class="input-group-addon">Search</span>

               <input id="example" type="text" class="form-control" placeholder="Type here..."> -->

			Search:<input id="filter" type="text" /><label id="DeletedRecord" style="display: none">Record Deleted successfully!!</label>
			<table data-filter="#filter" class="footable">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Technology</th>
						<th>Batch</th>
						<th>Fee Status</th>
						<th>Client</th>
						<th>Skype Id</th>
						<th>Tz</th>
						<!-- <th>Description</th> -->
						<th data-sort-ignore="true">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					header("Cache-Control:no-cache");
					$path = $_SERVER['DOCUMENT_ROOT'];
					$path .= "/layout/connection/GlobalCrud.php";
					include_once($path);
					$delete="traineeDelete";
					
					$data = null;
					if (isset($_GET['BatchId'])) {
						$data = GlobalCrud::getAllRecordsBasedOnId('traineeSelectByBatchId',array($_GET['BatchId']));
					}else{
					
						$data = GlobalCrud::getData('traineeSelect');
					}
					
					
					
					$count = 0;
					foreach ($data as $row) {
						$emailTd = '<td></td>';
						if(!empty($row['email'])){
							$emailTd = '<td> <i class="fa fa-envelope"></i> '. $row['email'] . '</td>';
						}
						$batchTd='<td></td>';
						if(!empty($row['batch_id'])){
							$batchTd='<td> '.$row['batch_id'].'</td>';						
						}
						$phoneTd = '<td></td>';
						if(!empty($row['phone'])){
							if(!empty($row['alternate_phone'])){
							$phoneTd = '<td> <i class="fa fa-phone"></i> '. $row['phone'] .'/'. $row['alternate_phone'] . '</td>';
							}else{
								$phoneTd = '<td> <i class="fa fa-phone"></i> '. $row['phone'].'</td>';
							}
						}
						echo '<tr>';
						echo '<td>'. $row['name']  . '</td>';
						echo $emailTd;
						echo $phoneTd;
						echo '<td>'. $row['technology_name'] . '</td>';
						echo $batchTd;
						echo '<td>'. $row['trainee_fee_status'] . '</td>';
						echo '<td>'. $row['client_name'] . '</td>';
						echo '<td>'. $row['skype_id'] . '</td>';
						echo '<td>'. $row['timezone'] . '</td>';
						echo '<td nowrap="nowrap">';
						echo '<a href="#" data-toggle="tooltip" title="'. $row['description'] . '"><i class="fa fa-caret-square-o-up"></i></a>';
						echo '<a href="?content=39&id='.$row['id'].'"> <i class="fa fa-pencil-square"></i></a>';
						//echo '<a href="?content=37&id='.$row['id'].'" onclick="return confirm(\'Are you sure you want to delete?\')" > <i class="fa fa-trash"></i></a>';//'?content=16&id='.$row['id'].'
						echo '<a href="#"  onClick=delFromHome('.$row['id'].',"traineeDelete") > <i class="fa fa-trash"></i></a>';//'?content=16&id='.$row['id'].'
						echo '</td>';
						echo '</tr>';
						$count ++;
					}

					
						  ?>
						  <br> Total Number Of Trainees:
					<?php echo $count;?>
				</tbody>
			</table>
			<label id="NoRowsAvailable" style="display: none">  No result matched for search criteria	</label>
		</div>
	</div>
	<!-- /container -->
</body>
</html>
