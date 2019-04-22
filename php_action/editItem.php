<?php 	

require_once 'core.php';

if($_SESSION['userId']>2) {
    header('location: dashboard.php');
}

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

    $brandName = $_POST['editBrandName'];
    $brandStatus = $_POST['editBrandStatus'];
    $brandId = $_POST['brandId'];

    if(!$brandName){

        $sql = "UPDATE equipment SET status = ? WHERE eid = '$brandId'";

        $stmt = $hostel->prepare($sql);
        $stmt->bind_param("s", $brandStatus);

        if($stmt->execute()) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Changed";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while adding the Item";
        }
    }
    else{
        $sql = "UPDATE equipment SET name = ?, status = ? WHERE eid = '$brandId'";

        $stmt = $hostel->prepare($sql);
        $stmt->bind_param("ss", $brandName,$brandStatus);

        if($stmt->execute()) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Changed";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while adding the Item";
        }
    }

	echo json_encode($valid); 
}