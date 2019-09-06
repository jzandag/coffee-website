<?php

//functions hehehehehehez

//Our YYYY-MM-DD date string.
$date = "2019-08-14 11:50:00";


 
//Get the day of the week using PHP's date function.
$dayOfWeek = date("l", strtotime($date));
 
echo $dayOfWeek . '<br/>';
//Print out the day that our date fell on.
echo $date . ' fell on a ' . convertToDayOfWeek($dayOfWeek);

function convertToDayOfWeek($d){
	switch($d){
		case 'Sunday':
			return 1;
		case 'Monday':
			return 2;
		case 'Tuesday':
			return 3;
		case 'Wednesday':
			return 4;
		case 'Thursday':
			return 5;
		case 'Friday':
			return 6;
		case 'Saturday':
			return 7;
	}
}
?>
<html>

	<script type="text/javascript" src="js/tester.js"></script>
<body>
	<hr width="100%" noshade="100" size="13">
	<h1>hi</h1>
</body>
</html>