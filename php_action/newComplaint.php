<?php 

require_once 'core.php';

if($_SESSION['userId']<=2) {
    header('location: dashboard.php');
}

if($_POST) {

	$equipmentName = $_POST['equipmentName'];
	$purchaseLinks = $_POST['purchaseLinks'];
	$reason = $_POST['reason'];

	$rollnum = $_SESSION['userId'];

	$sql = "INSERT INTO complaints VALUES(NULL, ?, 1, ?, ?, ?, CURRENT_TIMESTAMP)";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssss", $equipmentName,$rollnum,$reason,$purchaseLinks);

    if($stmt->execute()) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully submitted";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while submitting";
    }		

	echo json_encode($valid);
}

// $hostel->close();

?>
