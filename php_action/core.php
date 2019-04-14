<?php 

session_start();

require_once 'db_connect.php';

// echo $_SESSION['userId'];

if(!$_SESSION['userId']) {
<<<<<<< HEAD
	header('location: http://localhost:8888/Gymkhana/index.php');	
} 

?>
=======
	header('location: http://localhost/Gymkhana/index.php');	
}
?>
>>>>>>> b439a11950e15f89c58c240d8c73827ec0bee5c2
