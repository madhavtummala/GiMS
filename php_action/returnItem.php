<?php

require_once 'core.php';

if($_SESSION['userId']!=2) {
    header('location: dashboard.php');
}

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

    $eid = $_POST['returnNo'];
    $fine = $_POST['returnFine'];
    $reason = $_POST['returnReason'];

    if($fine && $reason)
    {
        $sql = "UPDATE issued set fine=fine+? , reason=? WHERE eid = '$eid'";
        $stmt = $hostel->prepare($sql);
        $stmt->bind_param("is", $fine,$reason);  
        $stmt->execute();
    }
    else if($fine)
    {
        $sql = "UPDATE issued set fine=fine+? , reason=0 WHERE eid = '$eid'";
        $stmt = $hostel->prepare($sql);
        $stmt->bind_param("i", $fine);
        $stmt->execute();
    }
    else if($reason)
    {
        $sql = "UPDATE issued set reason=? WHERE eid = '$eid'";
        $stmt = $hostel->prepare($sql);
        $stmt->bind_param("s",$reason);
        $stmt->execute();
    }

    else
    {
        $sql = "UPDATE issued set reason=0 WHERE eid = '$eid'";
        $hostel->query($sql);
    }

    $sql = "DELETE FROM issued where eid = '$eid'";

    if($hostel->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully Changed";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while returning Item";
    }

    // $hostel->close();

    echo json_encode($valid);


}