<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$uname = $_POST['username'];
	$upass = $_POST['userpassword'];
	$uemail = $_POST['useremail'];
	$roll = $_POST['roll'];

	if($uname){
		$sql = "UPDATE hosteladmin SET loginid='$uname' WHERE loginid='$roll'";
		if($connect->query($sql) == true) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Update";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error while updating hostel admin info";
		}		
	}
	if($upass){
		$upass = password_hash($upass, PASSWORD_DEFAULT);
		$sql = "UPDATE hosteladmin SET password='$upass' WHERE loginid='$roll'";
		if($connect->query($sql) == true) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Update";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error while updating hostel admin info";
		}		
	}
	if($uemail){
		$sql = "UPDATE hosteladmin SET hostelname='$uemail' WHERE loginid='$roll'";
		if($connect->query($sql) == true) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Update";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error while updating hostel admin info";
		}		
	}

}
	 
$connect->close();

echo json_encode($valid);
 
