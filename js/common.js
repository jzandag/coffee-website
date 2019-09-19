/**
 * PREDEFINED JAVASCRIPT FUNCTIONS
 */

function update_list_main(text = ''){
    $.ajax({
        url: "../coffee-website/includes/updateQueueList.inc.php",
        method: "POST",
        data: {update: ''},
        dataType: "json",
        success: function(data){
          console.log('update previous unbrewed brews success');
        }
    })
    
}

function convertToNumber(value) {
	return Number(removeComma(value));
}

function convert2Decimal(value) {
	return Number(value).toFixed(2);
}

function escapeKeyClear() {
	$(window).bind('keydown', function(e) {
		if(e.keyCode === 27) { 
			clearModalSearch();
		}
	});
}

function checkValue(value, element) {
	if(value) {
		$(element).css("border-color","");
		return false;
	} else {
		$(element).css({"border-color":"red"});
		return true;
	}
}

function validateEmail(value) {
	if(value) {
		return !emailReg.test(value);
	}
}

function showErrorMessage(value, isSuccess, element, message) {
	if(isSuccess) {
		element.parents('div.form-group').removeClass('has-success');
		element.parents('div.form-group').addClass('has-feedback has-error');
		element.siblings('i').addClass('glyphicon glyphicon-remove');
		element.siblings('i').css('display', 'block');
		
		if(value) {
			element.parents('div.form-group').find('.error-message').remove();
			element.parents('div.form-group').append('<small class="help-block error-message" data-bv-validator="isExisting" data-bv-result="INVALID" style="display: block;">'+ message +'</small>'
			);
		}
		
		if(!value) {
			// value is empty
			element.parents('div.form-group').find('.error-message').remove();
			element.parents('div.form-group').append('<small class="help-block error-message" data-bv-validator="isExisting" data-bv-result="INVALID" style="display: block;">'+ message +'</small>'
			);
		}
		
		$('.btn-primary').attr('disabled', 'disabled');
	} else {
		element.parents('div.form-group').removeClass('has-error');
		element.siblings('i').removeClass('glyphicon-remove');
		element.parents('div.form-group').find('small.error-message').css('display', 'none');
		
		element.parents('div.form-group').addClass('has-feedback has-success');
		element.siblings('i').addClass('glyphicon glyphicon-ok');
		element.siblings('i').css('display', 'block');
		//TODO: check if form still has-error class
		$('.btn-primary').attr('disabled', false);
	}
}

function clearMessage(element) {
	element.parents('div.form-group').removeClass('has-error');
	element.parents('div.form-group').removeClass('has-success');
	element.parents('div.form-group').find('i').removeClass('glyphicon-remove');
/*//	element.parents('div.form-group').find('i').removeClass('glyphicon glyphicon-ok');
*/	element.parents('div.form-group').find('i').removeClass('glyphicon-ok');
	element.parents('div.form-group').find('small.help-block').css('display', 'none');
	$('.btn-primary').attr('disabled', false);
}

function showModal($element, title, message) {
	$element.find('.title').text(title);
	$element.find('.message').text(message);
	$element.modal('show');	
}

function modalAlertMessage(description, info) {
	var notifTemplate = $('#notif-template');

	notifTemplate.find('.alert .notif-message .desc-message').text(description);
	notifTemplate.find('.alert .notif-message .info-message').text(info);
	
	$('#notif-alert .alert-group').append(notifTemplate.html());
	$('#notif-alert .alert-group div.alert').fadeIn().delay(1800).fadeOut(function(){
		$(this).remove();
    });
}

function hideButton(){
	ModeleOnSession();
	var item = $('#writeItem').val();
	var moduleId = $('#moduleId').val();
	var array = item.split(',');
    
	if(item != "") {
	    if(checkValue(moduleId,array) == 'Not exist') {
	    	/*$('.btn-primary[type="submit"]').addClass("hide");
	    	$("a:contains(Create)").addClass("hide");
	    	$("a:contains(Compose)").addClass("hide");*/
	    	
	    	$('.btn-primary[type="submit"]').remove();
	    	$("a:contains(Create)").remove();
	    	$("a:contains(Compose)").remove();
	    }
	}
}

function checkValue(value,arr){
  var status = 'Not exist';
  
  for(var i=0; i<arr.length; i++){
    var name = arr[i];
    if(name == value){
      status = 'Exist';
      break;
    }
  }
  

  return status;
}

function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    var items = location.search.substr(1).split("&");
    for (var index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    }
    return result;
}

function showNotification(colorName, text, placementFrom, placementAlign, animateEnter, animateExit) {
    if (colorName === null || colorName === '') { colorName = 'bg-black'; }
    if (text === null || text === '') { text = 'Turning standard Bootstrap alerts'; }
    if (animateEnter === null || animateEnter === '') { animateEnter = 'animated fadeInDown'; }
    if (animateExit === null || animateExit === '') { animateExit = 'animated fadeOutUp'; }
    var allowDismiss = true;

    $.notify({
        message: text
    },
        {
            type: colorName,
            allow_dismiss: allowDismiss,
            newest_on_top: true,
            timer: 1000,
            placement: {
                from: placementFrom,
                align: placementAlign
            },
            animate: {
                enter: animateEnter,
                exit: animateExit
            },
            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">�</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
        });


function ModeleOnSession() {
	var moduleId = $('#moduleId').val();
	$.ajax({
		type : "POST",
		url : baseUrl+"/admin/user/module",
		data : {
			moduleId:moduleId
		},
		success : function(response) {
			
		},
		error : function(e) {
		//show error message
		},
		complete: function() {
		   	//close modal
		}
	});
}