<?php 	

require_once 'core.php';

$localhost = "localhost";
$username = "root";
$password = "root";

$hostel = new mysqli($localhost, $username, $password, $_SESSION['hostel']);

if($hostel->connect_error) {
    die("Connection Failed : " . $hostel->connect_error);
} else {
//   echo "Successfully connected";
}


$sql = "SELECT eid, name, status FROM equipment ORDER BY eid";
$result = $hostel->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {

 // $row = $result->fetch_array();
 $activeBrands = "";

 while($row = $result->fetch_array()) {
 	$brandId = $row[0];
 	// active
 	if($row[2] == 1) {
 		// activate member
 		$activeBrands = "<label class='label label-success'>Available</label>";
 	} else {
 		// deactivate member
 		$activeBrands = "<label class='label label-danger'>Not Available</label>";
 	}

 	$button = '
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands('.$brandId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

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