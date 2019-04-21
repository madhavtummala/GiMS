<?php 	

require_once 'core.php';

$sql = "SELECT * FROM hosteladmin";

$result = $connect->query($sql);

$output = array('data' => array());
if($result->num_rows > 0) { 

	$active = ""; 

	while($row = $result->fetch_array()) {

		$roll = $row[0];

		$button = '<!-- Single button -->
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Action <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
		    <li><a type="button" data-toggle="modal" id="editUserModalBtn" data-target="#editUserModal" onclick="editUser(\''.$roll.'\')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
		    <li><a type="button" data-toggle="modal" data-target="#removeUserModal" id="removeUserModalBtn" onclick="removeUser(\''.$roll.'\')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
		  </ul>
		</div>';

		$output['data'][] = array( 		
			$roll,
			$row[1],
			$row[2],
			$button 		
		); 	
	}

}

// $connect->close();

echo json_encode($output);