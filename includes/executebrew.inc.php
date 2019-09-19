<?php
session_start();
if(isset($_POST['text'])){

	//THIS BLOCK OF CODE IS THE TRIGGER PART OF THE WHOLE SYSTEM
	require "dbh.inc.php";
	$test = shell_exec("python dict.py");
	if ((strcmp($test,"test")==1)||(strcmp($test,"test")==2))
	{
		$getLatestquery = "SELECT * FROM coffee_request WHERE `queue`= 1 ORDER BY `brew_date`";
		$result = mysqli_query($conn, $getLatestquery);
		//$output = '<script>alert(\'hello\');console.log(\'igot here\');</script>';
		
		$output = 'kk';
		if(mysqli_num_rows($result) == 0){
			$get_current_queue_query = "SELECT * FROM `coffee_request` INNER JOIN config ON config_fk = config.id WHERE status=0 or status=2 AND brew_date <= now() ORDER BY brew_date LIMIT 1";
			$result_current_queue = mysqli_query($conn, $get_current_queue_query);
			//$output = '<script>alert(\'bp1\');console.log(\'igot here\');</script>';
			
			while($row = mysqli_fetch_array($result_current_queue)){
				if($row['config_status'] == 0)
					exit();
				$update_query = "UPDATE coffee_request SET status=1, queue=1 WHERE coffeereq_id = ?";
				$stmt = mysqli_stmt_init($conn);
				
				if(mysqli_stmt_prepare($stmt,$update_query)){
					mysqli_stmt_bind_param($stmt,"s",$row['coffeereq_id']);
					mysqli_stmt_execute($stmt);
				}
				
				if(strcmp($test,"test")==1)
					{
					shell_exec('sudo python /var/www/html/script/coffee.py ' .$row['coffee_level'].' ' .$row['sugar_level'].' ' .$row['creamer_level']);
						if($_SESSION['id'] == $row['userID'])
							$output = "<script>modalAlertMessage('Coffee Brew', 'Coffee is ready to serve at slot #1');console.log('coffee brew!')</script>";
					}
				else
					{
					shell_exec('sudo python /var/www/html/script/coffee.py ' .$row['coffee_level'].' ' .$row['sugar_level'].' ' .$row['creamer_level']);
						if($_SESSION['id'] == $row['userID'])
							$output = "<script>modalAlertMessage('Coffee Brew', 'Coffee is ready to serve at slot #2');console.log('coffee brew!')</script>";
					}
				$update_query = "UPDATE coffee_request SET queue=0 WHERE coffeereq_id = ?";
				$stmt = mysqli_stmt_init($conn);
				if(mysqli_stmt_prepare($stmt,$update_query)){
					mysqli_stmt_bind_param($stmt,"s",$row['coffeereq_id']);
					mysqli_stmt_execute($stmt);
				}
				//$output = '<script>alert(\'bp3\');console.log(\'igot here\');</script>';
				

				break;
			
			}
			
		}
	}
	else
		{
			$output = "<script>modalAlertMessage('Coffee Brew', $test);console.log('coffee brew!')</script>";
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
	
	$applicationDate = $dt->format('Y-m-d H:i:s');
	$dt->modify('+5 seconds');
	
	$brewDate = $dt->format('Y-m-d H:i:s');
	
	$sql = "INSERT INTO coffee_request 
			SET app_date=?,
			brew_date=?,
			coffee_level=?,
			creamer_level=?,
			sugar_level=?,
			status = 0,
			queue = 0,
			userID = ?,
			config_fk = 1;";
			
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("Location: ../dashboard.php?error=brewFail");
		exit();
	}else{
		mysqli_stmt_bind_param($stmt,"ssssss", $applicationDate, $brewDate,$coffeeLevel, $creamerLevel,$sugarLevel,$_POST['userid']);
		mysqli_stmt_execute($stmt);
		//shell_exec('sudo python /var/www/html/script/coffee.py ' .$coffeeLevel.' ' .$sugarLevel.' ' .$creamerLevel);	
		
		header("Location: ../View/dashboard.php?brew=success");
		exit();		
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	
}else if(isset($_POST['disable'])){
	require "dbh.inc.php";

	$getQueue = "SELECT * FROM coffee_request WHERE status=0 and userID = ?";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt,$getQueue)){
		header("Location: ../View/dashboard.php?error=sqlfail");
		exit();
	}else{
		mysqli_stmt_bind_param($stmt,"s",$_SESSION['id']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		$resultCheck = mysqli_stmt_num_rows($stmt);

		if($resultCheck > 0){
			$result = true;
		}else
			$result = false;

		$data = array(
			'result' 	=> $result
		);

		echo json_encode($data);
	}
}else{
	
}