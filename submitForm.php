<?php 	

require_once 'php_action/core.php';

if(!($_SESSION['userId']>2)) {
    header('location: dashboard.php');
}

if($_POST) {

	if ($_SESSION['formtype'] == '3_1')
	{
		$name = $_POST['addName'];
		$invoiceno = $_POST['addInvoiceno'];
		$cost = $_POST['addCost'];		
		$arr = array('name' => $name, 'invoiceno' => $invoiceno, 'cost' => $cost);
	}
	else
	{
		$u1 = $_POST['u1'];
		$u2 = $_POST['u2'];
		$u3 = $_POST['u3'];
		$u4 = $_POST['u4'];
		$u5 = $_POST['u5'];
		$u6 = $_POST['u6'];
		$u7 = $_POST['u7'];
		$u8 = $_POST['u8'];
		$u8 = explode(',', $u8);
		$u10= $u8[0];
		$u11= $u8[1];
		$u12= $u8[2];
		$u9 = $_POST['u9'];
		$arr = array('u1' => $u1, 'u2' => $u2, 'u3' => $u3,
		'u4' => $u4,'u5' => $u5,'u6' => $u6,'u7' => $u7,'u8' => $u10,'u9' => $u11,'u10' => $u12,'u11' => $u9);
	}

    $data = json_encode($arr);   

	$formtype = $_SESSION['formtype'];

	$sql = "SELECT email from assignee WHERE formtype = '$formtype'";
	$result = $forms->query($sql);
	$assignee = $result->fetch_array();
	$assignee = $assignee[0];
	$email = $assignee;

	$sql = "SELECT name from officebearer WHERE emailid = '$assignee'";
	$result = $connect->query($sql);
	$assignee = $result->fetch_array();
	$assignee = $assignee[0];

	$sql = "INSERT INTO currentapplications values(NULL, ?, ?, ?, 0, curdate(), ?, ?)";
	$stmt = $forms->prepare($sql);
	$stmt->bind_param("sssss", $_SESSION["userId"], $data, $assignee, $email, $formtype);

	if ($stmt->execute()) {

		$sql = "SELECT max(formid) from currentapplications";
		$result = $connect->query($sql);
		$max = $result->fetch_array();
		$max = $max[0];

	   	$valid['success'] = true;
	   	$valid['messages'] = "Successfully Added";

		$initial="";
		foreach ($arr as $dat)
		{
			$initial = $initial.$dat.',';
		}
		$initial = $initial.','.$max;
		$initial = $initial.','.$formtype;
		$initial = $initial.','.$base;

		$command = $python." ".$base."/pdf.py \"".$initial."\"";
		exec("$command");

	} else {
	   $valid['success'] = false;
	   $valid['messages'] = "Error while adding the Item";
	}

    $forms->close();
    if ($valid['success'])
	{
		$_SESSION['inputValues'] = $arr;
		header('location: dashboard.php');
	}
	else
	{
		$_SESSION['inputValues'] = $arr;
		header('location: dashboard.php');
	}
}