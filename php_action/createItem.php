<?php 	

require_once 'core.php';

if($_SESSION['userId']>2) {
    header('location: dashboard.php');
}

$valid['success'] = array('success' => false, 'messages' => array());


if($_POST) {

    $name = $_POST['addName'];
    $invoiceno = $_POST['addInvoiceno'];
    $cost = $_POST['addCost'];
    $file = $_POST['productImage'];

    $type = explode('.', $_FILES['productImage']['name']);
    $type = $type[count($type)-1];    
    $url = '../assests/images/'.strtolower(str_replace(' ','',$name)).'.jpeg';
    if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
        if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {         
            if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {

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
            }
            else{
                $valid['success'] = false;
                $valid['messages'] = "Error while moving Image of the Item";
            }
        }else{
            $valid['success'] = false;
            $valid['messages'] = "Error while uploading Image of the Item";
        }
    }else{
        $valid['success'] = false;
        $valid['messages'] = "Error with supported Image type of the Item";
        // $valid['messages'] = $file;
    }

    $hostel->close();
    echo json_encode($valid);
}