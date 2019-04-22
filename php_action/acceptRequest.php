<?php 	
error_reporting(E_ALL);

require_once 'core.php';

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

		$sql = "DELETE FROM requests WHERE requestno = '$request'";
		$result = $hostel->query($sql);
		
		$target_dir = $_SERVER['DOCUMENT_ROOT']."/Gymkhana/assests/images/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 4;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		//if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["image"]["tmp_name"]);
				if($check !== false) {
				    //echo "File is an image - " . $check["mime"] . ".";
				    $uploadOk = 4;
				} else {
				    //echo "File is not an image.";
				    $uploadOk = 0;
				}
		//}
		// Check if file already exists
		if (file_exists($target_file)) {
				//echo "Sorry, file already exists.";
				$uploadOk = 1;
		}
		// Check file size
		if ($_FILES["image"]["size"] >= 2000000) {
				//echo "Sorry, your file is too large.";
				$uploadOk = 2;
		}
		// Allow certain file formats
		if($imageFileType != "jpeg") {
				//echo "Sorry, only JPEG files are allowed.";
				$uploadOk = 3;
		}
		// Check if $uploadOk is set to 0, 1, 2, or 3 by an error, else upload it
		switch ($uploadOk) {
			case 0:
				  $valid['messages'] = $valid['messages'].", but your file is not an image, so it was not uploaded";
				  break;
			case 1:
				  $valid['messages'] = $valid['messages'].", but your file already exists, so it was not uploaded.";
				  break;
			case 2:
				  $valid['messages'] = $valid['messages'].", but your file is too large, so it was not uploaded.";
				  break;
			case 3:
				  $valid['messages'] = $valid['messages'].", but only JPEG files are allowed, so your file was not uploaded.".$target_file;
				  break;
			default:
				  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
							//echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
					} else {
							$valid['messages']=$valid['messages'].", but there was an error uploading the image.".$target_file.' '.$_FILES["image"]["tmp_name"].' '.$_FILES["image"]["name"];
					}
	}

		

	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the equipment";
	}	

	echo json_encode($valid);
 
}
