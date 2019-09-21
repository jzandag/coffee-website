/**
 * PREDEFINED JAVASCRIPT FUNCTIONS
 */

 $(document).ready(function(){

 	 $('.btn-brew').tooltip();
 });

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

	notifTemplate.find('.alert .desc-message').text(description);
	notifTemplate.find('.alert .info-message').text(info);
	
	$('#notif-alert .alert-group').append(notifTemplate.html());
	$('#notif-alert .alert-group div.alert').fadeIn().delay(1800).fadeOut(function(){
		$(this).remove();
    });
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


