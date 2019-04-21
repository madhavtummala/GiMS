<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$uname = $_POST['username'];
	$upass = $_POST['userpassword'];
	$uemail = $_POST['useremail'];
	$roll = $_POST['roll'];

	if($uname){
		$sql = "UPDATE hosteladmin SET loginid = ? WHERE loginid='$roll'";

        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $uname);

        if($stmt->execute()) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Updated";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while updating hostel admin info";
        }	
	}
	if($upass){
		$upass = password_hash($upass, PASSWORD_DEFAULT);
		$sql = "UPDATE hosteladmin SET password = ? WHERE loginid='$roll'";

        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $upass);

        if($stmt->execute()) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Updated";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while updating hostel admin info";
        }		
	}
	if($uemail){
		$sql = "UPDATE hosteladmin SET hostelname = ? WHERE loginid='$roll'";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $uemail);

        if($stmt->execute()) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Updated";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while updating hostel admin info";
        }		
	}

}

echo json_encode($valid);
