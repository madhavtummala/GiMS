<?php 

require_once 'core.php';

if($_POST) {

	$hostel = new mysqli($localhost, $username, $password, $_SESSION['hostel']);

	$equipmentName = $_POST['equipmentName'];
	$estimatedCost = $_POST['estimatedCost'];
	$purchaseLinks = $_POST['purchaseLinks'];
	$reason = $_POST['reason'];
	$rollnum = $_SESSION['userId'];
	$ts = date("Y-m-d H:i:s");
	//echo $equipmentName."</br>".$estimatedCost."</br>".$purchaseLinks."</br>".$reason."</br>".$_SESSION['userId']."</br>".$_SESSION['hostel']."</br>";
	$sql2 = "insert into requests values('$equipmentName', '$rollnum', '$estimatedCost', '$purchaseLinks', '$reason', '$ts')";
	//echo $sql2."</br>";
	$query2 = $hostel->query($sql2);
	//echo $query2;
	if($query2===TRUE)
	{
		$valid['success'] = true;
		$valid['messages'] = "Request Successfully Registered.";
	} 
	else
	{
		$valid['success'] = false;
		$valid['messages'] = "Error while registering request.";	
	}
	echo json_encode($valid);

}

?>
