var manageBrandTable;

$(document).ready(function() {
	
	manageBrandTable = $("#manageBrandTable").DataTable({
		'ajax': 'php_action/fetchRequests.php',
		'order': []
	});

});

function editBrands(request = null) {
	if(request) {

		$('#editBrandForm').unbind('submit').bind('submit', function() {

			$('.text-danger').remove();
			$('.form-group').removeClass('has-error').removeClass('has-success');

			var brandName = $('#editBrandName').val();
			var brandCost = $('#editBrandCost').val();
			var brandInvoice = $('#editBrandInvoice').val();
			
			if(brandInvoice == "") {
				$('#editBrandInvoice').after('<p class="text-danger"> Invoice field is required</p>');
				$('#editBrandInvoice').closest('#form-group').addClass('has-error');
			} else {
				$('#editBrandInvoice').find('#text-danger').remove();
				$('#editBrandInvoice').closest('#form-group').addClass('has-success');
			}

			if(brandInvoice) {
				var form = $(this);

				$('#editBrandBtn').button('loading');
				var data=new FormData(this);
				data.append('request',request)

				$.ajax({
					url: 'php_action/acceptRequest.php',
					type: 'post',
					data: data,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success:function(response) {

						console.log(response);

						$('#editBrandBtn').button('reset');

						if(response.success == true) {

							manageBrandTable.ajax.reload(null, false);

							$('#editBrandForm')[0].reset();
							$('.text-danger').remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							$('#editBrandModel').modal('hide');

							$('.edit-messages').html('<div class="alert alert-success">'+
								'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
								'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
								'</div>');

							$('.alert-success').delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							});
						}
						else{

							$('#editBrandForm')[0].reset();
							$('.text-danger').remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							$('#editBrandModel').modal('hide');

							$('.edit-messages').html('<div class="alert alert-warning">'+
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

			}

			return false;
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
				url: 'php_action/dismissRequests.php',
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
