var manageUserTable;

$(document).ready(function() {

	manageUserTable = $('#manageUserTable').DataTable({
		'ajax': 'php_action/fetchHostelAdmin.php',
		'order': []
	});
 
	$('#submitUserForm').unbind('submit').bind('submit', function() {

		$('.text-danger').remove();
		$('.form-group').removeClass('has-error').removeClass('has-success'); 

		var uroll = $('#uroll').val();
		var upass = $('#upass').val();
		var uhostel = $('#uhostel').val();

		if(!uroll) {
			$('#uroll').after('<p class="text-danger">Roll field is required</p>');
			$('#uroll').closest('#form-group').addClass('has-error');
		}	else {
			$('#uroll').find('#text-danger').remove();
			$('#uroll').closest('#form-group').addClass('has-success');
		}

		if(!upass) {
			$('#upass').after('<p class="text-danger">Password field is required</p>');
			$('#upass').closest('#form-group').addClass('has-error');
		}	else {
			$('#upass').find('#text-danger').remove();
			$('#upass').closest('#form-group').addClass('has-success');	  	
		}

		if(!uhostel) {
			$('#uhostel').after('<p class="text-danger">Hostel field is required</p>');
			$('#uhostel').closest('#form-group').addClass('has-error');
		}	else {
			$('#uhostel').find('#text-danger').remove();
			$('#uhostel').closest('#form-group').addClass('has-success');
		}

		if(uroll && upass && uhostel) {

			$('#createUserBtn').button('loading');

			var form = $(this);

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {

					console.log(response);

					if(response.success == true) {

						manageUserTable.ajax.reload(null, true);

						$('#createUserBtn').button('reset');
						$('#submitUserForm')[0].reset();
						$('.text-danger').remove();
						$('.form-group').removeClass('has-error').removeClass('has-success');							
						$('html, body, div.modal, div.modal-content, div.modal-body').animate({scrollTop: '0'}, 100);
																
						$('#add-user-messages').html('<div class="alert alert-success">'+
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

						$('#createUserBtn').button('reset');
						$('#submitUserForm')[0].reset();
						$('.text-danger').remove();
						$('.form-group').removeClass('has-error').removeClass('has-success');							
						$('html, body, div.modal, div.modal-content, div.modal-body').animate({scrollTop: '0'}, 100);
																
						$('#add-user-messages').html('<div class="alert alert-warning">'+
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

});

function editUser(userid = null) {
	if(userid) {
				
		$('#editUserForm').unbind('submit').bind('submit', function() {

			$('.text-danger').remove();
			$('.form-group').removeClass('has-error').removeClass('has-success');

			var username = $('#edituserName').val();
			var userpassword = $('#editPassword').val();
			var useremail = $('#editEmail').val();

			if(username || userpassword || useremail) {
				
				$('#editUserBtn').button('loading');

				var form = $(this);

				$.ajax({
					url : 'php_action/editHostelAdmin.php',
					type: 'post',
					data: {username: username, roll: userid, userpassword: userpassword, useremail: useremail},
					dataType: 'json',
					success:function(response) {

						console.log(response);
						if(response.success == true) {

							manageUserTable.ajax.reload(null, true);

							$('#editUserBtn').button('reset');	
							$('#editUserForm')[0].reset();
							$('.text-danger').remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							$('#editUserModal').modal('hide');																					

							$('html, body, div.modal, div.modal-content, div.modal-body').animate({scrollTop: '0'}, 100);
																	
							$('#edit-user-messages').html('<div class="alert alert-success">'+
					            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
					            '<strong><i class="glyphicon glyphicon-warning-sign"></i></strong> '+ response.messages +
					          '</div>');

							
		          			$('.alert-success').delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); 
						}
						else{

							$('#editUserBtn').button('reset');	
							$('#editUserForm')[0].reset();
							$('.text-danger').remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							$('#editUserModal').modal('hide');																					

							$('html, body, div.modal, div.modal-content, div.modal-body').animate({scrollTop: '0'}, 100);
																	
							$('#edit-user-messages').html('<div class="alert alert-warning">'+
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
	}
}


function removeUser(userid = null) {
	if(userid) {
		
		$('#removeProductBtn').unbind('click').bind('click', function() {
			
			$('#removeProductBtn').button('loading');

			$.ajax({
				url: 'php_action/removeHostelAdmin.php',
				type: 'post',
				data: {userid: userid},
				dataType: 'json',
				success:function(response) {

					console.log(response);
					
					$('#removeProductBtn').button('reset');

					if(response.success == true) {
						
						manageUserTable.ajax.reload(null, false);

						$('#removeUserModal').modal('hide');
						
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

						$('#removeUserModal').modal('hide');

						$('.removeUserMessages').html('<div class="alert alert-warning">'+
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
			return false;
		}); 
	} 
} 