<?php 

require_once 'core.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$newlogin = $_POST['username'];
	$loginid = $_SESSION['loginId'];

	if($_SESSION['userId']==2)
		$sql = "UPDATE hosteladmin SET loginid = '$newlogin' WHERE loginid = '$loginid'";
	else
		$sql = "UPDATE centraladmin SET loginid = '$newlogin' WHERE loginid = '$loginid'";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

	$connect->close();

	echo json_encode($valid);
}

?>