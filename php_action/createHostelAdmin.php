<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$roll = $_POST['uroll'];
 	$pass = $_POST['upass'];
    $uhostel = $_POST['uhostel'];

    $pass = password_hash($pass, PASSWORD_DEFAULT);
	
	$sql = "INSERT INTO hosteladmin VALUES ('$roll', '$pass', '$uhostel')";

	if($connect->query($sql) === true) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the members";
	}

	$connect->close();

	echo json_encode($valid);
}	

