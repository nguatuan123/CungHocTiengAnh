<?php
	session_start();
	require_once('../../../connect/connect.php');
  	if ( !isset( $_SESSION['username'] ) ){
      	header("location:../../");
   	}
   	else{
   		$username = $_SESSION['username'];
		$key = $_POST['key'];
		$sql = "SELECT * from `term-voca` where `name` like '%$key%'";
		$query = mysqli_query($conn, $sql);
		if ( !$query ){
			echo 'Query error!';
		}
		else{
			$key = $_POST['key'];
			$sql = "SELECT * from `term-voca` where `name` like '%$key%'";
			$query = mysqli_query($conn, $sql);
			if ( !$query ){
				echo 'Query error!';
			}
			else{
				while ($row = mysqli_fetch_assoc($query)) {
					$username = unserialize( $row['username'] );
					$query_author = mysqli_query($conn, 'SELECT `id` from `user` where username = "'.$username[0].'"');
	              	$row_author = mysqli_fetch_assoc($query_author);
	              	$id_author 	= $row_author['id'];
					echo '
						<div class="float-left rounded flash-card shadow" onclick="direction_URLuser(event, '."'".'../../terms/flash-card/?id='.$row['id'].''."'".','."'".'../../user/?id='.$id_author.''."'".')">
				    		<div class="card-image rounded-top" style="background-image: url('."'".'../../'.$row['img'].''."'".')"></div>
				    		<div class="card-content">
				        		<span class="user-url" style="font-size: 14px">
						        	<i class="ni ni-single-02"></i> '.$username[0].'
						        </span>
				        		<span class="float-right mr-1" style="font-size: 12px">'.$row['date'].'</span><br>
				    			<h6 class="card-title text-center font-weight-bold mt-2" style="font-size: 15px">'.$row['name'].'</h6>
				    		</div>
						</div>
						' ;
					}
				}
			}
   		}
?>