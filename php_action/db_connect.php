<?php 	

$localhost = "localhost";
$username = "root";
$password = "root";
$dbname = "Gymkhana";

$connect = new mysqli($localhost, $username, $password, $dbname);

if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
//   echo "Successfully connected";
}

if(isset($_SESSION['hostel']))
{
	$hostel = new mysqli($localhost, $username, $password, $_SESSION['hostel']);

	if($hostel->connect_error) {
	  die("Connection Failed : " . $hostel->connect_error);
	} else {
	//   echo "Successfully connected";
	}
}

?>
