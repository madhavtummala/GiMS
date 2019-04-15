<?php 

require_once 'php_action/core.php';

$session = $_SESSION['userId'];

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

if($session == 1)
	header('location: adminIndex.php');
if($session == 2)
	header('location: hostelIndex.php');

header('location: index.php');

?>