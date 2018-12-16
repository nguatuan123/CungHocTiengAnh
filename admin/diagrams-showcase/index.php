<?php
	require_once('../../connect/connect.php');
	session_start();
  	if ( !isset( $_SESSION['username'] ) ){
      	header("location:../../");
   	}
   	else{
   		$username = $_SESSION['username'];
   		$sql_web = 'SELECT * from `web-information` WHERE 1';
	    $query_web = mysqli_query($conn, $sql_web);
	    if ( !$query_web ) {
	    	echo 'Query error!';
	    }
	    else{
			$row_web 		= mysqli_fetch_assoc($query_web);
			$web_name 		= $row_web['name'];
			$facebook 		= $row_web['facebook'];
			$instagram 		= $row_web['instagram'];
			$twitter 		= $row_web['twitter'];
			$sql_user = 'SELECT `img`, `ho`, `ten` from `user` WHERE `username` = "'.$username.'" ';
			$query_user = mysqli_query($conn, $sql_user);
			if( !$query_user ){
				echo 'Query user error';
			}
			else{
				$row_user = mysqli_fetch_assoc($query_user);
				$row_img = $row_user['img'];
        		$row_name = $row_user['ho'] . ' ' . $row_user['ten'];
			}
	    }
   	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <title></title>
	  <!--Style -->
	  <link rel="stylesheet" href="../../package/style/admin/primary/index.css"><!-- Style header -->
	  <link rel="stylesheet" href="index.css"> <!-- Index -->
	  <link rel="stylesheet" href="../../assets/css/argon.css?v=1.0.0"><!-- Argon Boostrap -->
	  <link rel="stylesheet" href="../../package/spaceship-menu/spaceship.css">
	  <link rel="stylesheet" href="../../assets/font-awesome/fontawesome-free-5.3.1-web/css/all.css"><!-- Font awsome -->
	  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!-- Google Font -->
	  <link rel="stylesheet" href="../../assets/vendor/nucleo/css/nucleo.css"><!-- Nucleo Icons -->
	  <script type="text/javascript" src="../../assets/Jquery/jquery-3.3.1.min.js"></script><!-- Jquery -->	  
</head>
<body class="bg-gradient-primary">
<header class="navbar navbar-expand-lg navbar-dark bg-white shadow">
   	<div class="container">
      	<a href=".">
         	<h3 class="text-primary"><?php echo $web_name ?>
         	</h3>

      	</a>
      	<button class="navbar-toggler btn btn-primary" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
      		<i class="ni ni-bullet-list-67 text-primary" style="font-size: 20px"></i>
      	</button>
      	<div class="collapse navbar-collapse" id="navbar-default">
        	<div class="navbar-collapse-header">
            	<div class="row">
	               	<div class="col-6 collapse-brand">
	                  	<a href="."><?php echo $web_name ?>
	                  	</a>
	               	</div>
	               	<div class="col-6 collapse-close">
	                  	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
	                  		<span></span>
	                  		<span></span>
	                  	</button>
	               	</div>
            	</div>
        	</div>

        	
        		<div class="user-address" data-toggle="tooltip" data-placement="bottom" title="My profile">
        			<a href="../profile/">
	        			<div style="background-image : url('../../<?php echo $row_img ?>')"></div>
	        				<span class="text-primary ml-2"><?php echo $row_name ?></span>
	        			</div>
	        		</a>
        		</div>
        	<a href="../../model/log-out/log-out.php" class="log-out" data-toggle="tooltip" data-placement="bottom" title="Log out"><i class="ni ni-button-power"></i></a>
     	</div>
   	</div>
</header>
	<nav class="navigation-left float-left shadow">
		<p class="text-center text-primary mt-4"><?php echo $web_name ?></p>
		<a href="../../package/Hướng dẫn sử dụng.docx" target="_blank" class="ml-4 font-weight-bold" style="font-size: 15px">
				Hướng dẫn
		</a>
		<ul class="list-group shadow" style="margin-top: 1em">
			<a href="../diagrams-showcase/">
				<li class="list-group-item rounded-0 pointer active">
		            <span class="btn-inner--icon">
		              <i class="ni ni-ungroup"></i>
		            </span>  &nbsp; &nbsp;Tất cả học phần
	        	</li>
	        </a>


		    <a href="../lastest/">
		        <li class="list-group-item pointer rounded-0">
		            <span class="btn-inner--icon">
		              <i class="ni ni-watch-time"></i>
		            </span>  &nbsp; &nbsp;Hoạt động gần đây
		        </li>
		    </a>

		    <a href="../my-terms/">
		        <li class="list-group-item rounded-0 pointer">
		            <span class="btn-inner--icon">
		              <i class="ni ni-collection"></i>
		            </span>  &nbsp; &nbsp;Học phần của tôi
		          
		        </li>
		    </a>

		    <a href="../profile/">
		        <li class="list-group-item rounded-0 pointer">
		            <span class="btn-inner--icon">
		              <i class="ni ni-circle-08"></i>
		            </span> &nbsp; &nbsp;Thông tin người dùng
		        </li>
		    </a>
		</ul>
		<span class="float-left mt-4 ml-4 font-weight-bold">Tạo học phần</span>
		

		<ul class="list-inline text-center" style="position: fixed; bottom: 5%; left: 14.5%; font-size: 16px; width: 9%;">
		  <li class="list-inline-item">
		  	<a href="<?php echo $facebook ?>">
		  		<i class="fab fa-facebook-f text-primary"></i>
		  	</a>
		  </li>
		  <li class="list-inline-item">
		  	<a href="<?php echo $instagram ?>">
		  		<i class="fab fa-instagram text-danger"></i>
		  	</a>
		  </li>
		  <li class="list-inline-item">
		  	<a href="<?php echo $twitter ?>">
		  		<i class="fab fa-twitter text-info"></i>
		  	</a>
		  </li>
		</ul>
		<a href="../create/">
			<button class="btn btn-success rounded col-4 mt-3 mr-2 float-right" style="font-size: 10px">Tạo</button>
		</a>

		<p style='position: fixed; bottom: 0; left:15%; font-size: 12px;'>Coder by @LETUAN</p>
	</nav>

	<nav class="content-cop float-right shadow bg-white rounded-top pb-5" style="background: #F0F0F0 !important">
		<div class="w-100 shadow" style="height: 8em; background: #fff;">
			<h3 class="font-weight-bold float-left" style="margin-left: 10%; margin-top: 1.5em">Tìm kiếm học phần
				<br>
			<span style="font-size: 10px; font-weight: 100;">
				Nghiên cứu sơ đồ tương tác về nhiều chủ đề khác nhau hoặc tạo chủ đề của riêng bạn
			</span>
			</h3>			
			<form id="form-search" role="form" action="javascript:void(0);">
		    	<input type="search" class="search-input float-right mt-4 col-3" style="margin-right: 10%;" placeholder="Tìm kiếm học phần * abcdxyz" id="search">
			</form>
		</div>
		<div class="col-12 mt-5" id="result">
			<?php
				$query = mysqli_query($conn, 'SELECT * from `term-voca` order by `id` DESC limit 15');
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
				';
				}
			?>
		</div>
	</nav>
	<!-- Core -->
	  <script type="text/javascript" src="../../assets/vendor/popper/popper.min.js"></script>
	  <script type="text/javascript" src="../../assets/vendor/bootstrap/bootstrap.min.js"></script>
	  <script type="text/javascript" src="../../assets/vendor/headroom/headroom.min.js"></script>
	    
	  <!-- Optional JS -->
	  <script type="text/javascript" src="../../assets/vendor/onscreen/onscreen.min.js"></script>
	  <script type="text/javascript" src="../../assets/vendor/nouislider/js/nouislider.min.js"></script>
	  <script type="text/javascript" src="../../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	  
	  <!-- Argon JS -->
	  <script type="text/javascript" src="../../assets/js/argon.js?v=1.0.0"></script>
	  <!-- Search controller -->
	  <script type="text/javascript" src="../../controller/admin/diagrams-showcase/search-ajax.js"></script>
	  <!-- Index Js -->
	  <script type="text/javascript" src="index.js"></script>
</body>
</html>