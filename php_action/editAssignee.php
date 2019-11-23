<?php 	

require_once 'core.php';

if($_SESSION['userId']!=1) {
    header('location: dashboard.php');
}

$valid['success'] = array('success' => false, 'messages' => array());

$brandId = $_POST['brandId'];
$email = $_POST['brandId'];
//var_dump($_POST);
if($brandId) { 
 /*$sql = "UPDATE assignee SET email = '$email' WHERE formtype = '$brandId'";
 if($forms->query($sql) == TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully updated assignee";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while updating assignee (Maybe Constraint error)";
 }*/
 
  $valid['success'] = true;
  $valid['messages'] = "$email";
 //$forms->close();

 echo json_encode($valid);
 
}