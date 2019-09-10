<?php

if(isset($_POST['signup-submit'])){
	
	require '../includes/dbh.inc.php';
	//echo '<script type="text/javascript">alert("nice!");</script>';
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$role = $_POST['role'];
	
	if(isset($_POST['id'])){
		$sql = "UPDATE users SET `username`=?, `email`=?, `password`=?,`role`=? WHERE `id`=?";
		$stmt = mysqli_stmt_init($conn);
		
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../View/viewUsers.php?error=sqlerror");
			exit();
		}else{
			$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
			
			mysqli_stmt_bind_param($stmt,"sssss", $username, $email, $hashedPwd,$role, $_POST['id']);
			mysqli_stmt_execute($stmt);
			if($_SESSION['id'] == $_POST['id']){
				session_start();
				$_SESSION['username'] = $username;
				$_SESSION['role'] = $role;
			}
			/**/
			header("Location: ../View/viewUsers.php?update=success");
			exit();
		}
	}
	else{
		$sql = "SELECT username FROM users WHERE username=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../View/dashboard.php");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt,"s",$username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			
			if($resultCheck > 0){
				header("Location: ../View/dashboard.php");
				exit();
			}else{
				$sql = "INSERT INTO users (username,email,role,password) VALUES (?,?,?,?);";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt,$sql)){
					header("Location: ../View/dashboard.php?error=sqlerror");
					exit();
				}else{
					$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
					
					mysqli_stmt_bind_param($stmt,"ssss", $username, $email, $role, $hashedPwd);
					mysqli_stmt_execute($stmt);
					header("Location: ../View/viewUsers.php?signup=success");
					exit();
				}
				
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	
}
else{
	header("Location: ../View/userProfile.php");
	exit();
}
