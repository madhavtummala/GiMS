<?php require_once 'php_action/core.php'; ?>

<!DOCTYPE html>
<html>
<head>

	<title>Gymkhana Inventory Management System</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">

	<!-- DataTables -->
  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">

  <!-- file input -->
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->  
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>


<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <!-- <a class="navbar-brand" href="#">Brand</a> -->
    	<a class="navbar-brand" href="/Gymkhana" style="padding:0px;"><font size="5">
                        <img src="logo.jpg" alt="IIT Bhubaneswar">
                    Students' Gymkhana
          </font></a>
        </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      

      <ul class="nav navbar-nav navbar-right">

        <?php if($_SESSION['userId']==1) { ?>
        <li id="navDashboard">
          <a href="adminIndex.php">
            <i class="glyphicon glyphicon-list-alt">
              
            </i>  Dashboard
          </a>
        </li>
        <?php } ?> 

        <?php if($_SESSION['userId']==2) { ?>
        <li id="navDashboard">
          <a href="hostelIndex.php.php">
            <i class="glyphicon glyphicon-list-alt">
              
            </i>  Dashboard
          </a>
        </li>
        <?php } ?> 

        <?php if($_SESSION['userId']!=1 && $_SESSION['userId']!=2) { ?>
        <li id="navDashboard">
          <a href="userIndex.php">
            <i class="glyphicon glyphicon-list-alt">
              
            </i>  Dashboard
          </a>
        </li>
        <?php } ?> 

        <?php if($_SESSION['userId']==1 || $_SESSION['hostel']=="THN1") { ?>
        <li id="navBrand">
          <a href="thn1.php">
            <i class="glyphicon glyphicon-btc">
              
            </i>  THN1
          </a>
        </li>
		    <?php } ?>

        <?php if($_SESSION['userId']==1 || $_SESSION['hostel']=="THN2") { ?>
        <li id="navBrand">
          <a href="thn2.php">
            <i class="glyphicon glyphicon-btc">
              
            </i>  THN2
          </a>
        </li>
        <?php } ?>

        <?php if($_SESSION['userId']==1 || $_SESSION['hostel']=="MHR") { ?>
        <li id="navBrand">
          <a href="mhr.php">
            <i class="glyphicon glyphicon-btc">
              
            </i>  MHR
          </a>
        </li>
        <?php } ?>

        <?php if($_SESSION['userId']==1 || $_SESSION['hostel']=="SHR") { ?>
        <li id="navBrand">
          <a href="shr.php">
            <i class="glyphicon glyphicon-btc">
              
            </i>  SHR
          </a>
        </li>
        <?php } ?>
		
<!--         <li class="dropdown" id="navOrder">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Orders <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavAddOrder"><a href="orders.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Add Orders</a></li>            
            <li id="topNavManageOrder"><a href="orders.php?o=manord"> <i class="glyphicon glyphicon-edit"></i> Manage Orders</a></li>            
          </ul>
        </li>  -->
		
    		<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==2) { ?>
            <li id="navRequest">
              <a href="request.php"> 
                <i class="glyphicon glyphicon-check">
                  
                </i> Request New Item 
              </a>
            </li>
    		<?php } ?> 

        <li class="dropdown" id="navSetting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
            <i class="glyphicon glyphicon-user">
              
            </i> 
            <span class="caret"></span>
          </a>

          <ul class="dropdown-menu">

			      <?php if(isset($_SESSION['userId'])) { ?>

              <li id="topNavSetting">
                <a href="setting.php"> 
                  <i class="glyphicon glyphicon-wrench">
                    
                  </i> Setting
                </a>
              </li>

            <?php } ?> 
            
            <?php if($_SESSION['userId']==1) { ?>  

              <li id="topNavUser">
                <a href="user.php"> 
                  <i class="glyphicon glyphicon-wrench">
                    
                  </i> Add User
                </a>
              </li>

            <?php } ?>  

            <li id="topNavLogout">
              <a href="logout.php"> 
                <i class="glyphicon glyphicon-log-out">
                
                </i> Logout
              </a>
            </li>   

          </ul>
        </li>        
           
      </ul>
    </div>
  </div>
</nav>

<div class="container">
