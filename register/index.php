<?php
    require_once('../connect/connect.php');
    session_start();

    if ( isset( $_COOKIE['email'] ) && isset( $_COOKIE['password'] ) ) {
      $sql =  " SELECT `email`, `pass` FROM `user` WHERE `email` = '".$_COOKIE['email']."' ";
      $query = mysqli_query($conn, $sql);

      // Get Email, Pass database
      $row = mysqli_fetch_array($query);
      $check_pass     = $row['pass'];
      $check_email    = $row['email'];

        if ( $_COOKIE['password'] != $check_pass) {}

        if ( $_COOKIE['email'] != $check_email ) {}

        else {
          $_SESSION['email'] = $_COOKIE['email'];
          header('Location: ../admin/lastest');
        }
    }

    if( isset($_SESSION['email']) ) {
      header('Location: ../admin/lastest');
    }

    else {
        $sql_web = 'SELECT * from `web-information` WHERE 1';
        $query = mysqli_query($conn, $sql_web);
        if ( !$query ) {
          echo 'Query error!';
        }
        else{
          $row_web = mysqli_fetch_assoc($query);
          $web_name       = $row_web['name'];
          $web_facebook   = $row_web['facebook'];
          $web_instagram  = $row_web['instagram'];
          $web_twitter    = $row_web['twitter'];
        }
    }
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" href="./../package/load-circle/load-circle.css"><!--Style -->
    <link rel="stylesheet" href="../package/style/register/register.css"><!-- Style -->
    <link rel="stylesheet" href="../assets/css/argon.css?v=1.0.0"><!-- Argon Boostrap -->
    <link rel="stylesheet" type="text/css" href="../package/spaceship-menu/spaceship.css">
    <link rel="stylesheet" href="../assets/font-awesome/fontawesome-free-5.3.1-web/css/all.css"><!-- Font awsome -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!-- Google Font -->
    <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css"><!-- Nucleo Icons -->
    <script type="text/javascript" src="../assets/Jquery/jquery-3.3.1.min.js"></script><!-- Jquery -->   
</head>
<body>
    <div id="load-circle">
      <div class="bg-lds-ring bg-gradient-primary"></div>
      <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
    </div>
    <!-- Setting menu -->
    <div id="setting-component">
      <img src="../package/img/register/logo_white.png" id="setting-spaceship" class="spaceship spaceship-stop" data-toggle="tooltip" data-placement="left" title="Another">
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

    <nav class="nav-left float-left">
        <div class="text-center">
            <a href="../"><img src="../package/img/register/logo_white.png" width="20%"></a>
            <h2 class="mt-5"><a href="../" class="text-white font-weight-bold"><?php echo $web_name; ?></a></h2>
            <h5 class="text-white">Đăng nhập để học với <br> <?php echo $web_name; ?> !</h5>
            <br>
        </div>
    </nav>

    <div class="border-nav-right float-left"></div>

    <nav class="nav-right float-left">
      <h2 class="text-center text-primary font-weight-bold mt-3">Đăng kí</h2>
      <p class="text-center text-primary">Miễn phí và mãi mãi !</p>
          <form class="ml-5 mt-3" onsubmit="return false">

            <div class="form-row float-left">
              <div class="form-group col-md-12">
                  <input type="text" class="form-control" id="first-name-regis" placeholder="Họ *" minlength="1" maxlength="8" required>
              </div>
            </div>

            <div class="form-row pl-2">
              <div class="form-group col-md-4">
                  <input type="text" class="form-control" id="last-name-regis" placeholder="Tên *" minlength="1" maxlength="8" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="username-regis" placeholder="Tài khoản *" minlength="6" maxlength="22" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                  <input type="email" class="form-control" id="email-regis" placeholder="Email *" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                  <input type="password" class="form-control" id="password-regis" placeholder="Mật khẩu *" aria-describedby="passwordHelpInline" minlength="8" maxlength="20" required>
                  <small id="passwordHelpInline" class="text-muted">
                    Kí tự phải từ 8 - 20 kí tự!
                  </small>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                  <input type="password" id="confirm-password" class="form-control" placeholder="Nhập lại mật khẩu *" required>
              </div>
            </div>

            <!-- gender -->
            <div class="form-group float-left">
              <div class="custom-control custom-radio mb-2">
                <input name="custom-radio-1" class="custom-control-input" id="customRadio1" type="radio" value="male">
                <label class="custom-control-label" for="customRadio1">Nam</label>
              </div>
              <div class="custom-control custom-radio mb-2">
                <input name="custom-radio-1" class="custom-control-input" id="customRadio2" checked="" type="radio" value="female">
                <label class="custom-control-label" for="customRadio2">Nữ</label>
              </div>
              <div class="custom-control custom-radio mb-2">
                <input name="custom-radio-1" class="custom-control-input" id="customRadio3" type="radio" value="none">
                <label class="custom-control-label" for="customRadio3">Không</label>
              </div>
            </div>
            <button class="btn btn-primary mt-4" style="margin-left: 28%" id="register" type="submit">Đăng kí</button>
          </form>
        <span class="badge badge-pill badge-primary mt-4" id="res-result"></span>
    </nav>
      <!-- Core -->
      <script type="text/javascript" src="../assets/vendor/popper/popper.min.js"></script>
      <script type="text/javascript" src="../assets/vendor/bootstrap/bootstrap.min.js"></script>
      <script type="text/javascript" src="../assets/vendor/headroom/headroom.min.js"></script>
        
      <!-- Optional JS -->
      <script type="text/javascript" src="../assets/vendor/onscreen/onscreen.min.js"></script>
      <script type="text/javascript" src="../assets/vendor/nouislider/js/nouislider.min.js"></script>
      <script type="text/javascript" src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
      
      <script type="text/javascript" src="../assets/js/argon.js?v=1.0.0"></script><!-- Argon JS -->
      <script type="text/javascript" src="../package/spaceship-menu/spaceship.js"></script>
      <script type="text/javascript" src="../controller/register/register_ajax.js"></script><!-- Register control -->
      <script type="text/javascript" src="../controller/login/login_ajax.js"></script><!-- Login control -->
      <script type="text/javascript" src="index.js"></script><!-- Index Js -->
</body>
</html>