var manageBrandTable;

$(document).ready(function() {
	// top bar active
	$('#navBrand').addClass('active');
	
	// manage brand table
	manageBrandTable = $("#manageBrandTable").DataTable({
		'ajax': 'php_action/fetchBrand.php',
		'order': []
	});

	// submit brand form function
	$("#submitBrandForm").unbind('submit').bind('submit', function()
	{
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		$('.add-brand-result').addClass('div-hide');
		// modal footer
		$('.addBrandFooter').addClass('div-hide');

		var name = $("#addName").val();
		var invoiceno = $("#addInvoiceno").val();
		var cost =  $("#addCost").val();

		if(name == "") {
			$("#addName").after('<p class="text-danger">Name field is required</p>');
			$('#addName').closest('.form-group').addClass('has-error');
		} else {
			// remove error text field
			$("#addName").find('.text-danger').remove();
			// success out for form
			$("#addName").closest('.form-group').addClass('has-success');
		}
		if(cost == "") {
			$("#addCost").after('<p class="text-danger">Cost field is required</p>');
			$("#addCost").closest('.form-group').addClass('has-error');
		} else {
			$("#addCost").find('.text-danger').remove();
			$("#addCost").closest('.form-group').addClass('has-success');
		}

		if(invoiceno == "") {
			$("#addInvoiceno").after('<p class="text-danger">Invoice No field is required</p>');
			$('#addInvoiceno').closest('.form-group').addClass('has-error');
		} else {
			$("#addInvoiceno").find('.text-danger').remove();
			$("#addInvoiceno").closest('.form-group').addClass('has-success');
		}

		if(name && invoiceno && cost) {
			var form = $(this);
			// button loading
			$("#createBrandBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {

					console.log(response);

					$("#createBrandBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table
						manageBrandTable.ajax.reload(null, false);

						$("#submitBrandForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');

  	  			$('#add-brand-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					}  // if

				} // /success
			}); // /ajax
		} // if

		return false;
	}

	);

});

function returnBrands(){

	// return brand form function
	$("#returnBrandForm").unbind('submit').bind('submit', function()
		{
			// remove the error text
			$(".text-danger").remove();
			// remove the form error
			$('.form-group').removeClass('has-error').removeClass('has-success');

			$('.return-brand-result').addClass('div-hide');
			// modal footer
			$('.returnBrandFooter').addClass('div-hide');

			var roll = $("#returnNo").val();

			if(roll == "") {
				$("#returnNo").after('<p class="text-danger">Roll field is required</p>');
				$('#returnNo').closest('.form-group').addClass('has-error');
			} else {
				$("#returnNo").find('.text-danger').remove();
				$("#returnNo").closest('.form-group').addClass('has-success');
			}

			if(roll) {
				var form = $(this);
				// button loading
				$("#returnBrandBtn").button('loading');

				$.ajax({
					url : 'php_action/returnBrand.php',
					type: 'post',
					data: form.serialize(),
					dataType: 'json',
					success:function(response) {

						console.log(response);

						$("#returnBrandBtn").button('reset');

						if(response.success == true) {
							// reload the manage member table
							manageBrandTable.ajax.reload(null, false);

							$("#returnBrandForm")[0].reset();
							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');

							$('#return-brand-messages').html('<div class="alert alert-success">'+
								'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
								'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
								'</div>');

							$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
						}  // if

						else{
							// reload the manage member table
							manageBrandTable.ajax.reload(null, false);

							$("#returnBrandForm")[0].reset();
							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');

							$('#return-brand-messages').html('<div class="alert alert-warning">'+
								'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
								'<strong><i class="glyphicon glyphicon-warning-sign"></i></strong> '+ response.messages +
								'</div>');

							$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
						}

					} // /success
				}); // /ajax
			} // if

			return false;
		}

	);

}

function issueBrands(brandId = null) {
	if(brandId) {

		// update brand form
		$('#issueBrandForm').unbind('submit').bind('submit', function() {


			// remove hidden brand id text
			$('#brandId').remove();

			// remove the error
			$('.text-danger').remove();
			// remove the form-error
			$('.form-group').removeClass('has-error').removeClass('has-success');

			// modal result
			$('.issue-brand-result').addClass('div-hide');
			// modal footer
			$('.issueBrandFooter').addClass('div-hide');

			var roll = $('#issueRoll').val();

			if(roll == "") {
				$("#editBrandName").after('<p class="text-danger">Roll field is required</p>');
				$('#editBrandName').closest('.form-group').addClass('has-error');
			} else {
				$("#editBrandName").find('.text-danger').remove();
				$("#editBrandName").closest('.form-group').addClass('has-success');
			}

			if(roll) {
				var form = $(this);

				// submit btn
				$('#issueBrandBtn').button('loading');

				$.ajax({
					url: form.attr('action'),
					type: form.attr('method'),
					data: {brandId: brandId, issueRoll: roll},
					dataType: 'json',
					success:function(response) {

						console.log(response);

						if(response.success == true) {
							// reload the manage member table

							$('#issueBrandModel').modal('hide');
							manageBrandTable.ajax.reload(null, false);

							$("#editBrandForm")[0].reset();
							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');

							$('.issue-messages').html('<div class="alert alert-success">'+
								'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
								'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
								'</div>');

							$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
						} else {

							$('#issueBrandModel').modal('hide');
							manageBrandTable.ajax.reload(null, false);

							$("#editBrandForm")[0].reset();
							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');

							$('.issue-messages').html('<div class="alert alert-warning">'+
								'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
								'<strong><i class="glyphicon glyphicon-warning-sign"></i></strong> '+ response.messages +
								'</div>');

							$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
						}
					}// /success
				});	 // /ajax
			} // /if

			return false;
		}); // /update brand form

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit brands function

function editBrands(brandId = null) {
	if(brandId) {

				// update brand form
				$('#editBrandForm').unbind('submit').bind('submit', function() {


					// remove hidden brand id text
					$('#brandId').remove();

					// remove the error
					$('.text-danger').remove();
					// remove the form-error
					$('.form-group').removeClass('has-error').removeClass('has-success');

					// modal result
					$('.edit-brand-result').addClass('div-hide');
					// modal footer
					$('.editBrandFooter').addClass('div-hide');

					var brandName = $('#editBrandName').val();
					var brandStatus = $('#editBrandStatus').val();

					if(brandName == "") {
						$("#editBrandName").after('<p class="text-danger"> Name field is required</p>');
						$('#editBrandName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editBrandName").find('.text-danger').remove();
						// success out for form
						$("#editBrandName").closest('.form-group').addClass('has-success');
					}

					if(brandStatus == "") {
						$("#editBrandStatus").after('<p class="text-danger"> Status field is required</p>');

						$('#editBrandStatus').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editBrandStatus").find('.text-danger').remove();
						// success out for form
						$("#editBrandStatus").closest('.form-group').addClass('has-success');
					}

					if(brandName && brandStatus) {
						var form = $(this);

						// submit btn
						$('#editBrandBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: {brandId: brandId, editBrandName: brandName, editBrandStatus: brandStatus},
							dataType: 'json',
							success:function(response) {

								console.log(response);

								if(response.success == true) {
									// reload the manage member table

									$('#editBrandModel').modal('hide');
									manageBrandTable.ajax.reload(null, false);

									$("#editBrandForm")[0].reset();
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');

									$('.edit-messages').html('<div class="alert alert-success">'+
										'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
										'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
										'</div>');

									$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} else {
									$('#editBrandModel').modal('hide');
									manageBrandTable.ajax.reload(null, false);

									$("#editBrandForm")[0].reset();
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');

									$('.edit-messages').html('<div class="alert alert-warning">'+
										'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
										'<strong><i class="glyphicon glyphicon-warning-sign"></i></strong> '+ response.messages +
										'</div>');

									$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								}

							}// /success
						});	 // /ajax
					} // /if

					return false;
				}); // /update brand form

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit brands function

function removeBrands(brandId = null) {
	if(brandId) {
		// $('#removeBrandId').remove();

				// $('.removeBrandFooter').after('<input type="hidden" name="removeBrandId" id="removeBrandId" value="'+response.brand_id+'" /> ');

				// click on remove button to remove the brand
				$("#removeBrandBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeBrandBtn").button('loading');

					$.ajax({
						url: 'php_action/removeBrand.php',
						type: 'post',
						data: {brandId : brandId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeBrandBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal
								$('#removeMemberModel').modal('hide');

								// reload the brand table
								manageBrandTable.ajax.reload(null, false);

								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

								$(".alert-success").delay(100).show(5, function() {
									$(this).delay(1000).hide(5, function() {
										$(this).remove();
									});
								}); // /.alert
							} else {
								// hide the remove modal
								$('#removeMemberModel').modal('hide');

								// reload the brand table
								manageBrandTable.ajax.reload(null, false);

								$('.remove-messages').html('<div class="alert alert-warning">'+
									'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
									'<strong><i class="glyphicon glyphicon-warning-sign"></i></strong> '+ response.messages +
									'</div>');

								$(".alert-success").delay(500).show(10, function() {
									$(this).delay(3000).hide(10, function() {
										$(this).remove();
									});
								}); // /.alert
							} // /else
						} // /response messages
					}); // /ajax function to remove the brand

				}); // /click on remove button to remove the brand

			// } // /success
		// }); // /ajax

		$('.removeBrandFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
}