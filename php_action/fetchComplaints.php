<?php 	

require_once 'core.php';

if($_SESSION['userId']>2) {
    header('location: dashboard.php');
}

$sql = "SELECT * FROM complaints WHERE status = 1";
$result = $connect->query($sql);

$output = array('data' => array());
if($result->num_rows > 0) { 

	$active = ""; 

	while($row = $result->fetch_array()) {

		$request = $row[0];

		$button = '<!-- Single button -->
		<div class="btn-group">
		    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$request.')"> <i class="glyphicon glyphicon-ok"></i> Accept</a></li>
		    <li><a type="button" data-toggle="modal" data-target="#removeMemberModel" onclick="removeBrands('.$request.')"> <i class="glyphicon glyphicon-remove"></i> Dismiss</a></li>      
		</div>';

		$output['data'][] = array(
			$row[1],
			$row[3],
			$row[4],
			$row[5],
			$row[6],
			$button 		
		); 	
	}

}

// $hostel->close();

echo json_encode($output);