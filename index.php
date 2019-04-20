<?php 
require_once 'php_action/db_connect.php';

session_start();

if(isset($_SESSION['userId'])) {
	header('location: dashboard.php');	
}

require_once 'includes/indexHeader.php';

$errors = array();

if($_POST) {

	$rollno = $_POST['rollno'];
	$password = $_POST['password'];

	if(empty($rollno) || empty($password)) {
		if($rollno == "") {
			$errors[] = "Rollno is required";
		} 

		if($password == "") {
			$errors[] = "Password is required";
		}
	} 
	else {
		$rollno = strtolower($rollno);
		$sql = "SELECT * FROM student WHERE rollno = '$rollno'";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			// exists
			
			$value = $result->fetch_assoc();
			if(password_verify($password, $value['password'])) {
				$user_id = $value['rollno'];

				// set session
				$_SESSION['hostel'] = $value['hostelname'];
				$_SESSION['userId'] = $user_id;

				header('location: dashboard.php');	
			} else{
				
				$errors[] = "Incorrect rollno/password combination";
			} // /else
		} else {		
			$errors[] = "Rollno does not exists";
		} // /else
	} 
	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>IIT BBS Gymkhana</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

	<!-- custom css -->
	<link rel="stylesheet" href="custom/css/custom.css">	

	<!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
	<!-- jquery ui -->  
	<link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
	<script src="assests/jquery-ui/jquery-ui.min.js"></script>

	<!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row vertical">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Welcome Student, please sign in</h3>
					</div>
					<div class="panel-body">

						<div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
						</div>

						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
							<fieldset>
							  <div class="form-group">
									<label for="rollno" class="col-sm-2 control-label">Login id</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" id="rollno" name="rollno" placeholder="Enter your Insititute Roll No..." autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password..." autocomplete="off" />
									</div>
								</div>								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" class="btn btn-default"> <i class="glyphicon glyphicon-log-in"></i> Sign in</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>


<?php require_once 'includes/indexFooter.php'; ?>
