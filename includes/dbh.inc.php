<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "1234";
$dbName = "projectdb"; 

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if(!$conn){
	die("Connection failed: ".mysqli_connect_error());
}
