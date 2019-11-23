<?php 

//session_start();

require_once 'config.php';
require_once 'db_connect.php';

// echo $_SESSION['userId'];
if(!$_SESSION['userId']) {
	header('location: $root');
}

?>