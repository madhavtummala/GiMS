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
	$u1 = $_POST['u1'];
	$u2 = $_POST['u2'];
	$u3 = $_POST['u3'];

    $pass = password_hash($pass, PASSWORD_DEFAULT);
	
	$sql = "INSERT INTO officebearer VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssssss", $uhostel, $u1, $u2, $roll, $pass, $u3);	

	if($stmt->execute()) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added Office Bearer";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the members";
	}

	echo json_encode($valid);
}	

