<?php 
require_once 'includes/header.php';
/*echo '<pre>';
var_dump($_SESSION);
echo '</pre>';*/
$_SESSION['formtype'] = "3.1";
?>
<form class="form-horizontal" id="submitCommunityCentreForm" action="php_action/submitForm.php" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-plus" ></i> Add Item</h4>
                    </div>
                    <div class="modal-body">

                        <div id="add-brand-messages"></div>

                        <div id="add-brand-result">                          

                            <div class="form-group">
                                <label for="addName" class="col-sm-3 control-label">Name </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="addName" placeholder="Name of the Item" name="addName" autocomplete="off" 
									<?php 
									if (isset($_SESSION['inputValues']))
									{ 
										echo 'value = '.$_SESSION['inputValues']['name'];
									}?>
									>
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
	<!--<script src="custom/js/forms.js"></script>-->
<?php require_once 'includes/footer.php'; ?>