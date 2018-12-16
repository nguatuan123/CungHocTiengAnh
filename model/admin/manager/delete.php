<?php
	require_once('../../../connect/connect.php');
	$name = $_POST['name'];
	$id = $_POST['id'];
	$sql =  "DELETE from `term-voca` WHERE `id` = '$id'; DELETE from `vocabulary` WHERE `name` = '".$name."'; SET @s := 0; UPDATE `term-voca` SET id = (@s := @s + 1) ORDER BY id; SET  @num := 0; UPDATE `term-voca` SET id = @num := (@num+1); ALTER TABLE `term-voca` AUTO_INCREMENT =1;SET @s := 0; UPDATE `vocabulary` SET id = (@s := @s + 1) ORDER BY id; SET  @num := 0; UPDATE `vocabulary` SET id = @num := (@num+1); ALTER TABLE `vocabulary` AUTO_INCREMENT =1;";
	$query = mysqli_multi_query($conn , $sql);
	if ( !$query ){
		echo 'Query error!';
	}
    else{
    	echo '
		 <script>
            window.location.href = "../lastest";
        </script>';
	}
?>