<?php 

require_once 'core.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$newlogin = $_POST['username'];
	$loginid = $_SESSION['loginId'];

	if($_SESSION['userId']==2){
		$sql = "UPDATE hosteladmin SET loginid = ? WHERE loginid = '$loginid'";
		$stmt = $connect->prepare($sql);
		$stmt->bind_param("s", $newlogin);		
	}
	else{
		$sql = "UPDATE centraladmin SET loginid = ? WHERE loginid = '$loginid'";
		$stmt = $connect->prepare($sql);
		$stmt->bind_param("s", $newlogin);		
	}

	if($stmt->execute()) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully updated the user name";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating the user name";
	}

	echo json_encode($valid);
}

?>