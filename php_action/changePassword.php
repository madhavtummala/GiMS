<?php 

require_once 'core.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$currentPassword = $_POST['password'];
	$newPassword = $_POST['npassword'];
	$conformPassword = $_POST['cpassword'];
	$userId = $_POST['user_id'];

	$sql ="SELECT * FROM student WHERE rollno = '$userId'";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();

	if($currentPassword == $result['password']) {

		if($newPassword == $conformPassword) {

			$updateSql = "UPDATE student SET password = '$newPassword' WHERE rollno = '$userId'";
			if($connect->query($updateSql) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Successfully Updated";
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Error while updating the password";	
			}

		} else {
			$valid['success'] = false;
			$valid['messages'] = "New password does not match with Conform password";
		}

	} else {
		$valid['success'] = false;
		$valid['messages'] = "Current password is incorrect";
	}

	echo json_encode($valid);

}

?>