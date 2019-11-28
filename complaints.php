<?php require_once 'includes/header.php'; 

if($_SESSION['userId']<=2) {
    header('location: dashboard.php');
}

?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-shopping-cart"></i>	Register a complaint
			</div>
			<div class="panel-body">
				<div class="changePasswordMessages"></div>
				
				<form class="form-horizontal" action="php_action/newComplaint.php" method="post" id="newRequestForm">
				  <div class="form-group">
				    <label for="equipmentName" class="col-sm-2 control-label">Title</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="equipmentName" name="equipmentName" placeholder="Title of your complaint" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="reason" class="col-sm-2 control-label">Body</label>
				    <div class="col-sm-10">
				      <textarea id="reason" name="reason" cols="100" rows="5" placeholder="Explain your complaint"></textarea>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="purchaseLinks" class="col-sm-2 control-label">Particular council/post/person</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="purchaseLinks" name="purchaseLinks" placeholder="Anything or anyone you want to refer in specific" />
				    </div>
				  </div>				  
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				    	<input type="hidden" name="user_id" id="user_id" value="<?php echo $result['rollno'] ?>" />
				      <button type="submit" class="btn btn-success" id="submitRequestBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Submit Request</button>
				    </div>
				  </div>
				</form>

			</div>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
            <li><a href="dashboard.php">Home</a></li>
            <li class="active">Requests</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Requests</div>
            </div>
            <div class="panel-body">

                <div class="remove-messages"></div>
                <div class="edit-messages"></div>

                <table class="table" id="manageBrandTable">
                    <thead>
                    <tr>
                        <th style="width:10%;">Title</th>
                        <th style="width:25%;">Reason</th>
                        <th style="width:20%;">Target</th>
                        <th style="width:10%;">Date & Time</th>
						<th style="width:10%;">Status</th>
                        <th style="width:15%;">Actions</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- resubmit brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="resubmitMemberModel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-refresh"></i> Resubmit</h4>
            </div>
            <div class="modal-body">
                <p>Do you really want to resubmit?</p>
            </div>
            <div class="modal-footer resubmitBrandFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                <button type="button" class="btn btn-primary" id="resubmitBrandBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- delete brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteMemberModel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove</h4>
            </div>
            <div class="modal-body">
                <p>Do you really want to remove?</p>
            </div>
            <div class="modal-footer deleteBrandFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-delete-sign"></i> Close</button>
                <button type="button" class="btn btn-primary" id="deleteBrandBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
            </div>
        </div>
    </div>
</div>  

<!-- <script src="custom/js/complaint.js"></script> -->
<script src="custom/js/actComplaint.js"></script>

<?php require_once 'includes/footer.php'; ?>
