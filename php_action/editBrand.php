<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

    $brandName = $_POST['editBrandName'];
    $brandStatus = $_POST['editBrandStatus'];
    $brandId = $_POST['brandId'];

    if(!$brandName){
        $sql = "UPDATE equipment SET status = '$brandStatus' WHERE eid = '$brandId'";

        if($hostel->query($sql) === TRUE) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Changed";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while adding the Item";
        }
    }
    else{
        $sql = "UPDATE equipment SET name = '$brandName', status = '$brandStatus' WHERE eid = '$brandId'";

        if($hostel->query($sql) === TRUE) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Changed";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while adding the Item";
        }
    }
	 
	$hostel->close();

	echo json_encode($valid); 
}