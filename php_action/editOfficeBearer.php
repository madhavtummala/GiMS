<?php 	

require_once 'core.php';

if($_SESSION['userId']!=1) {
    header('location: dashboard.php');
}

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$roll = $_POST['roll'];
 	$pass = $_POST['pass'];
    $email = $_POST['email'];
	$u1 = $_POST['u1'];
	$u2 = $_POST['contact'];
	$u3 = $_POST['permission'];
	$newpost = $_POST['newpost'];

	if($email){
		$sql = "UPDATE officebearer SET emailid = ? WHERE emailid='$roll'";

        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $email);

        if($stmt->execute()) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Updated";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while updating officebearer info";
        }	
	}
	if($pass){
		$upass = password_hash($pass, PASSWORD_DEFAULT);
		$sql = "UPDATE officebearer SET password = ? WHERE emailid='$roll'";

        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $upass);

        if($stmt->execute()) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Updated";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while updating officebearer info";
        }		
	}
	if($u1){
		$sql = "UPDATE officebearer SET name = ? WHERE emailid='$roll'";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $u1);

        if($stmt->execute()) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Updated";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while updating officebearer info";
        }		
	}
	if($u2){
		$sql = "UPDATE officebearer SET contactnumber = ? WHERE emailid='$roll'";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $u2);

        if($stmt->execute()) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Updated";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while updating officebearer info";
        }		
	}
	if($newpost){
		$sql = "UPDATE officebearer SET post = ? WHERE emailid='$roll'";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $newpost);

        if($stmt->execute()) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Updated";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while updating officebearer info";
        }		
	}
	if($u3){
		$sql = "UPDATE officebearer SET permission = ? WHERE emailid='$roll'";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $u3);

        if($stmt->execute()) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Updated";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while updating officebearer info";
        }		
	}
}

echo json_encode($valid);
