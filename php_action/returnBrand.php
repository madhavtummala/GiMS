<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

    $issueno = $_POST['returnNo'];
    $fine = $_POST['returnFine'];
    $reason = $_POST['returnReason'];

    if($fine && $reason)
    {
        $sql = "UPDATE issued set fine=fine+'$fine' , reason='$reason' WHERE issueno = '$issueno'";
        $hostel->query($sql);
    }
    else if($fine)
    {
        $sql = "UPDATE issued set fine=fine+'$fine' , reason=0 WHERE issueno = '$issueno'";
        $hostel->query($sql);
    }
    else if($reason)
    {
        $sql = "UPDATE issued set reason='$reason' WHERE issueno = '$issueno'";
        $hostel->query($sql);
    }

    else
    {
        $sql = "UPDATE issued set reason=0 WHERE issueno = '$issueno'";
        $hostel->query($sql);
    }

    $sql = "DELETE FROM issued where issueno = '$issueno'";

    if($hostel->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully Changed";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while issuing the Item";
    }

    $hostel->close();

    echo json_encode($valid);


}