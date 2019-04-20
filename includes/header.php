<?php require_once 'php_action/core.php'; ?>

<!DOCTYPE html>
<html>

<head>

  <title>Gymkhana Inventory Management System</title>

  <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">


  <link rel="stylesheet" href="custom/css/custom.css">

  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">


  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">


  <script src="assests/jquery/jquery.min.js"></script>

  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>


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

      <a class="navbar-brand" href="/Gymkhana" style="padding:0px;">
        <font size="5">
          <img src="logo.jpg" alt="IIT Bhubaneswar"> Students' Gymkhana
        </font>
      </a>

    </div>

    <?php if(isset($_SESSION['userId'])) { ?>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">

        <li id="navDashboard">
          <a href="index.php">
            <i class="glyphicon glyphicon-list-alt">
              
            </i>  Dashboard
          </a>
        </li>

        <?php if($_SESSION['userId']==1 || $_SESSION['hostel']=="THN1") { ?>

        <li id="navTHN1">
          <a href="thn1.php">
            <i class="glyphicon glyphicon-th-list">
              
            </i>  THN1
          </a>
        </li>

        <?php } ?>

        <?php if($_SESSION['userId']==1 || $_SESSION['hostel']=="THN2") { ?>

        <li id="navTHN2">
          <a href="thn2.php">
            <i class="glyphicon glyphicon-th-list">
              
            </i>  THN2
          </a>
        </li>

        <?php } ?>

        <?php if($_SESSION['userId']==1 || $_SESSION['hostel']=="MHR") { ?>

        <li id="navMHR">
          <a href="mhr.php">
            <i class="glyphicon glyphicon-th-list">
              
            </i>  MHR
          </a>
        </li>

        <?php } ?>

        <?php if($_SESSION['userId']==1 || $_SESSION['hostel']=="SHR") { ?>

        <li id="navSHR">
          <a href="shr.php">
            <i class="glyphicon glyphicon-th-list">
              
            </i>  SHR
          </a>
        </li>

        <?php } ?>

        <?php if($_SESSION['userId']==2) { ?>

        <li id="navseerequest">
          <a href="seeRequests.php">
            <i class="glyphicon glyphicon-tags">
              
            </i>  Students' Requests
          </a>
        </li>

        <?php } ?>

        <?php  if($_SESSION['userId']>2) { ?>

        <li id="navRequest">
          <a href="request.php"> 
            <i class="glyphicon glyphicon-tag">
              
            </i> Request New Item 
          </a>
        </li>

        <?php } ?>

        <li class="dropdown" id="navSetting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
            <i class="glyphicon glyphicon-user">
              
            </i> 
            <span class="caret">
              
            </span>
          </a>

          <ul class="dropdown-menu">

            <li id="topNavSetting">
              <a href="setting.php"> 
                <i class="glyphicon glyphicon-wrench">
                  
                </i> Profile Settings
              </a>
            </li>

            <?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>

            <li id="topNavUser">
              <a href="user.php"> 
                <i class="glyphicon glyphicon-wrench">
                  
                </i> Add User
              </a>
            </li>

            <?php } ?>

            <li id="topNavOB">
              <a href="officebearers.php"> 
                <i class="glyphicon glyphicon-user">
                  
                </i> Office Bearers
              </a>
            </li>

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

    <?php } ?>

  </div>
</nav>

<div class="container">