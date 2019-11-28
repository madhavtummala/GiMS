<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; 

if($_SESSION['userId']!=1) {
    header('location: dashboard.php');
}
?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">OfficeBearers</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage OfficeBearers</div>
			</div> 
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addUserModalBtn" data-target="#addUserModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add OfficeBearer </button>
				</div> 
				
				<table class="table" id="manageUserTable">
					<thead>
						<tr>
							<th style="width:10%;">Name</th>
							<th style="width:10%;">Login Id</th>
							<th style="width:15%;">Password</th>
							<th style="width:15%;">Post</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>

			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitUserForm" action="php_action/createOfficeBearer.php" method="POST">

	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add OfficeBearer</h4>
	      </div>

	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="add-user-messages"></div>
	      		     	           	       
	        <div class="form-group">
	        	<label for="uroll" class="col-sm-3 control-label">Login Id: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="uroll" placeholder="Login Id of the OfficeBearer" name="uroll" autocomplete="off">
				    </div>
	        </div> 

	        <div class="form-group">
	        	<label for="upass" class="col-sm-3 control-label">Password: </label>
	        	
				    <div class="col-sm-8">
				      <input type="password" class="form-control" id="upass" placeholder="Initial Password" value="password" name="upass" autocomplete="off">
				    </div>
	        </div> 	
			
			<div class="form-group">
	        	<label for="u1" class="col-sm-3 control-label">Name: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="u1" placeholder="Name"  name="u1" autocomplete="off">
				    </div>
	        </div> 	
			
			<div class="form-group">
	        	<label for="u2" class="col-sm-3 control-label">Contact Number: </label>
	        	
				    <div class="col-sm-8">
				      <input type="number" class="form-control" id="u2" placeholder="Contact Number" name="u2" autocomplete="off">
				    </div>
	        </div> 	
			
			<div class="form-group">
	        	<label for="u3" class="col-sm-3 control-label">Permission: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="u3" placeholder="Default" value="4" name="u3" autocomplete="off">
				    </div>
	        </div> 	

	        <div class="form-group">
	        	<label for="uhostel" class="col-sm-3 control-label">Post: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="uhostel" placeholder="post" name="uhostel" autocomplete="off">
				    </div>
	        </div> 	                         
	        	         	        
	      </div> 
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createUserBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div> 
     	</form> 
    </div> 
  </div> 
</div> 


<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
    	<form class="form-horizontal" id="editUserForm">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-edit"></i> Edit OfficeBearer</h4>
			</div>

	      	<div class="modal-body" style="max-height:450px; overflow:auto;">

		    	<div id="edit-user-messages"></div>

		    	<div class="form-group">
	        	<label for="uroll1" class="col-sm-3 control-label">New Login Id: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="uroll1" placeholder="Login Id of the office bearer" name="uroll1" autocomplete="off">
				    </div>
	        </div> 

	        <div class="form-group">
	        	<label for="upass1" class="col-sm-3 control-label">New Password: </label>
	        	
				    <div class="col-sm-8">
				      <input type="password" class="form-control" id="upass1" placeholder="Initial Password" name="upass1" autocomplete="off">
				    </div>
	        </div> 	
			
			<div class="form-group">
	        	<label for="u11" class="col-sm-3 control-label">New name: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="u11" placeholder="Name"  name="u11" autocomplete="off">
				    </div>
	        </div> 	
			
			<div class="form-group">
	        	<label for="u21" class="col-sm-3 control-label">New Contact Number: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="u21" placeholder="Contact Number" name="u21" autocomplete="off">
				    </div>
	        </div> 	
			
			<div class="form-group">
	        	<label for="u31" class="col-sm-3 control-label">New Permission: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="u31" placeholder="Default" name="u31" autocomplete="off">
				    </div>
	        </div> 	

	        <div class="form-group">
	        	<label for="uhostel1" class="col-sm-3 control-label">New Post: </label>
	        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="uhostel1" placeholder="post" name="uhostel1" autocomplete="off">
				    </div>
	        </div> 	                         
	        	         	        
	      </div> 

		        <div class="modal-footer editUserFooter">
			        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
			        
			        <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			    </div> 

			</div>

		</form>
				    
	</div>

</div>
</div> 

<div class="modal fade" tabindex="-1" role="dialog" id="removeUserModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove OfficeBearer</h4>
      </div>
      <div class="modal-body">

      	<div class="removeUserMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div>
  </div>
</div>



	<script src="custom/js/officeBearer.js"></script>

<?php require_once 'includes/footer.php'; ?>