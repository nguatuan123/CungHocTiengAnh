<?php
	require_once('../../../connect/connect.php');
	$id = $_POST['id'];
	$sql =  " DELETE from `vocabulary` WHERE `id` = '$id'";
	$query = mysqli_query($conn , $sql);
	if ( !$query ){
		echo 'Query error!';
	}
	else{
		 $query_id = mysqli_multi_query($conn, 'SET @s := 0; UPDATE `vocabulary` SET id = (@s := @s + 1) ORDER BY id;SET  @num := 0; UPDATE `vocabulary` SET id = @num := (@num+1); ALTER TABLE `vocabulary` AUTO_INCREMENT =1;');
        if ( !$query_id ){
            echo 'Reset id error';
        }
		else { 
			echo '
			 <script>
	            window.location.href = "";
	        </script>';
	    }
	}
?>