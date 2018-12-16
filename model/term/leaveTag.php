<?php
	session_start();
	require_once("../../connect/connect.php");
	$id = $_POST['id'];
	$name = $_POST['name'];
	$direc = $_POST['direction'];
	$query      = mysqli_query($conn, "SELECT `username` FROM `term-voca` WHERE `id` = '$id'");
	$row = mysqli_fetch_assoc($query);
	$arrUsername = unserialize($row['username']);
	for ( $i = 0; $i < count($arrUsername); $i++ ){
		if ( $arrUsername[$i] === $_SESSION['username'] ){
			unset($arrUsername[$i]);
			$arrUsername = array_merge($arrUsername);
		}
	}
	if ( count($arrUsername) === 0 ){
		$sql =  "DELETE from `term-voca` WHERE `id` = '$id'; DELETE from `vocabulary` WHERE `name` = '".$name."'; SET @s := 0; UPDATE `term-voca` SET id = (@s := @s + 1) ORDER BY id; SET  @num := 0; UPDATE `term-voca` SET id = @num := (@num+1); ALTER TABLE `term-voca` AUTO_INCREMENT =1;SET @s := 0; UPDATE `vocabulary` SET id = (@s := @s + 1) ORDER BY id; SET  @num := 0; UPDATE `vocabulary` SET id = @num := (@num+1); ALTER TABLE `vocabulary` AUTO_INCREMENT =1;";
		$query = mysqli_multi_query($conn , $sql);
		if ( !$query ){
			echo 'Query error!';
		}
	    else{
	    	if ( $direc == 0 ){
	    		echo '
				 <script>
		            window.location.href = "";
		        </script>';
	    	}
	    	else{
	    		echo '<script>window.location = ""</script>';
	    	}
	    	
		}
	}
	else{
		$strUsername = serialize($arrUsername);
		$up_query = mysqli_query($conn, "UPDATE `term-voca` SET `username` = '$strUsername' WHERE `id` = $id");
		if (!$up_query){
			echo 'Query error';
		}
		else{
			if ( $direc == 0 ){
	    		echo '
				 <script>
		            window.location.href = "";
		        </script>';
	    	}
	    	else{
	    		echo '<script>window.location = ""</script>';
	    	}
		}
	}
?>