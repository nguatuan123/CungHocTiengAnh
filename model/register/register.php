<?php
    require_once("../../connect/connect.php");
    session_start();
    $first_name = $_POST['firstName'];
    $last_name  = $_POST['lastName'];
    $username 	= $_POST['username'];
    $email		= $_POST['email'];
    $pass		= md5($_POST['password']);
    $gender        = $_POST['gender'];
    	
	if (!$username || !$email || !$pass) {
		echo 'Nhập đầy đủ thông tin';
		exit;
	}

    //Kiểm tra tên đăng nhập này đã có người dùng chưa
    if (mysqli_num_rows(mysqli_query($conn,"SELECT `username` FROM `user` WHERE `username`='$username'")) > 0){
        echo "Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác.";
        exit;
    }
          
    //Kiểm tra email đã có người dùng chưa
    if (mysqli_num_rows(mysqli_query($conn,"SELECT `email` FROM `user` WHERE `email`='$email'")) > 0)
    {
        echo "Email này đã có người dùng. Vui lòng chọn Email khác.";
        exit;
    }

    else{
		$sql = "INSERT INTO `user` (ho, ten, username, email, pass, img, gender) VALUES ('$first_name', '$last_name','$username','$email','$pass', 'package/user/img/user-default.png', '$gender')";
        $query = mysqli_query($conn, $sql);

        if ( !$query ) {
        	echo 'Query error';
        }

        else{
            $_SESSION['username'] = $username;
        	echo '<script type="text/javascript">window.location = "../admin/lastest"</script>';
        }
	}
?>
