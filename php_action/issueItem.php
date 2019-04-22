<?php

require_once 'core.php';

if($_SESSION['userId']!=2) {
    header('location: dashboard.php');
}

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

    $roll = $_POST['issueRoll'];
    $brandId = $_POST['brandId'];
    $hostel_name = $_SESSION['hostel'];

    $sql = "SELECT * from student WHERE rollno=? and hostelname = '$hostel_name'";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $roll);
    $stmt->execute();

    $query = $stmt->get_result();

    if($query->num_rows == 0){
        $valid['success'] = false;
        $valid['messages'] = "Student does not belong to this hostel";        
    }

    else{

        $sql = "SELECT * FROM issued WHERE rollno='$roll'";
        $stmt = $hostel->prepare($sql);
        $stmt->bind_param("s", $roll);
        $stmt->execute();
        $query = $stmt->get_result();

        if($query->num_rows >= 3){
            $valid['success'] = false;
            $valid['messages'] = "Max Items Issued for the Student";      
        }

        else{

            $sql = "SELECT status from equipment WHERE eid='$brandId'";
            $query = $hostel->query($sql);

            $query = $query->fetch_assoc();

            if($query['status']==1) {

                $sql = "INSERT INTO issued values (NULL, '$brandId', ?, curdate(), 0, 0)";

                $stmt = $hostel->prepare($sql);
                $stmt->bind_param("s", $roll);

                if($stmt->execute()) {
                    $valid['success'] = true;
                    $valid['messages'] = "Successfully Updated";
                } else {
                    $valid['success'] = false;
                    $valid['messages'] = "Error while Updating";
                }
            }
            else{
                $valid['success'] = false;
                $valid['messages'] = "Trying to issue an Item which is Not Availiable";
            }
        }
    }

    // $hostel->close();

    echo json_encode($valid);
}