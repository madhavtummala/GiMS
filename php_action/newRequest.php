<?php 

require_once 'core.php';

if($_POST) {

	$equipmentName = $_POST['equipmentName'];
	$estimatedCost = $_POST['estimatedCost'];
	$purchaseLinks = $_POST['purchaseLinks'];
	$reason = $_POST['reason'];
	$rollnum = $_SESSION['userId'];

	$sql = "INSERT INTO requests VALUES(NULL, '$equipmentName', '$rollnum', '$estimatedCost', '$purchaseLinks', '$reason', CURRENT_TIMESTAMP)";

	$query = $hostel->query($sql);

	if($query===true)
	{
		$valid['success'] = true;
		$valid['messages'] = "Request Successfully Registered.";
	} 
	else
	{
		$valid['success'] = false;
		$valid['messages'] = $sql;	
	}
	echo json_encode($valid);
}

$hostel->close();

?>
