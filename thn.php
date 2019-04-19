<?php require_once 'includes/header.php'; 

$sql = "SELECT * FROM equipment order by eid";
$query = $hostel->query($sql);
$_SESSION['userId']=2;
$_SESSION['hostel']='THN1';
?>

    <div class="row">
        <div class="col-md-12">

            <ol class="breadcrumb">
                <li><a href="dashboard.php">Home</a></li>
                <li class="active">Items</li>
            </ol>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Items</div>
                </div>
                <div class="panel-body">
                    <div class="div-action pull pull-right" style="padding-bottom:20px;">
                        <?php if($_SESSION['userId']==2) { ?>    
                            <button class="btn btn-default button1" data-toggle="modal" data-target="#issue">
                            	<i class="glyphicon glyphicon-log-out"></i> Issue Item</button>
                            <button class="btn btn-default button1" data-toggle="modal" data-target="#return">
                            	<i class="glyphicon glyphicon-log-in"></i> Return Item</button>
                        <?php } else if($_SESSION['userId']==1) { ?>
                            <button class="btn btn-default button1" data-toggle="modal" data-target="#addItem">
                            	<i class="glyphicon glyphicon-plus-sign"></i> Add Item</button>
                            <button class="btn btn-default button1" data-toggle="modal" data-target="#editItem">
                            	<i class="glyphicon glyphicon-edit"></i> Edit Item</button>
                        <?php } ?>
                    </div>

                    <table class="table" id="manageBrandTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th style="width:15%;">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        	<?php while ($issued = $query->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $issued['eid']?></td>
									<td><?php echo $issued['name']?></td>
				                    <td>
				                    <?php if($issued['status']==1) { ?>
				                    		<label class="label label-success">Available</label> 
				                    <?php } else if($issued['status']==0) { ?>
				                    		<label class="label label-danger">Not Available</label> 
				                    <?php } else { ?>
				                    		<label class='label label-default'>Under Repair</label>
				                    <?php } ?>
				                    </td>
								</tr>
							<?php } ?>
						</tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    
    
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==2) { ?>
    <div class="modal fade" id="issue" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal" id="issueForm" action="php_action/issue.php" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-edit"></i> Issue Item</h4>
                    </div>
                    <div class="modal-body">

                        <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                            <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                            <span class="sr-only">Loading...</span>
                        </div>
						
						<div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
						</div>
						
                        <div class="edit-brand-result">
                            <div class="form-group">
                                <label for="eid" class="col-sm-3 control-label"> Equipment ID </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="eid" placeholder="Equipment ID" name="eid" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rollnoofstudent" class="col-sm-3 control-label"> Roll No. of student </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="rollnoofstudent" placeholder="Roll No. of student" name="rollnoofstudent" autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer editBrandFooter">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cancel</button>

                        <button type="submit" class="btn btn-success" id="issueBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Issue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="return" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal" id="returnForm" action="php_action/return.php" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-edit"></i> Return Item</h4>
                    </div>
                    <div class="modal-body">

                        <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                            <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                            <span class="sr-only">Loading...</span>
                        </div>

						<div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
						</div>

                        <div class="edit-brand-result">
                            
                            <div class="form-group">
                                <label for="eid" class="col-sm-3 control-label"> Equipment ID </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="eid" placeholder="Equipment ID" name="eid" autocomplete="off">
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer editBrandFooter">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cancel</button>

                        <button type="submit" class="btn btn-success" id="issueBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Issue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<?php } ?>

<?php $_SESSION['hostel']="THN1" ?>

<?php require_once 'includes/footer.php'; ?>
