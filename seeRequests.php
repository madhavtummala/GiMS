<?php require_once 'includes/header.php'; 
$sql = "SELECT * FROM requests order by ts desc";
$query = $hostel->query($sql);
?>

    <div class="row">
        <div class="col-md-12">

            <ol class="breadcrumb">
                <li><a href="dashboard.php">Home</a></li>
                <li class="active">Students' Requests</li>
            </ol>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-heart"></i> Students' Requests</div>
                </div>
                <div class="panel-body">

                    <table class="table" id="studentsRequestsTable">
                        <thead>
                        <tr>
                            <th>Equipment Name</th>
                            <th>Roll No.</th>
                            <th>Estimated Cost</th>
                            <th>Purchase Links</th>
                            <th>Reason</th>
                            <th>Request Date & Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        	<?php while ($req = $query->fetch_assoc()) { ?>
				<tr>
					<td><?php echo $req['equipmentname']?></td>
					<td><?php echo strtoupper($req['rollno'])?></td>
					<td><?php echo $req['estimatedcost']?></td>
					<td><?php echo $req['purchaselinks']?></td>
					<td><?php echo $req['reason']?></td>
					<td><?php echo $req['ts']?></td>
				</tr>
				<?php } ?>
			</tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    
<?php require_once 'includes/footer.php'; ?>
