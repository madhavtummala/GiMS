<?php 

require_once 'core.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$currentPassword = $_POST['password'];
	$newPassword = $_POST['npassword'];
	$conformPassword = $_POST['cpassword'];

	if($_SESSION['userId'] > 2)
		$userId = $_SESSION['userId'];
	else
		$userId = $_SESSION['loginId'];

	if($_SESSION['userId'] > 2)
		$sql ="SELECT * FROM student WHERE rollno = '$userId'";
	else if($_SESSION['userId'] == 2)
		$sql ="SELECT * FROM hosteladmin WHERE loginid = '$userId'";
	else
		$sql ="SELECT * FROM centraladmin WHERE loginid = '$userId'";

	$query = $connect->query($sql);
	$result = $query->fetch_assoc();

	if(password_verify($currentPassword, $result['password'])) {

		if($newPassword == $conformPassword) {
			$np = password_hash($newPassword, PASSWORD_DEFAULT);

			if($_SESSION['userId'] > 2)
				$updateSql = "UPDATE student SET password = '$np' WHERE rollno = '$userId'";
			else if($_SESSION['userId'] == 2)
				$updateSql = "UPDATE hosteladmin SET password = '$np' WHERE loginid = '$userId'";
			else
				$updateSql = "UPDATE centraladmin SET password = '$np' WHERE loginid = '$userId'";

			if($connect->query($updateSql) === true) {
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
