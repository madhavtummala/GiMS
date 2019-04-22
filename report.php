<?php require_once 'includes/header.php'; 

if($_SESSION['userId']!=2) {
    header('location: dashboard.php');
}

?>

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
                            <th style="width:10%;">Equipment Name</th>
                            <th style="width:10%;">Roll No</th>
                            <th style="width:5%;">Estimated Cost</th>
                            <th style="width:20%;">Purchase Links</th>
                            <th style="width:25%;">Reason</th>
                            <th style="width:10%;">Date & Time</th>
                            <th style="width:15%;">Actions</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- edit brand -->
    <div class="modal fade" id="editBrandModel" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal" id="editBrandForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-edit"></i> Accept Request</h4>
                    </div>
                    <div class="modal-body">

                        <div class="edit-brand-result">
                            <div class="form-group">
                                <label for="editBrandName" class="col-sm-3 control-label">Name </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="editBrandName" placeholder="Equipment Name(if different)" name="editBrandName" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editBrandCost" class="col-sm-3 control-label">Cost </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="editBrandCost" placeholder="Cost of the item(if different)" name="editBrandCost" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editBrandInvoice" class="col-sm-3 control-label">Invoice No </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="editBrandInvoice" placeholder="Invoice No" name="editBrandInvoice" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="productImage" class="col-sm-3 control-label">Upload image(<2MB) </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
    								<input type="file" name="productImage" id="productImage">
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


    <!-- remove brand -->
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

    <script src="custom/js/report.js"></script>

<?php require_once 'includes/footer.php'; ?>
