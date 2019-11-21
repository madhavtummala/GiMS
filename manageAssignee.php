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
    <!--<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
    <div class="modal fade" id="addBrandModel" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal" id="submitBrandForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Item</h4>
                    </div>
                    <div class="modal-body">

                        <div id="add-brand-messages"></div>

                        <div id="add-brand-result">                          

                            <div class="form-group">
                                <label for="addName" class="col-sm-3 control-label">Name </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="addName" placeholder="Name of the Item" name="addName" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="addCost" class="col-sm-3 control-label">Cost </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="addCost" placeholder="Cost of the Item" name="addCost" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="addInvoiceno" class="col-sm-3 control-label">Invoice No </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="addInvoiceno" placeholder="Invoice no of Bill" name="addInvoiceno" autocomplete="off">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="productImage" class="col-sm-3 control-label">Product Image </label>
                                    <div class="col-sm-8">
                                            <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>                          
                                        <div class="kv-avatar center-block">                            
                                            <input type="file" class="form-control" id="productImage" placeholder="Product Name" name="productImage" class="file-loading" style="width:auto;"/>
                                        </div>
                                      
                                    </div>
                            </div>                             

                        </div>
                    </div>

                    <div class="modal-footer createBrandFooter">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="createBrandBtn" data-loading-text="Loading..." autocomplete="off">Add Item</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php } ?>-->
    
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
                                <label for="editBrandName" class="col-sm-3 control-label">Email id </label>
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
