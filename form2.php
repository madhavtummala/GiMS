<?php 
require_once 'includes/header.php';
/*echo '<pre>';
var_dump($_SESSION);
echo '</pre>';*/
$_SESSION['formtype'] = "3_2";
?>
<form class="form-horizontal" id="submitCommunityCentreForm" action="submitForm.php" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-plus" ></i> Add Item</h4>
                    </div>
                    <div class="modal-body">

                        <div id="add-brand-messages"></div>

                        <div id="add-brand-result">                          

                            <div class="form-group">
                                <label for="addName" class="col-sm-3 control-label">First Name </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="addName" placeholder="First name" name="u1" autocomplete="off" 
									<?php 
									if (isset($_SESSION['inputValues']['name']))
									{ 
										echo 'value = '.$_SESSION['inputValues']['name'];
									}?>
									>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="addCost" class="col-sm-3 control-label">Middle Name(s) </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="addCost" placeholder="Middle Name(s)" name="u2" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="addInvoiceno" class="col-sm-3 control-label">Last Name </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="addInvoiceno" placeholder="Last name" name="u3" autocomplete="off">
                                </div>
                            </div>
							
							<div class="form-group">
                                <label for="addCost" class="col-sm-3 control-label">Designation </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="u4" placeholder="Designation" name="u4" autocomplete="off">
                                </div>
                            </div>
							
							<div class="form-group">
                                <label for="addCost" class="col-sm-3 control-label">School / Section / SRIC Project No </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="u5" placeholder="Project No." name="u5" autocomplete="off">
                                </div>
                            </div>
							
							<div class="form-group">
                                <label for="addCost" class="col-sm-3 control-label">Employee Code / Staff ID Number </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="u6" placeholder="Employee no." name="u6" autocomplete="off">
                                </div>
                            </div>
							
							<div class="form-group">
                                <label for="addCost" class="col-sm-3 control-label">Date of Contract Expiry / Project completion </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="u7" placeholder="Date (dd/mm/yy)" name="u7" autocomplete="off">
                                </div>
                            </div>
							
							<div class="form-group">
                                <label for="addCost" class="col-sm-3 control-label">List of Preferred Email IDs (3 total, comma separated) </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="u8" placeholder="Emails" name="u8" autocomplete="off">
                                </div>
                            </div>
							
							<div class="form-group">
                                <label for="addCost" class="col-sm-3 control-label">Email to Send Login / Password: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="u9" placeholder="Emails" name="u9" autocomplete="off">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer createBrandFooter">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="createBrandBtn" data-loading-text="Loading..." autocomplete="off">Submit form</button>
                    </div>

                </form>
	<!--<script src="custom/js/forms.js"></script>-->
<?php require_once 'includes/footer.php'; ?>