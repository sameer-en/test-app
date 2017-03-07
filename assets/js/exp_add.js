//exp_list.js

$(document).ready(function() {
  $("#form-exp").validate({
  			errorClass:'error',
  			rules:{
  				userid:{
  					required:true
  				},
  				catid:{
  					required:true
  				},
  				amount:{
  					required:true,
  					number:true,
  				},
  				expdate:{
  					required:true
  				},
  				description:{
  					required:true
  				} /*,
  				comment:{
  					required:true
  				}*/
  			},
			messages: {
				userid: {
					required: 'Select user account'
				}
			}
		});



$( "#expdate" ).datepicker({
	dateFormat :'yy-mm-dd',
	changeMonth: true,
	changeYear: true
});


});
