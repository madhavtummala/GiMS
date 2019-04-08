<?php 

require_once 'core.php';

if($_POST) {

	$equipmentName = $_POST['equipmentName'];
	$estimatedCost = $_POST['estimatedCost'];
	$purchaseLinks = $_POST['purchaseLinks'];
	$reason = $_POST['reason'];

	$sql = "SELECT hostelname FROM student WHERE rollno = '$       '";
	$query = $connect->query($sql);
	
	$sql2 = "insert into requests values('$equipmentName', '$      ', '$query->fetch_assoc()['hostelname']', $estimatedCost, '$purchaseLinks', '$reason')";
	$query2 = $connect->query($sql);

	echo "Request successful.";

}

?>
