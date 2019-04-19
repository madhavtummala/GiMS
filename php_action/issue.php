<?php 

require_once 'core.php';

$errors = array();

if($_POST) {

	$eid = $_POST['eid'];
	$roll = $_POST['rollnoofstudent'];
	$d=date('Y-m-d');

	if(empty($eid) || empty($roll)) {
		
		if($eid == "") {
			$errors[] = "Equipment ID is required";
		}
		if($roll == "") {
			$errors[] = "Roll no. is required";
		} 

	}
	else {
		$roll = strtolower($roll);
		$sql = "SELECT * FROM student WHERE rollno = '$roll' and hostelname='$_SESSION['hostel']'";
		$result = $connect->query($sql);
		if($result->num_rows == 1) {
			$sql2 = "insert into issued values(NULL, '$eid', '$roll', '$d', 0, 1)";
			
			if($query2 = $hostel->query($sql2)===TRUE)
			{
				echo "Request successful.";
			}
			else {
				echo $hostel + $roll + $roll + $d;
			}
		}
		else {
			$errors[] = "Rollno does not exist";
		}
	
	}
}

?>

