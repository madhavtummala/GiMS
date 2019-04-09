<?php 

require_once 'core.php';

if($_POST) {

	$equipmentName = $_POST['equipmentName'];
	$estimatedCost = $_POST['estimatedCost'];
	$purchaseLinks = $_POST['purchaseLinks'];
	$reason = $_POST['reason'];
	
	$sql2 = "insert into requests values('$equipmentName', '$_SESSION['userId']', '$query->fetch_assoc()['hostelname']', $estimatedCost, '$purchaseLinks', '$reason')";
	
	$query2 = $connect->query($sql);

	echo "Request successful.";

}

?>
