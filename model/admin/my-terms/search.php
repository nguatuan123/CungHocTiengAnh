<?php
	session_start();
	require_once('../../../connect/connect.php');
  	if ( !isset( $_SESSION['username'] ) ){
      	header("location:../../");
   	}
   	else{
   		$key = $_POST['key'];
   		$username = $_SESSION['username'];

		$query_terms = mysqli_query($conn, 'SELECT * from `term-voca` WHERE `name` like "%'.$key.'%" OR `date` like "%'.$key.'%" ORDER BY `date` desc');
		while ( $row = mysqli_fetch_assoc($query_terms) ){
			$name = $row['name'];
			$id = $row['id'];
			$date = $row['date'];
			$arrUsername = unserialize($row['username']);
			// ---- 
			$sql_voca = 'SELECT `en` FROM `vocabulary` WHERE `name` = "'.$name.'" ';
	        $en   = array();
	        $query_voca = mysqli_query( $conn, $sql_voca );
	        while ( $row_terms = mysqli_fetch_assoc( $query_voca ) ){
	             array_push($en, ''.$row_terms['en'].'');
	        }

			for ( $i = 0; $i < count($arrUsername); $i++ ){
				if ( $username === $arrUsername[$i] ){
					echo 
					'
					<a href="../manager/?id='.$row['id'].'">
						<div class="float-left flash-card shadow">
				    		<div class="card-image" style="background-image: url('."'".'../../'.$row['img'].''."'".')"></div>
				    		<div class="card-content">
				        		<span class="float-right mr-1" style="font-size: 12px">'.$row['date'].'</span><br>
				    			<h6 class="card-title text-center font-weight-bold mt-2" style="font-size: 15px">'.$row['name'].'</h6>
				    		</div>
						</div>
					</a>
					';
				}
			}
		}
   	}
?>