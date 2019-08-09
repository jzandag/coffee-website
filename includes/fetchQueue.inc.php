<?php

if(isset($_POST['view'])){

	require "dbh.inc.php"; 
	if($_POST["view"] != ''){
		$update_query = "UPDATE coffee_request SET status=1 WHERE id = ?";
		mysqli_query($conn, $update_query);
	}

	$query = "SELECT coffee_request.*,users.username FROM coffee_request JOIN users ON userID = users.id WHERE `status` = 0 ORDER BY brew_date LIMIT 6"; 
	$result = mysqli_query($conn, $query);
	$output = '';

	if(mysqli_num_rows($result) > 0){
		$count = 1;
		while($row = mysqli_fetch_array($result)){
			$output .= '
				<tr>
					<td>'.$count.'</td>
					<td>'.$row['app_date'].'</td>
					<td>'.$row['brew_date'].'</td>
					<td>'.$row['username'].'</td>
					<td>'.$row['status'].'</td>
				</tr>
			';$count++;
		}	
	}
	else{
		$output .= '
			<tr><td colspan=5 class="danger text-center" ><a href="#" class="text-bold text-italic">No scheduled brew</td></tr>
		';
	}
	$queryZeroStatus = "SELECT * FROM coffee_request WHERE status = 0";
	$resultZeroStatus = mysqli_query($conn, $queryZeroStatus);
	$count = mysqli_num_rows($resultZeroStatus);
	$data = array(
		'queue_list' 	=> $output,
		'queue_count' 	=> $count
	);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	
	echo json_encode($data);

	
}
