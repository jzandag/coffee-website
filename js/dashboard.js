/**
 * if you're reading this, good luck!
 */

 $(document).ready(function(){

    $(".dropdown").hover(function() {
        $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
        $(this).toggleClass('open');
        $('b', this).toggleClass("caret caret-up");
    },function() {
        $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
        $(this).toggleClass('open');
        $('b', this).toggleClass("caret caret-up");
    });

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
        var result;
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
    		},
            error:function(dat){
                //alert(dat.queue_list);
                
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
    		},
            complete: function(data){
                $('#test').html(data.alert);
            }
    	})
    }

    //function for asynchronously updating previos unbrewed requests
    function update_list(text = ''){
        console.log('you got here');
    	$.ajax({
    		url: "../includes/updateQueueList.inc.php",
    		method: "POST",
    		data: {update: ''},
    		dataType: "json",
    		success: function(){
    			console.log('update previous unbrewed brews success');
    		}
    	})
    }
    
    $('label').click(function(event) {
	  	// not asynchronous code such as Ajax because it does not wait for response and move to next line
	  	$(this).parent().find('input[type="radio"]').removeAttr('checked');
		//add checked attribute to selected label
		$(this).find('input[type="radio"]').attr('checked','checked');
		console.log($('input[name="coffeeLevel"]:checked').val());
	})

	/*$('.btn-close').click(function (){
		$('label').removeClass('active');
		$('input[type="radio"]').removeAttr('checked');
	});*/

    load_data_queue();
    load_latest_sched();
    setInterval(function(){
    	//update_list();
    	load_data_queue();
    	load_latest_sched();
    },6000);
    /*window.location.replace("../includes/fetchQueue.inc.php");*/

    /*modalAlertMessage('Coffee Brew', 'Coffee is ready to serve');*/

    //DASHBOARD ANALYTICS JS
    $('#anlyt1').on('click',function(){
        $('.btn-primary').removeClass('active');
        $(this).addClass('active');
    });

    $('#anlyt2').on('click',function(){
        $('.btn-primary').removeClass('active');
        $(this).addClass('active');
    });

    $('#anlyt3').on('click',function(){
        $('.btn-primary').removeClass('active');
        $(this).addClass('active');
    });

});
