<?php
	session_start();
	/*if(isset($_POST['disable'])){*/
		require 'dbh.inc.php';

		//THIS LINE OF CODES IS IF YOU WANT TO CONFIGURE THE DISABLING TO MINUTE DIFFERENCE
		$sql = $query = "SELECT app_date, userId FROM coffee_request WHERE userId = ".$_SESSION['id']." ORDER BY app_date DESC LIMIT 1;";
	
		$result = mysqli_query($conn, $query);
		$latest;
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$latest = $row['app_date'];
			}
		}

		$minuteDiff = round((abs((strtotime($latest) - time()) / 60)),2);
		echo  $minuteDiff . " minute";

		if($minuteDiff < 10){
			echo 'true';
		}

		//FOR QUEUE CONFIGURATIONS


	/*}*/

?>