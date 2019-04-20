<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST){

	$request = $_POST['request'];
	$invoice = $_POST['editBrandInvoice'];
	$name = $_POST['editBrandName'];
	$cost = $_POST['editBrandCost'];

	$sql = "SELECT * FROM requests WHERE requestno = '$request'";
	$result = $hostel->query($sql);
	$row = $result->fetch_array();

	$sql = "INSERT INTO equipment values(NULL, '$row[1]', 1, curdate(), '$row[3]', '$invoice')";
	if($hostel->query($sql) === true) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";

		if($name){
			$sql = "UPDATE equipment SET name='$name' WHERE invoiceno='$invoice'";
			$hostel->query($sql);
		}	
		if($cost){
			$sql = "UPDATE equipment SET cost='$cost' WHERE invoiceno='$invoice'";
			$hostel->query($sql);			
		}

		$sql = "DELETE FROM requests WHERE requestno = '$request'";
		$result = $hostel->query($sql);

	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the equipment";
	}	

	$hostel->close();

	echo json_encode($valid);
 
}