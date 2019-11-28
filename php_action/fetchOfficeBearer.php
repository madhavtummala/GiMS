<?php 	

require_once 'core.php';

if($_SESSION['userId']!=1) {
    header('location: dashboard.php');
}

$sql = "SELECT * FROM officebearer";

$result = $connect->query($sql);

$output = array('data' => array());
if($result->num_rows > 0) { 

	$active = ""; 

	while($row = $result->fetch_array()) {

		$email = $row[3];

		$button = '<!-- Single button -->
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Action <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
		    <li><a type="button" data-toggle="modal" id="editUserModalBtn" data-target="#editUserModal" onclick="editUser(\''.$email.'\')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
		    <li><a type="button" data-toggle="modal" data-target="#removeUserModal" id="removeUserModalBtn" onclick="removeUser(\''.$email.'\')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
		  </ul>
		</div>';

		$output['data'][] = array( 	
			$row[1],
			$email,
			$row[4],
			$row[0],
			$button 		
		); 	
	}

}

// $connect->close();

echo json_encode($output);