<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
//echo "hi";

if($_POST) {
//echo "string";
	$name = $_POST['addName'];
	$invoiceno = $_POST['addInvoiceno'];
	$cost = $_POST['addCost'];
	if ($_SESSION['formtype'] == '3.1')
	{
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
		   //echo $formtype;
		   $sql = "SELECT email from assignee WHERE formtype = '$formtype'";
		   //echo $sql;
		   $result = $forms->query($sql);
		   //echo 
		   $assignee = $result->fetch_array();
		   //var_dump($assignee);
		   $assignee = $assignee[0];
		   //echo $assignee;
		   
		   $sql = "SELECT name from officebearer WHERE emailid = '$assignee'";
		   $result = $connect->query($sql);
		   $assignee = $result->fetch_array();
		   $assignee = $assignee[0];
		   //echo $assignee;
		   //echo "bye";

		   $sql = "INSERT INTO currentapplications values(NULL, ?, ?, ?, 'New', curdate())";
           $stmt = $forms->prepare($sql);
           $stmt->bind_param("sss", $_SESSION["userId"], $data, $assignee);

           if ($stmt->execute()) {
               $valid['success'] = true;
               $valid['messages'] = "Successfully Added";
           } else {
               $valid['success'] = false;
               $valid['messages'] = "Error while adding the Item";
           }
    $forms->close();
    if ($valid['success'])
	{
		header('location:../dashboard.php');
		//echo "success";
	}
	else
	{
		$_SESSION['inputValues'] = $arr;
		//echo "fail";
		header('location:form1.php');
	}
}