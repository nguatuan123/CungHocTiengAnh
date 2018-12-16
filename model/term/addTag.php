<?php
	session_start();
	require_once("../../connect/connect.php");
	$id = $_POST['id'];
	$query      = mysqli_query($conn, "SELECT `username` FROM `term-voca` WHERE `id` = '$id'");
	$row = mysqli_fetch_assoc($query);
	$arrUsername = unserialize($row['username']);
	array_push($arrUsername, $_SESSION['username']);
	$strUsername = serialize($arrUsername);
	$up_query = mysqli_query($conn, "UPDATE `term-voca` SET `username` = '$strUsername' WHERE `id` = $id");
	if (!$up_query){
		echo 'Query error';
	}
	else{
		echo '<script>window.location = ""</script>';
	}
?>