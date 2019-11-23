<?php require_once 'includes/header.php'; 

if(!($_SESSION['userId'])) {
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
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Applications</div>
                </div>
                <div class="panel-body">

                    <div class="resubmit-messages"></div>
                    <div class="delete-messages"></div>

                    <table class="table" id="manageBrandTable">
                        <thead>
                        <tr>
                            <th>Assignee</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
							<th style="width:15%;">Preview</th>
                            <th style="width:15%;">Action</th>
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

    <script src="custom/js/forms.js"></script>

<?php require_once 'includes/footer.php'; ?>
