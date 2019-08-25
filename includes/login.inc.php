<?php

if(isset($_POST['login-submit'])){
	
	require '../includes/dbh.inc.php';
	
	$mailUsername = $_POST['emailUsername'];
	$password = $_POST['password'];
	
	$sql = "SELECT * FROM users WHERE username=? OR email=?;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("Location: ../coffee-website/index.php?error=sqlerror");
		exit();
	}else{
		mysqli_stmt_bind_param($stmt,"ss", $mailUsername, $mailUsername);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if($row = mysqli_fetch_assoc($result) ){
			$pwdCheck = password_verify($password, $row['password']);
			if($pwdCheck == false){
				header("Location: ../index.php?error=wrongpwd");
				exit();
			}else if($pwdCheck == true){
				session_start();
				$_SESSION['id'] = $row['id'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['role'] = $row['role'];
				
				header("Location: ../View/dashboard.php?login=success");
				exit();
			}else{
				header("Location: ../index.php?error=wrongpwd");
				exit();
			}
		}else{
			header("Location: ../index.php?error=nouser");
			exit();
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	
}else{
	header("Location: ../index.php");
	exit();
}
