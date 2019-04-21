<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$roll = $_POST['uroll'];
 	$pass = $_POST['upass'];
    $uhostel = $_POST['uhostel'];

    $pass = password_hash($pass, PASSWORD_DEFAULT);
	
	$sql = "INSERT INTO hosteladmin VALUES (?, ?, ?)";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sss", $roll,$pass,$uhostel);	

	if($stmt->execute()) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added Hostel Admin";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the members";
	}

	echo json_encode($valid);
}	

