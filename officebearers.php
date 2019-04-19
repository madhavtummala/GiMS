<?php require_once 'includes/header.php'; 
$sql = "SELECT * FROM officebearer order by post";
$query = $connect->query($sql);
?>

    <div class="row">
        <div class="col-md-12">

            <ol class="breadcrumb">
                <li><a href="dashboard.php">Home</a></li>
                <li class="active">Office Bearers</li>
            </ol>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-user"></i> Office Bearers</div>
                </div>
                <div class="panel-body">

                    <table class="table" id="manageBrandTable">
                        <thead>
                        <tr>
                            <th>Post</th>
                            <th>Name</th>
                            <th>Contact No.</th>
                            <th>E-mail Id</th>
                        </tr>
                        </thead>
                        <tbody>
                        	<?php while ($office = $query->fetch_assoc()) { ?>
				<tr>
					<td><?php echo $office['post']?></td>
					<td><?php echo $office['name']?></td>
					<td><?php echo $office['contactnumber']?></td>
					<td><?php echo $office['emailid']?></td>
				</tr>
				<?php } ?>
			</tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    
<?php require_once 'includes/footer.php'; ?>
