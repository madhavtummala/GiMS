var manageBrandTable;

$(document).ready(function() {
	
	manageBrandTable = $("#manageBrandTable").DataTable({
		'ajax': 'php_action/fetchComplaints.php',
		'order': []
	});

});

$(document).ready(function() {

	$("#newRequestForm").unbind('submit').bind('submit', function() {
		var form = $(this);
		$('.text-danger').remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');		
		
		var equipmentName = $("#equipmentName").val();
		var purchaseLinks = $("#purchaseLinks").val();
		var reason = $("#reason").val();
		
		if(equipmentName == "" || reason == "") {
			if(equipmentName == "") {
				$("#equipmentName").closest('.form-group').addClass('has-error');
				$("#equipmentName").after('<p class="text-danger">Title is required</p>');
			} else {
				$("#form-group").removeClass('has-error');
				$("#text-danger").remove();
			}
			
			if(reason == "") {
				$("#reason").closest('.form-group').addClass('has-error');
				$("#reason").after('<p class="text-danger">Reason is required</p>');
			} else {
				$("#form-group").removeClass('has-error');
				$("#text-danger").remove();
			}
			
		} else {
			$("#form-group").removeClass('has-error');
			$("#text-danger").remove();


			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					console.log(response);
					if(response.success == true) {

						$("#newRequestForm")[0].reset();
						$('.text-danger').remove();
						$('.form-group').removeClass('has-error').removeClass('has-success');						

						$('.changePasswordMessages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');


	          			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						});    
					} else {

						$("#newRequestForm")[0].reset();
						$('.text-danger').remove();
						$('.form-group').removeClass('has-error').removeClass('has-success');						

						$('.changePasswordMessages').html('<div class="alert alert-warning">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+ response.messages +
				          '</div>');

	         		 	$(".alert-warning").delay(500).show(10, function() {
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

});


function acceptBrands(request = null) {
	if(request) {
		$('#acceptBrandBtn').unbind('click').bind('click', function() {

			$('#acceptBrandBtn').button('loading');

			$.ajax({
				url: 'php_action/acceptComplaint.php',
				type: 'post',
				data: {request : request},
				dataType: 'json',
				success:function(response) {

					console.log(response);

					$('#acceptBrandBtn').button('reset');

					if(response.success == true) {

						manageBrandTable.ajax.reload(null, false);

						$('#acceptMemberModel').modal('hide');

						$('.accept-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          	'</div>');

						$('.alert-success').delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).accept();
							});
						});
					} else {

						$('#acceptMemberModel').modal('hide');

						$('.accept-messages').html('<div class="alert alert-warning">'+
							'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
							'<strong><i class="glyphicon glyphicon-warning-sign"></i></strong> '+ response.messages +
							'</div>');

						$('.alert-warning').delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).accept();
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

function resubmitBrands(brandId = null) {
	if(brandId) {

		$('#resubmitBrandBtn').unbind('click').bind('click', function() {

			$('#resubmitBrandBtn').button('loading');

			$.ajax({
				url: 'php_action/resubmitComplaint.php',
				type: 'post',
				data: {request : brandId},
				dataType: 'json',
				success:function(response) {

					console.log(response);

					$('#resubmitBrandBtn').button('reset');

					if(response.success == true) {

						manageBrandTable.ajax.reload(null, false);

						$('#resubmitMemberModel').modal('hide');

						$('.resubmit-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          	'</div>');

						$('.alert-success').delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).resubmit();
							});
						});
					} else {

						$('#resubmitMemberModel').modal('hide');

						$('.resubmit-messages').html('<div class="alert alert-warning">'+
							'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
							'<strong><i class="glyphicon glyphicon-warning-sign"></i></strong> '+ response.messages +
							'</div>');

						$('.alert-warning').delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).resubmit();
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

function deleteBrands(brandId = null) {
	if(brandId) {

		$('#deleteBrandBtn').unbind('click').bind('click', function() {

			$('#deleteBrandBtn').button('loading');

			$.ajax({
				url: 'php_action/deleteComplaint.php',
				type: 'post',
				data: {request : brandId},
				dataType: 'json',
				success:function(response) {

					console.log(response);

					$('#deleteBrandBtn').button('reset');

					if(response.success == true) {

						manageBrandTable.ajax.reload(null, false);

						$('#deleteMemberModel').modal('hide');

						$('.delete-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          	'</div>');

						$('.alert-success').delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).delete();
							});
						});
					} else {

						$('#deleteMemberModel').modal('hide');

						$('.delete-messages').html('<div class="alert alert-warning">'+
							'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
							'<strong><i class="glyphicon glyphicon-warning-sign"></i></strong> '+ response.messages +
							'</div>');

						$('.alert-warning').delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).delete();
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
