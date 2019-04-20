<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$uname = $_POST['username'];
	$upass = $_POST['userpassword'];
	$uemail = $_POST['useremail'];
	$roll = $_POST['roll'];

	if($uname){
		$sql = "UPDATE student SET name='$uname' WHERE rollno='$roll'";
		if($connect->query($sql) == true) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Update";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error while updating product info";
		}		
	}
	if($upass){
		$upass = password_hash($upass, PASSWORD_DEFAULT);
		$sql = "UPDATE student SET password='$upass' WHERE rollno='$roll'";
		if($connect->query($sql) == true) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Update";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error while updating product info";
		}		
	}
	if($uemail){
		$sql = "UPDATE student SET emailid='$uemail' WHERE rollno='$roll'";
		if($connect->query($sql) == true) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Update";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error while updating product info";
		}		
	}

}
	 
$connect->close();

echo json_encode($valid);
 
