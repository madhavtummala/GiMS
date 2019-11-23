<?php 	

require_once 'core.php';

if($_SESSION['userId']!=1) {
    header('location: dashboard.php');
}

$valid['success'] = array('success' => false, 'messages' => array());

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
}