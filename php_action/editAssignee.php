<?php 	

require_once 'core.php';

if($_SESSION['userId']!=1) {
    header('location: dashboard.php');
}

$valid['success'] = array('success' => false, 'messages' => array());

//if($_POST) {

    $name = $_POST['editBrandName'];
    $email = $_POST['editBrandStatus'];
    $brandId = $_POST['brandId'];
	$str_arr = explode (",", $brandId);
    //UPDATE assignee set email = "a" WHERE email='ggn10@iitbbs.ac.in' and formtype='3.1';
    $sql = "UPDATE assignee SET email = '$email' WHERE email = '$str_arr[1]' AND formtype = '$str_arr[0]'";
	echo $sql;
        $stmt = $forms->prepare($sql);
        $stmt->bind_param("ss", $email);

        if($stmt->execute()) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Changed";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while adding the Item";
        }

	echo json_encode($valid); 
//}