<?php 	

require_once 'core.php';

if($_SESSION['userId']!=1) {
    header('location: dashboard.php');
}

$valid['success'] = array('success' => false, 'messages' => array());

<<<<<<< HEAD
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
 
=======
if($_POST) {

    $name = $_POST['editBrandName'];
    $email = $_POST['editBrandStatus'];
    $brandId = $_POST['brandId'];
    //UPDATE assignee set email = "a" WHERE email='ggn10@iitbbs.ac.in' and formtype='3.1';
    $sql = "UPDATE assignee SET email = '$email' WHERE formtype = '$brandId'";
	//echo $sql;
        $stmt = $forms->query($sql);

        if($stmt == TRUE) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Changed";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while adding the Item";
        }

	echo json_encode($valid); 
>>>>>>> f15407a24b505436f126c6b965598b7a594e1bf2
}