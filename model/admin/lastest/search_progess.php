<?php
	session_start();
	require_once('../../../connect/connect.php');
  	if ( !isset( $_SESSION['username'] ) ){
      	header("location:../../");
   	}
   	else{
		$key = $_POST['key'];

  		$username = $_SESSION['username'];
		// $sql_user = 'SELECT `img`, `username` from `user` WHERE `username` = "'.$username.'" ';
		// $query_user = mysqli_query($conn, $sql_user);
		// $row_user = mysqli_fetch_assoc($query_user);
		// $row_img = $row_user['img'];
		// $row_name = $row_user['username'];


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
					<li class="list-group-item">
						<span class="ml-5">'.$date.'</span>
						<a href="../manager/?id='.$id.'">
						<div class="card-term shadow">
							<span class="ml-3 font-weight-bold">'.count($en).' Terms</span>
							<h5 class="font-weight-bold text-primary ml-3 mt-2">'.$name.'</h5>
						</div>
						</a>
					</li>
					';
				}
			}
		}
   	}
?>