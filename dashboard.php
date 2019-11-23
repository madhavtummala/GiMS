<?php 

//session_start();

require_once 'php_action/db_connect.php';
require_once 'includes/header.php';

if($_SESSION['userId']>1) {

    $sql = "SELECT * FROM equipment WHERE status = 0";
    $query = $hostel->query($sql);
    $countIssued = $query->num_rows;

    $sql = "SELECT * FROM equipment WHERE status = 2";
    $query = $hostel->query($sql);
    $countRepair = $query->num_rows;

    $sql = "SELECT * FROM equipment WHERE status = 1";
    $query = $hostel->query($sql);
    $countAvailable = $query->num_rows;

}

if($_SESSION['userId']>2) {

    $roll_no = $_SESSION['userId'];

    $sql = "SELECT * FROM issued natural join equipment WHERE rollno = '$roll_no'";
    $query = $hostel->query($sql);


    $sql = "SELECT sum(fine) as totalfine FROM issued WHERE rollno = '$roll_no'";
    $fine = $hostel->query($sql);
    $fine = $fine->fetch_assoc();

    if($fine['totalfine'])
        $fine = $fine['totalfine'];
    else
        $fine = 0;

    $sql = "SELECT name from student WHERE rollno = '$roll_no'";
	//echo $sql;
    $result = $connect->query($sql);
	$studname = $result->fetch_array();
	//var_dump($studname);
}
else if($_SESSION['userId']==-2)
{
	$emailid = $_SESSION['loginId'];
	$sql = "SELECT name, post from officebearer WHERE emailid = '$emailid'";
	$result = $connect->query($sql);
	$ofname = $result->fetch_array();
	$_SESSION['aname'] = $ofname[0];
	$sql = "SELECT * from currentapplications WHERE assignee = '$ofname[0]'";
	$result = $forms->query($sql);
	$fine = $result->num_rows;
	ob_start(); // begin collecting output
	include 'php_action/fetchForm.php';
    $result = ob_get_clean(); 
	//echo $result;
	$result = json_decode($result, true);
}
else if($_SESSION['userId']==2)
{
    $hostel_name = $_SESSION['hostel'];
    $sql = "SELECT * FROM issued natural join equipment";
    $query = $hostel->query($sql);

    $sql = "SELECT * FROM student WHERE hostelname = '$hostel_name'";
    $fine = $connect->query($sql);
    $fine = $fine->num_rows;
}
else
{
    $sql = "SELECT * FROM hostel";
    $output = $connect->query($sql);
    $fine = $output->num_rows;

    $query = array();

    while($row = $output->fetch_array()) {

        $test = new mysqli($localhost, $username, $password, $row[1]);
        // check connection
        if ($hostel->connect_error) {
            die("Connection Failed : " . $hostel->connect_error);
        } else {
//               echo "Successfully connected " . $row[1];
        }

        $sql = "SELECT * FROM student WHERE hostelname='$row[0]'";
        $stud = $connect->query($sql);

        $sql = "SELECT * FROM equipment";
        $equip = $test->query($sql);

        $query[] = array(
                $row[1],
            $stud->num_rows,
            $equip->num_rows
        );

    }
}

// echo "out dashboard";

