<?php require_once 'includes/header.php';

$loginid = $_SESSION['loginid'];

/*$hostel = new mysqli($localhost, $username, $password, $_SESSION['hostel']);
// check connection
if($hostel->connect_error) {
  die("Connection Failed : " . $hostel->connect_error);
} else {
//   echo "Successfully connected";
}
*/

$sql = "SELECT * FROM student order by rollno";
$query = $connect->query($sql);
$countTotal = $query->num_rows;

echo $countTotal;

/*$sql = "SELECT * FROM equipment WHERE status = 2";
$query = $hostel->query($sql);
$countRepair = $query->num_rows;

$sql = "SELECT * FROM equipment WHERE status = 1";
$query = $hostel->query($sql);
$countAvailable = $query->num_rows;

$sql = "SELECT * FROM issued natural join equipment WHERE rollno = '$loginid'";
$query = $hostel->query($sql);

$sql = "SELECT sum(fine) as totalfine FROM issued WHERE rollno = '$loginid'";
$fine = $hostel->query($sql);

$fine = $fine->fetch_assoc();
$fine = $fine['totalfine']*/
?>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">
	<?php  if(isset($_SESSION['loginid'])) { ?>
	
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
              <?php echo $countTotal; ?>
		  </div>

		  <div class="cardContainer">
		    <p> Total Students</p>
		  </div>
		</div> 

	</div>
	
	<?php  if(isset($_SESSION['loginid'])) { ?>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i>Students</div>
			<div class="panel-body">
				<table class="table" id="productTable">
			  	<thead>
			  		<tr>	
			  			<th style="width:20%;">Roll No.</th>	
			  			<th style="width:20%;">Name</th>
                        			<th style="width:20%;">Email-id</th>
			  			<th style="width:20%;">Password</th>
			  			<th style="width:20%;">Hostel</th>
			  		</tr>
			  	</thead>
			  	<tbody>
					<?php while ($issued = $query->fetch_assoc()) { ?>
						<tr>
							<td><?php echo $issued['rollno']?></td>
							<td><?php echo $issued['name']?></td>
                            				<td><?php echo $issued['emailid']?></td>
							<td><?php echo $issued['password']?></td>
							<td><?php echo $issued['hostelname']?></td>
						</tr>

					<?php } ?>
				</tbody>
				</table>
				<!--<div id="calendar"></div>-->
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
