<html>
	<head>
		<title>Hello</title>
	</head>
	
	<body>
	wat the fuck
	
	<br/>
	
	
	<h1>
	
	
	if you see this, connection is successful
	
	</h1>	
	
	<?php
	

		echo "hello pooo";
		$servername = "127.0.0.1";
		$username = "root";
		$password = "coffee";
		$dbname = "sample_db";

		// Create connection
		$conn = mysqli_connect($servername,  $username, $password, $dbname);
		// Check connection
		if($conn)
			echo "<br/>connected ka";
		

		$sql = "SELECT user_id, username FROM user_details";
		$result = mysqli_query($conn, $sql);
		$resultcheck = mysqli_num_rows($result);

		echo "<br/>resuls found: ". $resultcheck;
		
		if($resultcheck > 0){
			//output all data of each row
			while($row = mysqli_fetch_assoc($result) ){
				echo "<br>id: " . $row["user_id"] . " - username: " . $row["username"]. "<br/>";
			}
		}else{
			echo "no results found!";
		}

	?>
	
	</body>


</html>
<?php
echo "<script>alert('hello');console.log('igot here');</script>";