?>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']>1) { ?>
	<div class="col-md-4">
		<div class="panel panel-success">
			<div class="panel-heading">
				
				<a href="#" style="text-decoration:none;color:black;">
					Items Available
					<span class="badge pull pull-right"><?php echo $countAvailable; ?></span>
				</a>
				
			</div>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading">
				<a href="#" style="text-decoration:none;color:black;">
					Issued Items
					<span class="badge pull pull-right"><?php echo $countIssued; ?></span>
				</a>
				
			</div>
		</div>
	</div>

        <div class="col-md-4">
			<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="#" style="text-decoration:none;color:black;">
					Items Under Repair
					<span class="badge pull pull-right"><?php echo $countRepair; ?></span>
				</a>
					
			</div>
		</div>
		</div>

    <?php } ?>

    <div class="col-md-4">
		<div class="card">
		  <div class="cardHeader">
		    <h1><?php echo date('l') .' '.date('d').', '.date('Y'); ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p>Date</p>
		  </div>
		</div> 
		<br/>

		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
              <?php echo $fine; ?>
		  </div>

		  <div class="cardContainer">
              <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==2) { ?>
		        <p> Total Students</p>
              <?php } ?>
              <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
                  <p> Total Hostels</p>
              <?php } ?>
              <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']>2) { ?>
                  <p> Total Fine</p>
              <?php } ?>
			  <?php  if(isset($_SESSION['userId']) && $_SESSION['userId'] == -2) { ?>
                  <p> Total Forms</p>
              <?php } ?>
		  </div>
		</div> 
		</br>

		<div class="card">
		  <div class="cardHeader">
		  <!--TODO: Use logic to generate URL like < ?php echo date('l') .' '.date('d').', '.date('Y'); ?>-->
		    <h1>
			<?php  if(isset($_SESSION['userId']) && $_SESSION['userId'] == -1) { ?>
			<!-- -1 means won't execute. Band aid for now-->
		        <p> Hi, admin!</p>
              <?php } ?>
              <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
                  <p> Hi, MainAdmin!</p>
              <?php } ?>
              <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']>2) { ?>
                  <p> Hi, <?php echo $studname[0]?>!</p>
              <?php } ?>
			  <?php  if(isset($_SESSION['userId']) && $_SESSION['userId'] == -2) { ?>
                  <p> Hi, <?php echo $ofname[0]?>!</p>
              <?php } ?>
			</h1>
		  </div>

		  <div class="cardContainer">
		    <p>
			<?php if(isset($_SESSION['userId']) && $_SESSION['userId']>2) { ?>
				<a href="submitForms.php">Submit Form</a> &nbsp&nbsp&nbsp <a href="checkForms.php">Check Status</a>
			<?php } else if(isset($_SESSION['userId']) && $_SESSION['userId'] == 1) { ?>
				<a href="manageAssignee.php">Change form assignee</a>
			<?php } else if(isset($_SESSION['userId']) && $_SESSION['userId'] == -2) { 
				echo $ofname[1];
			} ?>
			</p>
		  </div>
		</div> 
		<br/>
		
	</div>
	
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==-2) { ?>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> All forms</div>
			<div class="panel-body">
				<table class="table" id="productTable">
			  	<thead>
			  		<tr>
			  			<th style="width:20%;">Submitter</th>
                        <th style="width:20%;">Date</th>
			  			<th style="width:20%;">Preview</th>
			  		</tr>
			  	</thead>
			  	<tbody>
					<?php foreach($result as $res) { ?>
						<tr>
							<td><?php echo $res[0]?></td>
                            <td><?php echo $res[1]?></td>
							<td><?php echo $res[2]?></td>
						</tr>
					<?php } ?>
				</tbody>
				</table>
			</div>
		</div>

	</div>
	<?php  } ?>
	
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> All Hostels</div>
			<div class="panel-body">
				<table class="table" id="productTable">
			  	<thead>
			  		<tr>
			  			<th style="width:20%;">Hostel</th>
                        <th style="width:20%;">Students</th>
			  			<th style="width:20%;">Equipment</th>
			  		</tr>
			  	</thead>
			  	<tbody>
					<?php for($x = 0;$x<$fine;$x++) { ?>
						<tr>
							<td><?php echo $query[$x][0]?></td>
                            <td><?php echo $query[$x][1]?></td>
							<td><?php echo $query[$x][2]?> Items</td>
						</tr>
					<?php } ?>
				</tbody>
				</table>
			</div>
		</div>

	</div>
	<?php  } ?>

    <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==2) { ?>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Current Issued Items</div>
                <div class="panel-body">
                    <table class="table" id="productTable">
                        <thead>
                        <tr>
                            <th style="width:20%;">Student</th>
                            <th style="width:20%;">Equipment</th>
                            <th style="width:20%;">Date of Issue</th>
                            <th style="width:20%;">Fine</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($issued = $query->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $issued['rollno']?></td>
                                <td><?php echo $issued['name']?></td>
                                <td><?php echo $issued['dateofissue']?></td>
                                <td><?php echo $issued['fine']?> Rs</td>
                            </tr>

                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    <?php  } ?>

    <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']>2) { ?>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Your Issued Items</div>
                <div class="panel-body">
                    <table class="table" id="productTable">
                        <thead>
                        <tr>
                            <th style="width:10%;">EID</th>
                            <th style="width:30%;">Name of Equipment</th>
                            <th style="width:30%;">Date of Issue</th>
                            <th style="width:30%;">Fine</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($issued = $query->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $issued['eid']?></td>
                                <td><?php echo $issued['name']?></td>
                                <td><?php echo $issued['dateofissue']?></td>
                                <td>Rs. <?php echo $issued['fine']?></td>

                            </tr>

                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    <?php  } ?>
	
</div> <!--/row-->

<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>


<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

      $('#calendar').fullCalendar({
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'
        }
      });


    });
</script>

<?php require_once 'includes/footer.php'; ?>