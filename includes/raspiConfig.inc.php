<?php
	
	//automatic login and redirection of raspi
	session_start();
	$_SESSION['id'] = "";
	$_SESSION['username'] = "raspi";
	$_SESSION['type'] = "machine";

	header("Location: ../View/dashboard.php?login=machine");
	exit();
