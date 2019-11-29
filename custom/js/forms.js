var manageBrandTable;

$(document).ready(function() {
	
	manageBrandTable = $("#manageBrandTable").DataTable({
		'ajax': 'php_action/fetchForm.php',
		'order': []
	});

});

function acceptBrands(brandId = null) {
	if(brandId) {
		$('#acceptBrandBtn').unbind('click').bind('click', function() {

			$('#acceptBrandBtn').button('loading');

			$.ajax({
				url: 'php_action/acceptForm.php',
				type: 'post',
				data: {brandId : brandId},
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

function removeBrands(brandId = null) {
	if(brandId) {

		$('#removeBrandBtn').unbind('click').bind('click', function() {

			$('#removeBrandBtn').button('loading');

			$.ajax({
				url: 'php_action/rejectForm.php',
				type: 'post',
				data: {brandId : brandId},
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
				url: 'php_action/resubmitForm.php',
				type: 'post',
				data: {brandId : brandId},
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
				url: 'php_action/deleteForm.php',
				type: 'post',
				data: {brandId : brandId},
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

function forwardBrands(brandId = null) {
	if(brandId) {

		$('#forwardBrandForm').unbind('submit').bind('submit', function() {

			$('.text-danger').remove();
			$('.form-group').removeClass('has-error').removeClass('has-success');			

			var assignee = $('#forwardRoll').val();

			if(assignee == "") {
				$('#forwardRoll').after('<p class="text-danger">Field is required</p>');
				$('#forwardRoll').closest('#form-group').addClass('has-error');
			} else {
				$('#forwardRoll').find('#text-danger').remove();
				$('#forwardRoll').closest('#form-group').addClass('has-success');
			}

			if(assignee){

				$('#forwardBrandBtn').button('loading');

				$.ajax({
					url: 'php_action/forwardForm.php',
					type: 'post',
					data: {brandId : brandId, assignee : assignee},
					dataType: 'json',
					success:function(response) {

						console.log(response);

						$('#forwardBrandBtn').button('reset');

						if(response.success == true) {

							manageBrandTable.ajax.reload(null, false);

							$('#forwardBrandForm')[0].reset();
							$('.text-danger').remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							$('#forwardBrandModel').modal('hide');

							$('.forward-messages').html('<div class="alert alert-success">'+
								'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
								'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
								'</div>');

							$('.alert-success').delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							});
						} else {

							$('#forwardBrandForm')[0].reset();
							$('.text-danger').remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							$('#forwardBrandModel').modal('hide');

							$('.forward-messages').html('<div class="alert alert-warning">'+
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
		});

	} else {
		alert('error!! Refresh the page again');
	}
}