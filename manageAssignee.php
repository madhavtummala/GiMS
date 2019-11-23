<?php require_once 'includes/header.php'; 

if($_SESSION['userId']!=1){
    header('location: dashboard.php');
}

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

                    <div class="remove-messages"></div>
                    <div class="issue-messages"></div>
                    <div class="edit-messages"></div>

                    <?php if($_SESSION['userId']==2) { ?>
                        <div class="div-action pull pull-right" style="padding-bottom:20px;">
                            <button class="btn btn-default button1" data-toggle="modal" data-target="#returnBrandModel" onclick="returnBrands()"> <i class="glyphicon glyphicon-refresh"></i>  Return Item</button>
                        </div>
                    <?php } ?>


                    <table class="table" id="manageBrandTable">
                        <thead>
                        <tr>
                            <th>Form ID</th>
                            <th>Assignee name</th>
                            <th style="width:15%;">Action</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- add brand -->
    
    <!-- edit brand -->
    <?php  if(isset($_SESSION['userId']) && $_SESSION['userId'] == 1) { ?>
    <div class="modal fade" id="editBrandModel" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal" id="editBrandForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-edit"></i>Change Assignee</h4>
                    </div>
                    <div class="modal-body">

                        <div class="edit-brand-result">
                            <div class="form-group">
                                <label for="editBrandName" class="col-sm-3 control-label">Name </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="editBrandName" placeholder="New Assignee Name" name="editBrandName" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editBrandEmail" class="col-sm-3 control-label">Email id </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="editBrandEmail" placeholder="Email id of assignee" name="editBrandEmail" autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer editBrandFooter">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

                        <button type="submit" class="btn btn-success" id="editBrandBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>


    <!-- remove brand -->
    <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Item</h4>
                </div>
                <div class="modal-body">
                    <p>Do you really want to remove ?</p>
                </div>
                <div class="modal-footer removeBrandFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                    <button type="button" class="btn btn-primary" id="removeBrandBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <script src="custom/js/assignee.js"></script>

<?php require_once 'includes/footer.php'; ?>
