/**
 * if you're reading this, good luck!
 */

 $(document).ready(function(){

    /*jQuery.ajaxSetup({
        async: false;
    });
*/
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
        		    }
        	   }
            }
        }
    });

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
                $('#test').html('');
            }
    	});

        $.ajax({
            url: "../includes/executebrew.inc.php",
            method: "POST",
            data: {disable:''},
            dataType: "json",
            success: function(data){
                if(data.result){
                    $('.btn-brew').attr("disabled",true);
                    $('.btn-brew').attr("title","There is a queue");
                }else{
                    $('.btn-brew').attr("disabled",false);
                    $('.btn-brew').attr("title","");
                }
            }
        });
    }

    $('label').click(function(event) {
	  	// not asynchronous code such as Ajax because it does not wait for response and move to next line
	  	$(this).parent().find('input[type="radio"]').removeAttr('checked');
		//add checked attribute to selected label
		$(this).find('input[type="radio"]').attr('checked','checked');
		console.log($('input[name="coffeeLevel"]:checked').val());
	})

    load_data_queue();
    load_latest_sched();
    setInterval(function(){
    	//update_list();
    	load_data_queue();
    	load_latest_sched();
    },8000);

    $('#execute_form').submit(function(event){
        event.preventDefault();
        $('#brewnow').modal('toggle');
        $.ajax({
            url: "../includes/executebrew.inc.php",
            method: "POST",
            data: $('#execute_form').serialize(),
            success: function(data){

            }
        });

    });

    $('#submit_form').submit(function(event){
        event.preventDefault();
        $('#schedbrew').modal('toggle');
        $.ajax({
            url: "../includes/saveBrew.inc.php",
            method: "POST",
            data: $('#submit_form').serialize(),
            success: function(data){

            }
        });
        
    });

    //DASHBOARD ANALYTICS JS
    /*$('#anlyt1').on('click',function(){
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
    //month
    $.ajax({
        url: "../includes/analytics.inc.php",
        method: "POST",
        data: {month: ''},
        dataType: "json",
        success: function(){
            console.log('update previous unbrewed brews success');
        }
    })

    // LINE CHART
    var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: [
        {y: '2011 Q1', item1: 2666},
        {y: '2011 Q2', item1: 2778},
        {y: '2011 Q3', item1: 4912},
        {y: '2011 Q4', item1: 3767},
        {y: '2012 Q1', item1: 6810},
        {y: '2012 Q2', item1: 5670},
        {y: '2012 Q3', item1: 4820},
        {y: '2012 Q4', item1: 15073},
        {y: '2013 Q1', item1: 10687},
        {y: '2013 Q2', item1: 8432}
      ],
      xkey: 'y',
      ykeys: ['item1'],
      labels: ['Item 1'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto'
    });

    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: [
        {y: '2006', a: 100, b: 90},
        {y: '2007', a: 75, b: 65},
        {y: '2008', a: 50, b: 40},
        {y: '2009', a: 75, b: 65},
        {y: '2010', a: 50, b: 40},
        {y: '2011', a: 75, b: 65},
        {y: '2012', a: 100, b: 90}
      ],
      barColors: ['#00a65a', '#f56954'],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['CPU', 'DISK'],
      hideHover: 'auto'
    });

    //DONUT CHART
    var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a"],
      data: [
        {label: "Download Sales", value: 12},
        {label: "In-Store Sales", value: 30},
        {label: "Mail-Order Sales", value: 20}
      ],
      hideHover: 'auto'
    });*/

});
