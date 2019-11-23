<?php 	

require_once 'config.php';

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

// db connection
if(isset($_SESSION['hostel'])){
  $hostel = new mysqli($localhost, $username, $password, $_SESSION['hostel']);
  // check connection
  if($hostel->connect_error) {
    die("Connection Failed : " . $hostel->connect_error);
  } else {
    // echo "Successfully connected";
  }
}

//Form connection
$forms = new mysqli($localhost, $username, $password, "Forms");
if($forms->connect_error) {
  die("Connection Failed : " . $forms->connect_error);
} else {
//   echo "Successfully connected";
}

?>