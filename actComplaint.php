<?php require_once 'includes/header.php'; 

if($_SESSION['userId']>2) {
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
                            <th style="width:10%;">Title</th>
                            <th style="width:10%;">Roll No</th>
                            <th style="width:35%;">Reason</th>
                            <th style="width:20%;">Target</th>
                            <th style="width:10%;">Date & Time</th>
                            <th style="width:15%;">Actions</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- accept brand -->
    <div class="modal fade" tabindex="-1" role="dialog" id="acceptMemberModel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Accept Application</h4>
                </div>
                <div class="modal-body">
                    <p>Do you really want to accept?</p>
                </div>
                <div class="modal-footer acceptBrandFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-accept-sign"></i> Close</button>
                    <button type="button" class="btn btn-primary" id="acceptBrandBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
                </div>
            </div>
        </div>
    </div>  

    <!-- remove brand -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-remove"></i> Reject Application</h4>
                </div>
                <div class="modal-body">
                    <p>Do you really want to reject?</p>
                </div>
                <div class="modal-footer removeBrandFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                    <button type="button" class="btn btn-primary" id="removeBrandBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="custom/js/actComplaint.js"></script>

<?php require_once 'includes/footer.php'; ?>
