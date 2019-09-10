<?php
	session_start();
	if($_SESSION['role'] == 'admin'){
		if(isset($_GET['maintenance'])){

			require "dbh.inc.php";

			$maintenanceBool = $_GET['maintenance'];
			echo $maintenanceBool;

			//update if in maintenance
			$sql = "UPDATE config SET config_status = ? WHERE config_key='SYSTEM_MAINTENANCE'";

			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt,$sql)){
				header("Location: ../View/dashboard.php?error=sqlFail");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt,"s", $maintenanceBool);
				mysqli_stmt_execute($stmt);
				
				
				header("Location: ../View/dashboard.php?maintenace=$maintenanceBool");
				exit();
			}
		}
	}
	else{
		echo 'You are not authorized to enter this page! ERROR 403';

	}
	