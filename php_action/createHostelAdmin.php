<?php 	

require_once 'core.php';

if($_SESSION['userId']!=1) {
    header('location: dashboard.php');
}

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$roll = $_POST['uroll'];
 	$pass = $_POST['upass'];
    $uhostel = $_POST['uhostel'];
	$uperm = $_POST['u1'];

    $pass = password_hash($pass, PASSWORD_DEFAULT);
	
	$sql = "INSERT INTO hosteladmin VALUES (?, ?, ?, ?)";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssss", $roll,$pass,$uhostel, $uperm);	

	if($stmt->execute()) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added Hostel Admin";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the members";
	}

	echo json_encode($valid);
}	

