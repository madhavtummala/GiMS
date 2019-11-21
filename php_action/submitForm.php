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
           $sql = "INSERT INTO currentapplications values(NULL, ?, ?, ?, 'New', curdate())";
		   $arr = array('name' => $name, 'invoiceno' => $invoiceno, 'cost' => $cost);
		   $data = json_encode($arr);
		   $myFile = fopen("assignee.json","r") or die("Unable to open file!");
		   $assignee_list = fread($myFile, filesize("assignee.json"));
		   $assignee_list = json_decode($assignee_list, true);
		   $assignee = $assignee_list[$_SESSION['formtype']];
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