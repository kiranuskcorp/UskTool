<!DOCTYPE html>
<html lang="en">


<body>
    <div  class="container-fluid">
	
			<div class="row">
				<p>
				<b class="labelData">Course</b>
					<a href="?content=26" class = "btn btn-default"><i class="fa fa-plus-square"></i>&nbsp;Add</a>
					<a href="./Excels/courseexcel.php" class="btn btn-default btn-lg " role="button" ><i class="fa fa-file-excel-o"></i> export</a>
				</p>
				Search:<input id="filter" type="text" /><label id="DeletedRecord" style="display: none">Record Deleted successfully!!</label>
			<table data-filter="#filter" class="footable" id="mytable">
		              <thead>
		                <tr>
		                 
		                  <th>Technology Name</th>
		                  <th>Name</th>
		                  <th>Estimated Hours</th>
		                  <!-- <th>Created Date</th>
		                  <th>Updated Date</th> 
		                   <th>Description</th>-->
		                   <th data-sort-ignore="true">Actions</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
		               $path = $_SERVER['DOCUMENT_ROOT'];
   					   $path .= "/layout/connection/GlobalCrud.php";
   					   include_once($path);
   					   date_default_timezone_set("Asia/Kolkata");
   					   $count = 0;
					   $data = GlobalCrud::getData('courseSelect');
					   foreach ($data as $row) {
						   		echo '<tr>';
						   		echo '<td>'. $row['technology_name'] . '</td>';
							   	echo '<td>'. $row['name'] . '</td>';
							   	echo '<td>'. $row['est_hrs'] . '</td>';
							   	echo '<td nowrap="nowrap">';
							   	echo '<a href="#" data-toggle="tooltip" title="'. $row['description'] . '"> <i class="fa fa-caret-square-o-up"></i></a>';
							   	echo '<a href="?content=27&id='.$row['id'].'"> <i class="fa fa-pencil-square"></i></a>';
							   	echo '<a href="#"  onClick=delFromHome('.$row['id'].',"courseDelete") > <i class="fa fa-trash"></i></a>';//'?content=16&id='.$row['id'].'
							   	echo '</td>';
							   	echo '</tr>';
							   	$count++;
					   }

					  function deleteRecord($idValue) {
									$sql = "courseDelete";
									$sqlValues = $idValue;
									GlobalCrud::delete($sql,$sqlValues);
									header("Location:./?content=25");
								}

						  if (isset($_GET['id'])) {
						    deleteRecord($_GET['id']);
						  } 
					  ?>
					  <br> Total Number Of Courses:
					<?php echo $count;?>
				      </tbody>
	            </table>
	            <label id="NoRowsAvailable" style="display: none">  No result matched for search criteria	</label>
    	</div>
    </div> <!-- /container -->
  </body>
</html>