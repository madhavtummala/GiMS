<?php 	

require_once 'core.php';

if($_SESSION['userId']!=1) {
    header('location: dashboard.php');
}

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$roll = $_POST['uroll'];
	$name = $_POST['uname'];
	$email = $_POST['uemail'];
 	$pass = $_POST['upass'];
    $uhostel = $_POST['uhostel'];

    $roll = strtolower($roll);
    $pass = password_hash($pass, PASSWORD_DEFAULT);
	
	$sql = "INSERT INTO student VALUES (?, ? , ?, ?, ?)";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssss", $roll,$name,$email,$pass,$uhostel);		

	if($stmt->execute()) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added Student";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the members";
	}

	echo json_encode($valid);
}	

