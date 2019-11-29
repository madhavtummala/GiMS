<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST){

	$brandId = $_POST['brandId'];
	$assignee = $_POST['assignee'];
	$sql = "SELECT name from officebearer WHERE emailid = '$assignee'";
	$result = $forms->query($sql);
	$result = $result->fetch_array();
	$name = $result[0];
	if($brandId) { 

	 $sql = "UPDATE currentapplications set assignee = '$name' WHERE formid = '$brandId'";

	 if($forms->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Rejected";
		$sql = "UPDATE currentapplications set assignee_email = '$assignee' WHERE formid = '$brandId'";
		$forms->query($sql);
		$sql = "UPDATE currentapplications set status = 3 WHERE formid = '$brandId'";
		
		if($forms->query($sql) === TRUE)
		{
			$valid['success'] = true;
			$valid['messages'] = "Successfully Rejected";
		}
		else
		{
			$valid['success'] = false;
			$valid['messages'] = "Error while updating the Item (Maybe Constraint error)";
		}

	 } else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the Item (Maybe Constraint error)";
	 }
	 
	 $forms->close();

	 echo json_encode($valid);
	 
	}
}