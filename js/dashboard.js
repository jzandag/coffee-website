/**
 * if you're reading this, good luck!
 */


$(function(){
    $(".dropdown").hover(
	function() {
	    $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
	    $(this).toggleClass('open');
	    $('b', this).toggleClass("caret caret-up");
	},
	function() {
	    $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
	    $(this).toggleClass('open');
	    $('b', this).toggleClass("caret caret-up");
    });
});


$(document).ready(function(){
    $('#brewDate').datetimepicker({
	autoclose: true,
	todayBtn: true,
	showMeridian: true,
	pickerReferer: 'input'
    });
    	
    $('#submit_form').bootstrapValidator({
	framework: 'bootstrap',
	message: 'This value is not valid',
	icon: {
	    valid: 'glyphicon glyphicon-ok',	
	    invalid: 'glyphicon glyphicon-remove',
	    validating: 'glyphicon glyphicon-refresh'
	},
	fields: {
	    brewDate: {
		validators: {
		    notEmpty: {
			message: 'This field cannot be empty!'
		    }/*,
		    date:{
			max: '2099-12-30 22:55:00',
			min: new Date(),
			message: 'Invalid date'
		    }*/
		}
	    }
	}
    });
    $('#brewDate').on('keypressed',function(){
	
	})

    //AJAX Request
    function load_data_queue(view = ''){
	$.ajax({
		    url:"../includes/fetchQueue.inc.php",
		    method:"POST",
		    data:{view:view},
		    dataType:"json",
		    success:function(data){
				$('#tbody-brews').html(data.queue_list);
				if(data.queue_count > 0){
					$('.count').html(data.queue_count);
			}
	    }	
	}) 
    }
    
    function load_latest_sched(text = ''){
	$.ajax({
	    url: "../includes/executebrew.inc.php",
	    method: "POST",
	    data: {text:text},
	    dataType: "json",
	    success: function(data){
			$('#test').html(data.alert);
	    }
		
	})
		
    }
    
    load_data_queue();
    load_latest_sched();
    setInterval(function(){
	load_data_queue();
	load_latest_sched();
    },5000);
});
