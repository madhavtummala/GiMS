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

	$sql = "INSERT INTO equipment values(NULL, '$row[1]', 1, curdate(), '$row[3]', ?)";
	
	$stmt = $hostel->prepare($sql);
	$stmt->bind_param("s", $invoice);

	if($stmt->execute()) {

		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";

		$sql = "SELECT max(eid) AS a FROM equipment";

		$result=$hostel->query($sql);
		$value=$result->fetch_assoc();
		$eid=$value['a'];

		if($name){
			$sql = "UPDATE equipment SET name=? WHERE eid='$eid'";
			$stmt = $hostel->prepare($sql);
			$stmt->bind_param("s", $name);
			$stmt->execute();
		}	
		if($cost){
			$sql = "UPDATE equipment SET cost=? WHERE eid='$eid'";
			$stmt = $hostel->prepare($sql);
			$stmt->bind_param("i", $cost);
			$stmt->execute();			
		}

		$sql = "DELETE FROM requests WHERE requestno = '$request'";
		$result = $hostel->query($sql);

	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the equipment";
	}	

	echo json_encode($valid);
 
}
