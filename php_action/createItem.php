<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());


if($_POST) {

    $name = $_POST['addName'];
    $invoiceno = $_POST['addInvoiceno'];
    $cost = $_POST['addCost'];

    $sql = "INSERT INTO equipment values(NULL, ?, 1, curdate(), ?, ?)";

    $stmt = $hostel->prepare($sql);
    $stmt->bind_param("sss", $name,$cost,$invoiceno);

    if ($stmt->execute()) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully Added";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while adding the Item";
    }

    echo json_encode($valid);
}