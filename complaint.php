<?php 
require_once 'includes/header.php';
$_SESSION['formtype'] = "4_2";
?>
<form class="form-horizontal" id="submitCommunityCentreForm" action="submitForm.php" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-plus" ></i> Complaint log</h4>
                    </div>
                    <div class="modal-body">

                        <div id="add-brand-messages"></div>

                        <div id="add-brand-result">                          

                            <div class="form-group">
                                <label for="addName" class="col-sm-3 control-label">Which member do you want to file complaint against? </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="addName" placeholder="Name" name="u1" autocomplete="off" 
									<?php 
									if (isset($_SESSION['inputValues']['name']))
									{ 
										echo 'value = '.$_SESSION['inputValues']['name'];
									}?>
									>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="returnReason" class="col-sm-3 control-label">Which council does he belong to? </label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="u2" name="u2">
                                        <option value="">~Select Option~</option>
                                        <option value="0">Cultural</option>
                                        <option value="1">Technical</option>
                                        <option value="2">Sports</option>
										<option value="3">Office</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="addInvoiceno" class="col-sm-3 control-label">Reason</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="u3" placeholder="Reason" name="u3" autocomplete="off">
                                </div>
                            </div>
                    <div class="modal-footer createBrandFooter">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="createBrandBtn" data-loading-text="Loading..." autocomplete="off">Submit form</button>
                    </div>

                </form>
<?php require_once 'includes/footer.php'; ?>