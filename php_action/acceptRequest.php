<?php 	
error_reporting(E_ALL);

require_once 'core.php';

if($_SESSION['userId']!=2) {
    header('location: dashboard.php');
}

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST){

	$request = $_POST['request'];
	$invoice = $_POST['editBrandInvoice'];
	$name = $_POST['editBrandName'];
	$cost = $_POST['editBrandCost'];

	$sql = "SELECT * FROM requests WHERE requestno = '$request'";
	$result = $hostel->query($sql);
	$row = $result->fetch_array();

	$sql = "INSERT INTO equipment values(NULL, '$row[1]', 1, curdate(), '$row[3]', ?)";
	
	$stmt = $hostel->prepare($sql);
	$stmt->bind_param("s", $invoice);

	if($stmt->execute()) {

		$valid['success'] = true;
		$valid['messages'] = "Successfully added";

		$sql = "SELECT max(eid) AS a FROM equipment";

		$result=$hostel->query($sql);
		$value=$result->fetch_assoc();
		$eid=$value['a'];

		if($name){
			$sql = "UPDATE equipment SET name=? WHERE eid='$eid'";
			$stmt = $hostel->prepare($sql);
			$stmt->bind_param("s", $name);
			$stmt->execute();
		}	
		if($cost){
			$sql = "UPDATE equipment SET cost=? WHERE eid='$eid'";
			$stmt = $hostel->prepare($sql);
			$stmt->bind_param("i", $cost);
			$stmt->execute();			
		}
		
	    $type = explode('.', $_FILES['productImage']['name']);
	    $type = $type[count($type)-1];    

	    if($name)
	    	$url = '../assests/images/'.strtolower(str_replace(' ','',$name)).'.jpeg';
	    else
	    	$url = '../assests/images/'.strtolower(str_replace(' ','',$row[1])).'.jpeg';

	    if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
	        if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {         
	            if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {

					$sql = "DELETE FROM requests WHERE requestno = '$request'";
					$result = $hostel->query($sql);
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
	    }


	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the equipment";
	}	

	// $hostel->close();

	echo json_encode($valid);
 
}
