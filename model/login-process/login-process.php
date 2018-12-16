<?php
    require_once("../../connect/connect.php");
    session_start();
    // Get Input Data
    $username =  addslashes($_POST['username']);
    $pass =  addslashes($_POST['pass']);
    $cus_check_login = $_POST['cus_check_login'];
    // Encode Pasword
    $pass = md5($pass); 

    $sql =  "SELECT `username`, `pass` FROM `user` WHERE `username` = '$username' ";
    $query = mysqli_query($conn, $sql);

    // Get email, Pass database
    $row = mysqli_fetch_array($query);
    $check_username    = $row['username'];
    $check_pass     = $row['pass'];

    $direction = $_POST['direction'];
    // Has been Email and Password ?
    if (!$username || !$pass) {
        echo '<span class="badge badge-primary">!</span> Vui lòng nhập đầy đủ thông tin';
        exit;
    }

    // Check Email is correct
    if ($username != $check_username) {
       echo '<span class="badge badge-primary">!</span> Tài khoản không tồn tại';
        exit;
    }

    // Check pass is correct
    if ($pass != $check_pass) {
        echo '<span class="badge badge-primary">!</span> Sai mật khẩu';
        exit;
    }

    else{

        if ( $cus_check_login == 1){
            // Set a cookie that expires in 24 hours
            setcookie('username', $username, time()+60*60*24*365, '/');
            setcookie('password', $pass, time()+60*60*24*365, '/');
            echo '<script>window.location = "."</script>';
        }
        else{
            $_SESSION['username'] = $username;
            if ( $direction == 0 ) {
                echo '<script>window.location = "."</script>';
            }
            if ( $direction == 1) {
                echo '<script>window.location = "../"</script>';
            }
            if( $direction == 2){
                echo '<script>window.location = "../../"</script>';
            }
        }
        die();
    }
    
?>
