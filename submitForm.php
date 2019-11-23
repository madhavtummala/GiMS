<?php 	

require_once 'php_action/core.php';

if(!($_SESSION['userId']>2)) {
    header('location: dashboard.php');
}

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

	echo "hi\n";

	var_dump($_POST);

    $name = $_POST['addName'];
    $invoiceno = $_POST['addInvoiceno'];
    $cost = $_POST['addCost'];
	$arr = array('name' => $name, 'invoiceno' => $invoiceno, 'cost' => $cost);
	$data = json_encode($arr);

	$formtype = $_SESSION['formtype'];
	$sql = "SELECT email from assignee WHERE formtype = '$formtype'";
	$result = $forms->query($sql);
	$assignee = $result->fetch_array();
	$assignee = $assignee[0];

	$sql = "SELECT name from officebearer WHERE emailid = '$assignee'";
	$result = $connect->query($sql);
	$assignee = $result->fetch_array();
	$assignee = $assignee[0];

	$sql = "INSERT INTO currentapplications values(NULL, ?, ?, ?, 0, curdate())";
	$stmt = $forms->prepare($sql);
	$stmt->bind_param("sss", $_SESSION["userId"], $data, $assignee);

	if ($stmt->execute()) {
	   $valid['success'] = true;
	   $valid['messages'] = "Successfully Added";
	} else {
	   $valid['success'] = false;
	   $valid['messages'] = "Error while adding the Item";
	}
    if ($valid['success']){
    	echo "success\n";
		header('location: dashboard.php');
    }

	else
	{
		echo "fail\n";
		$_SESSION['inputValues'] = $arr;
		header('location: form1.php');
	}
}