
$(document).ready(function(){
	
	//for the delete confirmation
	$('#confirm').on('show.bs.modal', function(e) {
		
	    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});

	

	$('#submit_form').bootstrapValidator({
		framework: 'bootstrap',
		message: 'This value is not valid',
		feedbackIcons: {
		    valid: 'glyphicon glyphicon-ok',	
		    invalid: 'glyphicon glyphicon-remove',
		    validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
		    username: {
			validators: {
			    notEmpty: {
				message: 'username is required!'
			    },
			    stringLength: {
				min: 6,
				max: 20,
				message: 'Username must be 6-20 characters long!'						
			    }/*,
			    callback:{
				callback: function(value, validator, $field){
				    
				    var checker = true;
				    
				    $.ajax({
					url: "../includes/validate.inc.php",
					method: "POST",
					data: {type: 'isUserExist', user: $field.val()},
					dataType: "json",
					success: function(data){
					    checker = data.checker;
					    alert('hello');
					}    
				    });
				    
				    if(checker == "true")
					alert(checker)
				    
				    
				    
				    
				    return true;
				}
			    }*/
			}
		    },
		    email: {
			validators:{
			    notEmpty:{
				message: 'Email should not be empty'
			    },
			    emailAddress:{
				message: 'This is not a valid email address'					
			    }
			}
		    },
		    password: {
			validators:{
			    notEmpty:{
				message: 'Password should not be empty'
			    },
			    stringLength:{
				min: 6,
				max: 20,
				message: 'Passsword should be 6-20 characters long!'					
			    }
			}
			    
		    }
		}
	    });
	
	

});
