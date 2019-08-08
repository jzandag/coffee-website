<?

if(isset($_POST['type'])){
	/*require '../includes/dbh.inc.php';
	
	if($_POST['type'] == 'isUserExist'){
		$userQuery = "SELECT * FROM users WHERE username=?";
		$stmt = mysqli_stmt_init($conn);
		if(mysqli_stmt_prepare($stmt,$userQuery)){
			mysqli_stmt_bind_param($stmt,"s", $_POST['user']);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if(mysqli_num_rows($result) > 0){
				$data = array(
					'checker' 	=> 'true'
				);
				echo json_encode($data);
			}
			
		}
		
		
	}*/
	
	
}
$data = array(
					'checker' 	=> 'true'
				);
				echo json_encode($data);
