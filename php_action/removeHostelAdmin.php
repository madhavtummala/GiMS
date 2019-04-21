<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$userid = $_POST['userid'];

if($userid) { 

 $sql = "DELETE FROM hosteladmin  WHERE loginid = '$userid'";

 if($connect->query($sql) === true) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the hostel admin";
 }
 
 $connect->close();

 echo json_encode($valid);
 
}