var manageBrandTable;

$(document).ready(function() {
	
	manageBrandTable = $("#manageBrandTable").DataTable({
		'ajax': 'php_action/fetchBrand.php',
		'order': []
	});

	$('#submitBrandForm').unbind('submit').bind('submit', function()
	{
		$('.text-danger').remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');

		var name = $('#addName').val();
		var invoiceno = $('#addInvoiceno').val();
		var cost =  $('#addCost').val();

		if(name == "") {
			$('#addName').after('<p class="text-danger">Name field is required</p>');
			$('#addName').closest('#form-group').addClass('has-error');
		} else {
			$('#addName').find('#text-danger').remove();
			$('#addName').closest('#form-group').addClass('has-success');
		}
		if(cost == "") {
			$('#addCost').after('<p class="text-danger">Cost field is required</p>');
			$('#addCost').closest('#form-group').addClass('has-error');
		} else {
			$('#addCost').find('#text-danger').remove();
			$('#addCost').closest('#form-group').addClass('has-success');
		}

		if(invoiceno == "") {
			$("#addInvoiceno").after('<p class="text-danger">Invoice No field is required</p>');
			$('#addInvoiceno').closest('#form-group').addClass('has-error');
		} else {
			$("#addInvoiceno").find('#text-danger').remove();
			$("#addInvoiceno").closest('#form-group').addClass('has-success');
		}

		if(name && invoiceno && cost) {
			var form = $(this);

			$('#createBrandBtn').button('loading');

			$.ajax({
				url : 'php_action/createBrand.php',
				type: 'post',
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {

					console.log(response);

					$('#createBrandBtn').button('reset');

					if(response.success == true) {

						manageBrandTable.ajax.reload(null, false);

						$('#submitBrandForm')[0].reset();
						$('.text-danger').remove();
						$('.form-group').removeClass('has-error').removeClass('has-success');

		  	  			$('#add-brand-messages').html('<div class="alert alert-success">'+
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

						$('#submitBrandForm')[0].reset();
						$('.text-danger').remove();
						$('.form-group').removeClass('has-error').removeClass('has-success');

		  	  			$('#add-brand-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

		  	  			$('.alert-success').delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						});						
					}

				}
			});

		}

		return false;
	}

	);

});

function returnBrands(){

	$('#returnBrandForm').unbind('submit').bind('submit', function()
		{
			$('.text-danger').remove();
			$('.form-group').removeClass('has-error').removeClass('has-success');

			var roll = $("#returnNo").val();

			if(roll == "") {
				$('#returnNo').after('<p class="text-danger">EID field is required</p>');
				$('#returnNo').closest('#form-group').addClass('has-error');
			} else {
				$('#returnNo').find('#text-danger').remove();
				$('#returnNo').closest('#form-group').addClass('has-success');
			}

			if(roll) {
				var form = $(this);
				
				$('#returnBrandBtn').button('loading');

				$.ajax({
					url : 'php_action/returnBrand.php',
					type: 'post',
					data: form.serialize(),
					dataType: 'json',
					success:function(response) {

						console.log(response);

						$('#returnBrandBtn').button('reset');

						if(response.success == true) {

							manageBrandTable.ajax.reload(null, false);

							$('#returnBrandForm')[0].reset();
							$('.text-danger').remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							$('#return-brand-messages').html('<div class="alert alert-success">'+
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

							$('#returnBrandForm')[0].reset();
							$('.text-danger').remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							$('#return-brand-messages').html('<div class="alert alert-success">'+
								'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
								'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
								'</div>');

							$('.alert-success').delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							});
						}

					}
				});
			}

			return false;
		}

	);

}

function issueBrands(brandId = null) {
	if(brandId) {

		$('#issueBrandForm').unbind('submit').bind('submit', function() {

			$('.text-danger').remove();
			$('.form-group').removeClass('has-error').removeClass('has-success');


			var roll = $('#issueRoll').val();

			if(roll == "") {
				$('#issueRoll').after('<p class="text-danger">Roll field is required</p>');
				$('#issueRoll').closest('#form-group').addClass('has-error');
			} else {
				$('#issueRoll').find('#text-danger').remove();
				$('#issueRoll').closest('#form-group').addClass('has-success');
			}

			if(roll) {
				var form = $(this);

				$('#issueBrandBtn').button('loading');

				$.ajax({
					url: 'php_action/issueBrand.php',
					type: 'post',
					data: {brandId: brandId, issueRoll: roll},
					dataType: 'json',
					success:function(response) {

						console.log(response);

						$('#issueBrandBtn').button('reset');

						if(response.success == true) {

							manageBrandTable.ajax.reload(null, false);

							$('#issueBrandForm')[0].reset();
							$('.text-danger').remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							$('#issueBrandModel').modal('hide');

							$('.issue-messages').html('<div class="alert alert-success">'+
								'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
								'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
								'</div>');

							$('.alert-success').delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							});
						} else {

							$('#issueBrandForm')[0].reset();
							$('.text-danger').remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							$('#issueBrandModel').modal('hide');

							$('.issue-messages').html('<div class="alert alert-success">'+
								'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
								'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
								'</div>');

							$('.alert-success').delay(500).show(10, function() {
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

function editBrands(brandId = null) {
	if(brandId) {

		$('#editBrandForm').unbind('submit').bind('submit', function() {

			$('.text-danger').remove();
			$('.form-group').removeClass('has-error').removeClass('has-success');

			var brandName = $('#editBrandName').val();
			var brandStatus = $('#editBrandStatus').val();

			if(brandStatus == "") {
				$('#editBrandStatus').after('<p class="text-danger"> Status field is required</p>');
				$('#editBrandStatus').closest('#form-group').addClass('has-error');
			} else {
				$('#editBrandStatus').find('#text-danger').remove();
				$('#editBrandStatus').closest('#form-group').addClass('has-success');
			}

			if(brandStatus) {
				var form = $(this);

				$('#editBrandBtn').button('loading');

				$.ajax({
					url: 'php_action/editBrand.php',
					type: 'post',
					data: {brandId: brandId, editBrandName: brandName, editBrandStatus: brandStatus},
					dataType: 'json',
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

					}
				});

			}

			return false;
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
				url: 'php_action/removeBrand.php',
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

						$('.alert-success').delay(500).show(10, function() {
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