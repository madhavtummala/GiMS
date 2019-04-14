<?php 

session_start();

require_once 'db_connect.php';

//echo $_SESSION['hostel'];

if(!$_SESSION['userId']) {
	header('location: http://localhost:8888/Gymkhana/index.php');	
}