<?php 	

require_once 'core.php';

if($_SESSION['userId']!=1) {
    header('location: dashboard.php');
}


$valid['success'] = array('success' => false, 'messages' => array());

$userid = $_POST['userid'];

if($userid) { 

 $sql = "DELETE FROM officebearer  WHERE emailid = '$userid'";

 if($connect->query($sql) === true) {
 	$valid['success'] = true;
	$valid['messages'] = "Succesfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the hostel admin";
 }
 
 $connect->close();

 echo json_encode($valid);
 
}