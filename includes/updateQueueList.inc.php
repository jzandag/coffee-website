<?php
	 if(isset($_POST['update'])){
	 	require "dbh.inc.php";

	 	//get brews less than now
	 	$sql = "UPDATE `coffee_request` SET STATUS=1, queue=0 WHERE brew_date <= NOW();";
	 	$result = mysqli_query($conn, $sql);

	 	echo true;
	 }
?>