<?php 	

require_once 'core.php';

/*echo "Inside submitForm.php";
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
if($_SESSION['userId']>2) {
    header('location: dashboard.php');
}*/

$valid['success'] = array('success' => false, 'messages' => array());


if($_POST) {

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
		   //echo $assignee;
		   
		   $sql = "SELECT name from officebearer WHERE emailid = '$assignee'";
		   $result = $connect->query($sql);
		   $assignee = $result->fetch_array();
		   $assignee = $assignee[0];
		   //echo $assignee;

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
	}
	else
	{
		$_SESSION['inputValues'] = $arr;
		header('location:form1.php');
	}
}