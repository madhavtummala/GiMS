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
	echo "im here";
	if($stmt->execute()) {
		echo "IM here";
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";

		/*$result=$hostel->query("select max(eid) as a from equipment");
		$value=result->fetch_assoc();
		$eid=value['a'];

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
		}*/

		//$sql2 = "DELETE FROM requests WHERE requestno = '$request'";
		//$result = $hostel->query($sql2);

	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the equipment";
	}	

	$hostel->close();
	echo json_encode($valid);
 
}
