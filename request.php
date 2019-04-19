<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>	Request New Item
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<div class="changePasswordMessages"></div>
				
				<form class="form-horizontal" action="php_action/newRequest.php" method="post" id="newRequestForm">
				  <div class="form-group">
				    <label for="equipmentName" class="col-sm-2 control-label">Equipment Name</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="equipmentName" name="equipmentName" placeholder="Equipment Name" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="estimatedCost" class="col-sm-2 control-label">Estimated Cost</label>
				    <div class="col-sm-10">
				      <input type="number" class="form-control" id="estimatedCost" name="estimatedCost" placeholder="Estimated Cost" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="purchaseLinks" class="col-sm-2 control-label">Purchase Links</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="purchaseLinks" name="purchaseLinks" placeholder="Purchase Links" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="reason" class="col-sm-2 control-label">Reason</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="reason" name="reason" placeholder="Reason" />
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success" id="submitRequestBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Submit Request</button>
				    </div>
				  </div>
				</form>

			</div>
			<!-- /panel-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
</div>
<!-- /row -->

<script src="custom/js/request.js"></script>

<?php require_once 'includes/footer.php'; ?>