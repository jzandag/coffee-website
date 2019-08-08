<?php

if(isset($_POST['text'])){
	require "dbh.inc.php";

	$getLatestquery = "SELECT * FROM coffee_request WHERE `queue`= 1 ORDER BY `brew_date`";
	$result = mysqli_query($conn, $getLatestquery);
	//$output = '<script>alert(\'hello\');console.log(\'igot here\');</script>';
	
	if(mysqli_num_rows($result) == 0){
		$get_current_queue_query = "SELECT * FROM `coffee_request` WHERE status=0 AND brew_date <= now() ORDER BY brew_date LIMIT 1";
		$result_current_queue = mysqli_query($conn, $get_current_queue_query);
		//$output = '<script>alert(\'bp1\');console.log(\'igot here\');</script>';
		
		while($row = mysqli_fetch_array($result_current_queue)){
			$update_query = "UPDATE coffee_request SET status=1, queue=1 WHERE coffeereq_id = ?";
			$stmt = mysqli_stmt_init($conn);
			//$output = '<script>alert(\'bp2\');console.log(\'igot here\');</script>';
			if(mysqli_stmt_prepare($stmt,$update_query)){
				mysqli_stmt_bind_param($stmt,"s",$row['coffeereq_id']);
				mysqli_stmt_execute($stmt);
			}
			
			shell_exec('sudo python /var/www/html/script/coffee.py ' .$row['coffee_level'].' ' .$row['sugar_level'].' ' .$row['creamer_level']);
			$update_query = "UPDATE coffee_request SET queue=0 WHERE coffeereq_id = ?";
			$stmt = mysqli_stmt_init($conn);
			if(mysqli_stmt_prepare($stmt,$update_query)){
				mysqli_stmt_bind_param($stmt,"s",$row['coffeereq_id']);
				mysqli_stmt_execute($stmt);
			}
			//$output = '<script>alert(\'bp3\');console.log(\'igot here\');</script>';
			$output = "Coffee brew is in process!";
			break;
		
		}
		
	}
	else{
	
	}
	
	$data = array(
		'alert' 	=> $output
	);
	echo json_encode($data);
	
}
else if(isset($_POST['executebrew-submit'])){
	require "dbh.inc.php";
	
	$coffeeLevel = $_POST['coffeeLevel'];
	$sugarLevel = $_POST['sugarLevel'];
	$creamerLevel = $_POST['creamerLevel'];
	
	
	$tz = 'Asia/Manila';
	$timestamp = time();
	$dt = new DateTime("now", new DateTimeZone('Asia/Manila')); //first argument "must" be a string
	$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
	echo $dt->format('Y-m-d H:i:s');
	
	$brewDate = $dt->format('Y-m-d H:i:s');
	$applicationDate = $dt->format('Y-m-d H:i:s');
	
	$sql = "INSERT INTO coffee_request 
			SET app_date=?,
			brew_date=?,
			coffee_level=?,
			creamer_level=?,
			sugar_level=?,
			status = 0,
			queue = 0,
			userID = ?;";
			
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("Location: ../dashboard.php?error=brewFail");
		exit();
	}else{
		mysqli_stmt_bind_param($stmt,"ssssss", $applicationDate, $brewDate,$coffeeLevel, $creamerLevel,$sugarLevel,$_POST['userid']);
		mysqli_stmt_execute($stmt);
		//shell_exec('sudo python /var/www/html/script/coffee.py ' .$coffeeLevel.' ' .$sugarLevel.' ' .$creamerLevel);	
		
		header("Location: ../smart-coffee/View/dashboard.php?brew=success");
		exit();
	
	
	
	
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}else{
	
}
