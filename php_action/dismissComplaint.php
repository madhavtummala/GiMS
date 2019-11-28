<?php 	

require_once 'core.php';

// if($_SESSION['userId']!=2) {
//     header('location: dashboard.php');
// }

$valid['success'] = array('success' => false, 'messages' => array());

$request = $_POST['request'];

if($request) { 

 $sql = "UPDATE complaints set status = 2 WHERE complaintno = '$request'";

 if($connect->query($sql) === true) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the complaint";
 }

 echo json_encode($valid);
 
}