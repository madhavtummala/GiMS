<?php require_once 'includes/header.php'; ?>

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

                    <?php if($_SESSION['userId']==1) { ?>
                        <div class="div-action pull pull-right" style="padding-bottom:20px;">
                            <button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel"> <i class="glyphicon glyphicon-plus-sign"></i>  Add Item</button>
                        </div>
                    <?php } ?>


                    <table class="table" id="manageBrandTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th style="width:15%;">Status</th>
                            <?php if($_SESSION['userId']==1 || $_SESSION['userId']==2) { ?>
                                <th style="width:15%;">Action</th>
                            <?php } ?>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
    <div class="modal fade" id="addBrandModel" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal" id="submitBrandForm" action="php_action/createBrand.php" method="POST">
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
    <?php } ?>


    <!-- edit brand -->
    <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']<=2) { ?>
    <div class="modal fade" id="editBrandModel" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal" id="editBrandForm" action="php_action/editBrand.php" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Item</h4>
                    </div>
                    <div class="modal-body">

                        <div id="edit-brand-messages"></div>

<!--                        <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">-->
<!--                            <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>-->
<!--                            <span class="sr-only">Loading...</span>-->
<!--                        </div>-->

                        <div class="edit-brand-result">
                            <div class="form-group">
                                <label for="editBrandName" class="col-sm-3 control-label">Name </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="editBrandName" placeholder="New Equipment Name" name="editBrandName" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editBrandStatus" class="col-sm-3 control-label">Status </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="editBrandStatus" name="editBrandStatus">
                                        <option value="">~Select Option~</option>
                                        <option value="0">Not Available</option>
                                        <option value="1">Available</option>
                                        <option value="2">Repair</option>
                                    </select>
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


    <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
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


    <?php $_SESSION['hostel']="THN2" ?>
    <script src="custom/js/brand.js"></script>

<?php require_once 'includes/footer.php'; ?>