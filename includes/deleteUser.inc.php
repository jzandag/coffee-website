<?php
session_start();

if($_SESSION['username'] == 'admin'){
	require 'dbh.inc.php';
	
	$id = $_GET['id'];
	
	$sql = "DELETE FROM users WHERE id=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("Location: ../View/dashboard.php");
		exit();
	}else{
		mysqli_stmt_bind_param($stmt,"s",$id);
		mysqli_stmt_execute($stmt);
		
		header("Location: ../View/viewUsers.php?delete=success");
		exit();
		
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}else{
	header("Location: ../View/userProfile.php");
	exit();
}
