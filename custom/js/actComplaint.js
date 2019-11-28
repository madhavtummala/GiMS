var manageBrandTable;

$(document).ready(function() {
	
	manageBrandTable = $("#manageBrandTable").DataTable({
		'ajax': 'php_action/fetchComplaints.php',
		'order': []
	});

});

function editBrands(request = null) {
	if(request) {

		$('#editBrandBtn').unbind('click').bind('click', function() {

			$('#editBrandBtn').button('loading');

			$.ajax({
				url: 'php_action/acceptComplaint.php',
				type: 'post',
				data: {request : request},
				dataType: 'json',
				success:function(response) {

					console.log(response);

					$('#editBrandBtn').button('reset');

					if(response.success == true) {

						manageBrandTable.ajax.reload(null, false);

						$('#editMemberModel').modal('hide');

						$('.remove-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          	'</div>');

						$('.alert-success').delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						});
					} else {

						$('#editMemberModel').modal('hide');

						$('.remove-messages').html('<div class="alert alert-warning">'+
							'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
							'<strong><i class="glyphicon glyphicon-warning-sign"></i></strong> '+ response.messages +
							'</div>');

						$('.alert-warning').delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						});
					}
				} 
			});
		});

	} else {
		alert('error!! Refresh the page again');
	}
}

function removeBrands(request = null) {
	if(request) {

		$('#removeBrandBtn').unbind('click').bind('click', function() {

			$('#removeBrandBtn').button('loading');

			$.ajax({
				url: 'php_action/dismissComplaint.php',
				type: 'post',
				data: {request : request},
				dataType: 'json',
				success:function(response) {

					console.log(response);

					$('#removeBrandBtn').button('reset');

					if(response.success == true) {

						manageBrandTable.ajax.reload(null, false);

						$('#removeMemberModel').modal('hide');

						$('.remove-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          	'</div>');

						$('.alert-success').delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						});
					} else {

						$('#removeMemberModel').modal('hide');

						$('.remove-messages').html('<div class="alert alert-warning">'+
							'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
							'<strong><i class="glyphicon glyphicon-warning-sign"></i></strong> '+ response.messages +
							'</div>');

						$('.alert-warning').delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						});
					}
				} 
			});
		});

	} else {
		alert('error!! Refresh the page again');
	}
}
