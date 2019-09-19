<?php

if(isset($_POST['brew-submit'])){
	
	require '../includes/dbh.inc.php';
	
	$coffeeLevel = $_POST['coffeeLevel'];
	$sugarLevel = $_POST['sugarLevel'];
	$creamerLevel = $_POST['creamerLevel'];
	
	$tz = 'Asia/Manila';
	$timestamp = time();
	$dt = new DateTime("now", new DateTimeZone('Asia/Manila')); //first argument "must" be a string
	$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
	echo $dt->format('Y-m-d H:i:s');
	
	$brewDate = $_POST['brewDate'];
	$applicationDate = $dt->format('Y-m-d H:i:s');
	
	echo $applicationDate;
	/*echo $reqdate;*/
	
	/*CREATE TABLE coffee_request (
	coffeereq_id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    app_date DATETIME NOT NULL,
    brew_date DATETIME NOT NULL,
    coffee_level int(11) NOT NULL,
    creamer_level int(11) NOT NULL,
    sugar_level int(11) NOT NULL,
    status boolean NOT NULL,
    queue boolean NOT NULL,
    userID int(11),
    FOREIGN KEY (userID) REFERENCES users(id)
	);
);*/
	$sql = "INSERT INTO coffee_request 
		SET app_date=?,
			brew_date=?,
			coffee_level=?,
			creamer_level=?,
			sugar_level=?,
			status=2,
			queue=0,
			userID = ?,
			config_fk = 1;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("Location: ../View/dashboard.php?error=brewFail");
		exit();
	}else{
		mysqli_stmt_bind_param($stmt,"ssssss", $applicationDate, $brewDate,$coffeeLevel, $creamerLevel,$sugarLevel,$_POST['userid']);
		mysqli_stmt_execute($stmt);
		header("Location: ../View/dashboard.php?success=brewApplication");
		exit();
	
	
	
	
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}else{
	header("Location: ../index.php");
	exit();
}
