<?php
	require_once('connect/connect.php');
	session_start();

	if ( isset( $_COOKIE['username'] ) && isset( $_COOKIE['password'] ) ) {
		$sql =  " SELECT `username`, `pass` FROM `user` WHERE `username` = '".$_COOKIE['username']."' ";
	    $query = mysqli_query($conn, $sql);

	    // Get Email, Pass database
	    $row = mysqli_fetch_array($query);
	    $check_pass     = $row['pass'];
	    $check_username    = $row['username'];

	    if ( $_COOKIE['password'] != $check_pass) {}

	    if ( $_COOKIE['username'] != $check_username ) {}

	    else {
	    	$_SESSION['username'] = $_COOKIE['username'];
	    	header('Location: admin/lastest');
	    }
	}

	if( isset($_SESSION['username']) ) {
		header('Location: admin/lastest');
	}

	else {
	    $sql_web = 'SELECT * from `web-information` WHERE 1';
	    $query_web = mysqli_query($conn, $sql_web);
	    if ( !$query_web ) {
	    	echo 'Query error!';
	    }
	    else{
			$row_web 		= mysqli_fetch_assoc($query_web);
			$web_name 		= $row_web['name'];
			$web_facebook 	= $row_web['facebook'];
			$web_instagram 	= $row_web['instagram'];
			$web_twitter 	= $row_web['twitter'];
	    }
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <title></title>
	  <link rel="stylesheet" href="package/load-circle/load-circle.css"><!--Style -->
	  <link rel="stylesheet" href="package/style/index/index.css"><!-- Style -->
	  <link rel="stylesheet" href="assets/css/argon.css?v=1.0.0"><!-- Argon Boostrap -->
	  <link rel="stylesheet" href="package/spaceship-menu/spaceship.css">
	  <link rel="stylesheet" href="assets/font-awesome/fontawesome-free-5.3.1-web/css/all.css"><!-- Font awsome -->
	  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!-- Google Font -->
	  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css"><!-- Nucleo Icons -->
	  <script type="text/javascript" src="assets/Jquery/jquery-3.3.1.min.js"></script><!-- Jquery -->	  
</head>
<body>
	<div id="load-circle">
		<div class="bg-lds-ring bg-gradient-primary"></div>
		<div class="lds-ring"><div></div><div></div><div></div><div></div></div>
	</div>
	<header class="navbar navbar-expand-lg navbar-dark bg-gradient-primary shadow">
	   	<div class="container">
	      	<a href=".">
	         	<h3 class="text-white"><?php echo $web_name ?>
	         	</h3>

	      	</a>
	      	<button class="navbar-toggler btn btn-primary" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
	      		<i class="ni ni-bullet-list-67 text-primary" style="font-size: 20px"></i>
	      	</button>
	      	<div class="collapse navbar-collapse" id="navbar-default">
	        	<div class="navbar-collapse-header">
	            	<div class="row">
	               	<div class="col-6 collapse-brand">
	                  	<a href="index.html">
	                  		<img src="">
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
	        <div class="navbar-nav ml-lg-auto w-100">
	         	<ul class="navbar-nav ml-lg-auto login-btn">
	         		<li class="nav-item">
	            		<button type="button" class="btn btn-white" data-toggle="modal" data-target="#modal-form">Đăng nhập</button>
	            	</li>
	            	<li class="nav-item">
	            		<a href="register"><button class="btn btn-default">Đăng kí</button></a>
	            	</li>
	            </ul>
	        </div>
	        
	      </div>
	   </div>
	</header>
	<div id="setting-component">
		<img src="package/img/register/logo_white.png" id="setting-spaceship" class="spaceship spaceship-stop" data-toggle="tooltip" data-placement="left" title="Another">
		<div class="setting-menu" id="setting-menu">
			<div class="bg-primary ml-3" data-toggle="tooltip" data-placement="left" title="Follow me">
				<a href="<?php echo $web_facebook ?>"><p class="text-center"><i class="fab fa-facebook-f text-white"></i></p></a>
			</div>

			<div class="bg-danger mt-3" style="margin-left: 2.2em;" data-toggle="tooltip" data-placement="left" title="Follow me">
				<a href="<?php echo $web_instagram ?>"><p class="text-center"><i class="fab fa-instagram text-white"></i></p><a href="">
			</div>

			<div class="bg-info" style="margin-left: 5.2em; margin-top: -.5em" data-toggle="tooltip" data-placement="left" title="Follow me">
				<a href="<?php echo $web_twitter ?>"><p class="text-center"><i class="fab fa-twitter text-white"></i></p><a href="">
			</div>
		</div>
	</div>

	<!-- Modal -->
        <div class="modal" id="exampleModal">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h1 id="page-redirect-text" class="text-mute text-center"></h1>
              </div>
              <div class="modal-footer" id="modallabe-button">
                <button type="button" class="btn btn-secondary" id="exampleModal-close">Đóng</button>
              </div>
            </div>
          </div>
        </div>

	    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	      <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	        <div class="modal-content">
	          <div class="modal-body p-0">
	            <div class="card bg-secondary shadow border-0">
	              <div class="card-header bg-white pb-5">
	                  <div class="text-muted text-center mb-3">
	                    <h5 class="text-primary">Đăng nhập để sử dụng</h5>
	                    <small>Đăng nhập với</small>
	                  </div>
	                  <div class="btn-wrapper text-center">
	                      <a href="#" class="btn btn-neutral btn-icon">
	                          <span class="btn-inner--icon">
	                            <i class="fab fa-facebook-square" style="font-size:22px;"></i>
	                          </span>
	                          <span class="btn-inner--text">Facebook</span>
	                      </a>
	                      <a href="#" class="btn btn-neutral btn-icon">
	                          <span class="btn-inner--icon">
	                            <i class="fab fa-google" style="font-size: 22px"></i>
	                          </span>
	                          <span class="btn-inner--text">Google</span>
	                      </a>
	                  </div>
	                </div>
	                <div class="card-body px-lg-5 py-lg-5">
	                    <div class="text-center text-muted mb-4">
	                        <small>Hoặc đăng nhập bằng thông tin xác thực</small>
	                    </div>
						<!-- Form -->
	                      	<form role="form" id='login-form'>
	                          	<div class="form-group mb-3">
	                              	<div class="input-group input-group-alternative">
	                                  	<div class="input-group-prepend">
	                                    	<span class="input-group-text"><i class="ni ni-email-83"></i></span>
	                                  	</div>
	                                	<input class="form-control" placeholder="Tài khoản" type="email" id="username">
	                              	</div>
	                          	</div>
	                          	<div class="form-group">
	                              	<div class="input-group input-group-alternative">
	                                  	<div class="input-group-prepend">
	                                      	<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
	                                  	</div>
	                                  	<input class="form-control" placeholder="Mật khẩu" type="password" id="pass">
	                              	</div>
	                          	</div>
	                          	<div class="custom-control custom-control-alternative custom-checkbox">
	                              	<input type="checkbox" class="custom-control-input" id="customCheckLogin" value="0">
								  	<input type="checkbox" class="custom-control-input" value="1">
	                              	<label class="custom-control-label" for="customCheckLogin">
	                              		<span>Ghi nhớ đăng nhập</span>
	                              	</label>
	                              	<a class="float-right" href="register/">Đăng kí</a>
	                          	</div>
	                          	<div class="text-center">
	                            	<button type="button" id="login" class="btn btn-primary my-4">Đăng nhập</button>
	                          	</div>
	                      	</form>
						  	<p class="text-center text-primary" id="result"></p>
	                      	</div>
	                  	</div>
	              	</div>
	          	</div>
	      	</div>
	  	</div>
		
		<nav class="container-1">  
			<div class="side-left">
			    <div class="sl-bg-b"></div>
			</div>
			<div class="side-right">
			   <div class="sr-bg-a"></div>
			</div>
		    <div class="container">
		      	<div class="col-6">
		        	<h1 class="text-primary font-weight-bold">Công cụ hỗ trợ cho việc học tiếng Anh.</h1>
		        	<h5 style="font-size: 14px; text-shadow: 0 -1px 1px rgba(0, 0, 0, .25);" class="text-primary">
		        		Học tiếng Anh dễ dàng hơn nhờ các công cụ của <?php echo $web_name; ?> . <br> Xây dựng chương trình giảng dạy hoặc chọn một giáo trình trong nhiều chương trình giảng dạy được hỗ trợ bởi những người dùng khác.</h5>
		        	<br>
		        	<button class="btn btn-primary rounded-0 col-4 mt-2 br-bottom-2" data-toggle="modal" data-target="#modal-form">
		          		<h6 class="font-weight-bold text-white">Bắt đầu</h6>
		        	</button>
		      	</div>
		    </div>
		</nav>
		

  	<nav class="container-fluid h-100 container-2 mt-5">
  		<div class="side-left">
		    <div class="sl-bg-b"></div>
		</div>
		<div class="side-right">
		   <div class="sr-bg-a"></div>
		</div>
	    <h3 class="font-weight-bold text-center">
	    	<br>
			<span class="text-mute">Số học phần đã được tạo</span><br>
	    	<span class="badge badge-primary text-dark"> 
	    		<?php
	          			$query = mysqli_query($conn, 'SELECT * from `term-voca` order by `id` DESC limit 1');
	          			while ($row = mysqli_fetch_assoc($query)) {
	              			echo $row["id"];
	          			}
	        	?>
	        </span><br>
	        <span class="text-mute">Và nhiều hơn nữa</span>
	    </h3>
	    <div class="container bg-primary shadow rounded mt-5 pb-5">
	      	<div class="row pt-5">
	        	<div class="term-create pointer">
	          		<div>
	            		<h5 class="font-weight-bold text-center mt-2 text-mute" style="font-size: 12px">Học phần của bạn</h5>
	            		<button class="btn btn-primary mt-1" data-toggle="modal" data-target="#modal-form" style="width: 80%; margin-left: 10%; font-size: 10px">Tạo học phần <br> cho bạn</button>
	          		</div>
	        	</div>
	        <?php
	          	$query = mysqli_query($conn, 'SELECT * from `term-voca` order by `id` DESC limit 15');
	          	while ($row = mysqli_fetch_assoc($query)) {
	              	$query_author = mysqli_query($conn, 'SELECT `id` from `user` where username = "'.unserialize($row["username"])[0].'"');
	              	$row_author = mysqli_fetch_assoc($query_author);
	              	$id_author 	= $row_author['id'];
	              	echo '
	                <div class="float-left rounded flash-card shadow pointer" onclick="direction_URLuser(event, '."'".'terms/flash-card/?id='.$row['id'].''."'".','."'".'user/?id='.$id_author.''."'".')">
		        		<div class="card-image rounded-top" style="background-image: url('."'".''.$row['img'].''."'".')"></div>
		        		<div class="card-content">
			        		<span class="user-url">
					        	<i class="ni ni-single-02"></i> '.unserialize($row['username'])[0].'
					        </span>
			        		<span class="float-right mr-1">'.$row['date'].'</span><br>
		        			<h6 class="card-title text-center font-weight-bold mt-4">'.$row['name'].'</h6>
		        		</div>
	        		</div>
	              	';
	          	}
	        ?>
	      	</div>
	   	</div>
	</nav>
	  <!-- Core -->
	  <script type="text/javascript" src="assets/vendor/popper/popper.min.js"></script>
	  <script type="text/javascript" src="assets/vendor/bootstrap/bootstrap.min.js"></script>
	  <script type="text/javascript" src="assets/vendor/headroom/headroom.min.js"></script>
	    
	  <!-- Optional JS -->
	  <script type="text/javascript" src="assets/vendor/onscreen/onscreen.min.js"></script>
	  <script type="text/javascript" src="assets/vendor/nouislider/js/nouislider.min.js"></script>
	  <script type="text/javascript" src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	  
	  <!-- Argon JS -->
	  <script type="text/javascript" src="assets/js/argon.js?v=1.0.0"></script>
	  <!-- Index Js -->
	  <script type="text/javascript" src="package/spaceship-menu/spaceship.js"></script>
	  <script type="text/javascript" src="controller/login/login_ajax.js"></script>
	  <script type="text/javascript" src="index.js"></script>
</body>
</html>