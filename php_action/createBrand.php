<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());


if($_POST) {

    $name = $_POST['addName'];
    $invoiceno = $_POST['addInvoiceno'];
    $cost = $_POST['addCost'];

    $sql = "INSERT INTO equipment values(NULL,'$name', 1, curdate(), '$cost', '$invoiceno')";

    if ($hostel->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully Added";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while adding the Item";
    }

    $hostel->close();

    echo json_encode($valid);
}