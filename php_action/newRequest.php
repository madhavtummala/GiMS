<?php 

require_once 'core.php';

if($_SESSION['userId']<=2) {
    header('location: dashboard.php');
}

if($_POST) {

	$equipmentName = $_POST['equipmentName'];
	$estimatedCost = $_POST['estimatedCost'];
	$purchaseLinks = $_POST['purchaseLinks'];
	$reason = $_POST['reason'];
	$rollnum = $_SESSION['userId'];

	$sql = "INSERT INTO requests VALUES(NULL, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";

    $stmt = $hostel->prepare($sql);
    $stmt->bind_param("sssss", $equipmentName,$rollnum,$estimatedCost,$purchaseLinks,$reason);

    if($stmt->execute()) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully Updated";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while Updating";
    }		

	echo json_encode($valid);
}

// $hostel->close();

?>
