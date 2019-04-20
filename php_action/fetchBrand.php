<?php 	

require_once 'core.php';

$sql = "SELECT eid, name, status FROM equipment ORDER BY eid";
$result = $hostel->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {

 $activeBrands = "";

 while($row = $result->fetch_array()) {
 	$brandId = $row[0];

 	if($row[2] == 1)
 		$activeBrands = "<label class='label label-success'>Available</label>";
 	else if($row[2] == 0)
 		$activeBrands = "<label class='label label-danger'>Issued</label>";
 	else if($row[2] == 2)
 		$activeBrands = "<label class='label label-danger'>Under Repair</label>";
 	else
 		$activeBrands = "<label class='label label-danger'>Lost</label>";

 	if($_SESSION['userId']==1)
 	{
	 	$button = '<!-- Single button -->
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Action <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
		    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
		    <li><a type="button" data-toggle="modal" data-target="#removeMemberModel" onclick="removeBrands('.$brandId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
		  </ul>
		</div>';
	}
	else
	{
	 	$button = '<!-- Single button -->
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Action <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
		    <li><a type="button" data-toggle="modal" data-target="#issueBrandModel" onclick="issueBrands('.$brandId.')"> <i class="glyphicon glyphicon-plus"></i> Issue</a></li>
		    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>      
		  </ul>
		</div>';		
	}

 	$output['data'][] = array(
 		$row[0],
 		$row[1],
 		$activeBrands,
 		$button
 		);
 }

}

$hostel->close();

echo json_encode($output);