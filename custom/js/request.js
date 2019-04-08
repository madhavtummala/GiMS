$(document).ready(function() {

	$("#getOrderReportForm").unbind('submit').bind('submit', function() {
		
		var equipmentName = $("#equipmentName").val();
		var estimatedCost = $("#estimatedCost").val();
		var purchaseLinks = $("#purchaseLinks").val();
		var reason = $("#reason").val();
		
		if(equipmentName == "" || estimatedCost == "" || reason == "") {
			if(equipmentName == "") {
				$("#equipmentName").closest('.form-group').addClass('has-error');
				$("#equipmentName").after('<p class="text-danger">Equipment Name is required</p>');
			} else {
				$(".form-group").removeClass('has-error');
				$(".text-danger").remove();
			}

			if(estimatedCost == "") {
				$("#estimatedCost").closest('.form-group').addClass('has-error');
				$("#estimatedCost").after('<p class="text-danger">The Estimated Cost is required</p>');
			} else {
				$(".form-group").removeClass('has-error');
				$(".text-danger").remove();
			}
			
			if(reason == "") {
				$("#reason").closest('.form-group').addClass('has-error');
				$("#reason").after('<p class="text-danger">Reason Name is required</p>');
			} else {
				$(".form-group").removeClass('has-error');
				$(".text-danger").remove();
			}
			
		} else {
			$(".form-group").removeClass('has-error');
			$(".text-danger").remove();

			var form = $(this);

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'text',
				success:function(response) {
					var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
	        mywindow.document.write('<html><head><title>Order Report Slip</title>');        
	        mywindow.document.write('</head><body>');
	        mywindow.document.write(response);
	        mywindow.document.write('</body></html>');

	        mywindow.document.close(); // necessary for IE >= 10
	        mywindow.focus(); // necessary for IE >= 10

	        mywindow.print();
	        mywindow.close();
				} // /success
			});	// /ajax

		} // /else

		return false;
	});

});
