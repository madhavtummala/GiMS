<?php require_once 'includes/header.php';


if($_SESSION['userId']>1) {
    $sql = "SELECT * FROM equipment";
    $query = $hostel->query($sql);
    $countTotal = $query->num_rows;

    $sql = "SELECT * FROM equipment WHERE status = 2";
    $query = $hostel->query($sql);
    $countRepair = $query->num_rows;

    $sql = "SELECT * FROM equipment WHERE status = 1";
    $query = $hostel->query($sql);
    $countAvailable = $query->num_rows;
}

if($_SESSION['userId']>2) {
    $sql = "SELECT * FROM issued natural join equipment WHERE rollno = '$roll_no'";
    $query = $hostel->query($sql);

    $roll_no = $_SESSION['userId'];
    $sql = "SELECT sum(fine) as totalfine FROM issued WHERE rollno = '$roll_no'";
    $fine = $hostel->query($sql);

    $fine = $fine->fetch_assoc();
    $fine = $fine['totalfine'];
}
else if($_SESSION['userId']==2)
{
    $hostel_name = $_SESSION['hostel'];
    $sql = "SELECT * FROM issued natural join equipment";
    $query = $hostel->query($sql);

    $sql = "SELECT * FROM student WHERE hostelname = '$hostel_name'";
    $fine = $connect->query($sql);
    $fine = $fine->num_rows;

//    $hostel_name = $_SESSION['hostel'];
//    $sql = "SELECT rollno FROM student WHERE hostelname = '$hostel_name'";
//    $query = $connect->query($sql);
//
//    $output = array();
//
//    while($row = $query->fetch_array())
//    {
//        $roll_no = $row['rollno'];
//
//        $sql = "SELECT sum(fine) as totalfine FROM issued WHERE rollno = '$roll_no'";
//        $fine = $hostel->query($sql);
//        $fine = $fine->fetch_assoc();
//        $fine = $fine['totalfine'];
//
//        $sql = "SELECT count(*) as num_issued FROM issued WHERE rollno = '$roll_no'";
//        $num = $hostel->query($sql);
//        $num = $num->fetch_assoc();
//        $num = $num['num_issued'];
//
//        $output[]=array($roll_no, $fine, $num);
//    }
//
//    echo json_encode($output);

}
else
{
    $sql = "SELECT * FROM student";
    $query = $connect->query($sql);
    $fine = $query->num_rows;
}

$hostel->close();
?>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']>1) { ?>
	<div class="col-md-4">
		<div class="panel panel-success">
			<div class="panel-heading">
				
				<a href="brand.php" style="text-decoration:none;color:black;">
					Item Available
					<span class="badge pull pull-right"><?php echo $countAvailable; ?></span>
				</a>
				
			</div>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="brand.php" style="text-decoration:none;color:black;">
					Items under Repair
					<span class="badge pull pull-right"><?php echo $countRepair; ?></span>
				</a>
				
			</div>
		</div>
	</div>

        <div class="col-md-4">
			<div class="panel panel-info">
			<div class="panel-heading">
				<a href="brand.php?o=manord" style="text-decoration:none;color:black;">
					Total Items
					<span class="badge pull pull-right"><?php echo $countTotal; ?></span>
				</a>
					
			</div>
		</div>
		</div>

    <?php } ?>



    <div class="col-md-4">
		<div class="card">
		  <div class="cardHeader">
		    <h1><?php echo date('d'); ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
		  </div>
		</div> 
		<br/>

		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
              <?php echo $fine; ?>
		  </div>

		  <div class="cardContainer">
              <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']<=2) { ?>
		        <p> Total Students</p>
              <?php } ?>
              <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']>2) { ?>
                  <p> Total Fine</p>
              <?php } ?>
		  </div>
		</div> 

	</div>
	
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> All Students</div>
			<div class="panel-body">
				<table class="table" id="productTable">
			  	<thead>
			  		<tr>
			  			<th style="width:20%;">Roll No</th>
                        <th style="width:20%;">Name</th>
			  			<th style="width:20%;">Hostel</th>
			  		</tr>
			  	</thead>
			  	<tbody>
					<?php while ($issued = $query->fetch_assoc()) { ?>
						<tr>
							<td><?php echo $issued['rollno']?></td>
                            <td><?php echo $issued['name']?></td>
							<td><?php echo $issued['hostelname']?></td>

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
                            <th style="width:20%;">Name of Equipment</th>
                            <th style="width:20%;">Date of Issue</th>
                            <th style="width:20%;">Fine</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($issued = $query->fetch_assoc()) { ?>
                            <tr>
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
