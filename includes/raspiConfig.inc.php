<?php
	
	//automatic login and redirection of raspi
	session_start();
	$_SESSION['id'] = "";
	$_SESSION['username'] = "raspi";
	$_SESSION['role'] = "machine";

	header("Location: ../View/dashboard.php?login=machine");
	exit();
