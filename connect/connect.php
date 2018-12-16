<?php
	$host = "localhost";
	$username = "root";
	$password = "";
	$data_name = "enchiko";
	 
	// $host = "localhost";
	// $username = "id5368820_nguatuan123";
	// $password = "hanuawr123";
	// $data_name = "id5368820_mydata";
	 
	$conn = mysqli_connect($host, $username, $password, $data_name) or die ("connect error");
	mysqli_query($conn,"SET NAMES 'UTF8'");
?>