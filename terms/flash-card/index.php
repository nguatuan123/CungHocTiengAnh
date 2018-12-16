<?php
  require_once('../../connect/connect.php');
  session_start();
  $sql_web = 'SELECT * from `web-information` WHERE 1';
  $query_web = mysqli_query($conn, $sql_web);
  if ( !$query_web ) {
    echo 'Query error!';
  }
  else{
  $row_web    = mysqli_fetch_assoc($query_web);
  $web_name     = $row_web['name'];
  $web_facebook   = $row_web['facebook'];
  $web_instagram  = $row_web['instagram'];
  $web_twitter  = $row_web['twitter'];
  }
  $id   = $_GET['id'];

  // ----------------------------------------
  $sql_term = ' SELECT * FROM `term-voca` WHERE `id` = '.$id.' ';
  $query_term = mysqli_query( $conn, $sql_term );
  $row_term = mysqli_fetch_assoc( $query_term );
  $term_name = $row_term['name'];
  $term_user = unserialize($row_term['username'])[0];

  //-----------------------------------------
  $sql_voca = 'SELECT * FROM `vocabulary` WHERE `name` = "'.$term_name.'" ';
  $en   = array();
  $vn   = array();
  $img  = array();
  $query_voca = mysqli_query( $conn, $sql_voca );
  while ( $row = mysqli_fetch_assoc( $query_voca ) ) {
    array_push($en, ''.$row['en'].'');
    array_push($vn, ''.$row['vn'].'');
    array_push($img, ''.$row['img'].'');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" href="../../package/load-circle/load-circle.css"><!--Style -->
    <link rel="stylesheet" href="../../package/style/terms/primary.css"><!-- Style -->
    <link rel="stylesheet" href="../../assets/css/argon.css?v=1.0.0"><!-- Argon Boostrap -->
    <link rel="stylesheet" href="../../package/spaceship-menu/spaceship.css">
    <link rel="stylesheet" href="../../assets/font-awesome/fontawesome-free-5.3.1-web/css/all.css"><!-- Font awsome -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!-- Google Font -->
    <link rel="stylesheet" href="../../assets/vendor/nucleo/css/nucleo.css"><!-- Nucleo Icons -->
    <script type="text/javascript" src="../../assets/Jquery/jquery-3.3.1.min.js"></script><!-- Jquery -->   
</head>
<body style="background: #F0F0F0">
  <div id="load-circle">
    <div class="bg-lds-ring bg-gradient-primary"></div>
    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
  </div>
  <header class="navbar navbar-expand-lg navbar-dark bg-gradient-primary shadow">
    <div class="container">
        <a href="../../">
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
                      <a ><?php echo $web_name ?>
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

        <?php 

          if ( isset($_SESSION['username']) ) {
            $username = $_SESSION['username'];
            $sql_user = 'SELECT `img`, `ho`, `ten` from `user` WHERE `username` = "'.$username.'" ';
            $query_user = mysqli_query($conn, $sql_user);
            if( !$query_user ){
              echo 'Query user error';
            }
            else{
              $row_user = mysqli_fetch_assoc($query_user);
              $row_img = $row_user['img'];
              $row_name = $row_user['ho'] . ' ' . $row_user['ten'];
              echo '
              <div class="user-address" data-toggle="tooltip" data-placement="bottom" title="My profile">
                <a href="../profile/">
                  <div style="background-image : url(../../'.$row_img.')"></div>
                    <span class="text-white ml-2">'.$row_name.'</span>
                  </div>
                </a>
              </div>
              <a href="../../model/log-out/log-out.php" class="log-out" data-toggle="tooltip" data-placement="bottom" title="Log out"><i class="ni ni-button-power text-white"></i></a>
            ';
            }
          }
          else{
            echo '
            <div class="navbar-nav ml-lg-auto w-100">
              <ul class="navbar-nav ml-lg-auto login-btn">
                <li class="nav-item">
                    <button type="button" class="btn btn-white" data-toggle="modal" data-target="#modal-form">Đăng nhập</button>
                  </li>
                  <li class="nav-item">
                    <a href="../../register"><button class="btn btn-default">Đăng kí</button></a>
                  </li>
                </ul>
            </div>
            ';
          }
        ?>
        
      </div>
    </div>
  </header>
  
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
                      <small>Đăng nhập bằng</small>
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
                                <span>Nhớ tài khoản</span>
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

  <nav class="container-fuild bg-white navigation-top">
    <div class="container pt-5">
      <h6 class="font-weight-bold float-left pr-4 pt-1 pb-1 border-right-2px border-primary" style="color : #525f7f"><?php echo count($en) ?> Thuật ngữ</h6> 
      <?php 
          $query_author = mysqli_query($conn, 'SELECT `img`, `id`, `ho`, `ten` FROM `user` WHERE `username` = "'.$term_user.'"');
          $row_author = mysqli_fetch_assoc($query_author);
          echo 
          '<a href="../../user/?id='.$row_author['id'].'">
            <div class="ml-4 float-left user-img" style="background-image : url(../../'.$row_author['img'].')"></div>
            <h6 class="font-weight-bold pb-1 pt-1 float-left text-primary">&nbsp;'.$row_author['ho'] .' '. $row_author['ten'] .'</h6>
          </a>';
      ?>
      <br>
      <br>
      <h2 class="font-weight-bold float-left">
        <?php echo $term_name;
          $check = true;
          if ( isset($_SESSION['username']) ) {
            $query_terms = mysqli_query($conn, 'SELECT `username` from `term-voca` WHERE `id` = '.$id.'  ORDER BY `date` desc');
              while ( $row = mysqli_fetch_assoc($query_terms) ){
                $arrUsername = unserialize($row['username']);
                for ( $i = 0; $i < count($arrUsername); $i++ ){
                  if ( $username === $arrUsername[$i] ){
                    $check = false;
                    break;
                  }
                }
              }
            if ( $check === true ){
              echo '
                <span class="text-warning tag-term pointer ml-4" data-toggle="tooltip" data-placement="right" title="Thêm học phần này vào học phần của bạn" onclick="addTag('."'".$id."'".')">
                  <i class="ni ni-tag"></i>
                </span>
                ';
            }
            else{
              echo '
                <span class="text-warning pointer ml-4" title="Các nhà quản trị" data-toggle="modal" data-target="#modal-default">
                  <i class="ni ni-circle-08 remove_term"></i>
                </span>
              ';
            }
          }
        ?>
      </h2>
      <br><br>
      <ul class="list-inline mt-2" style="font-size: 26px;">
        <a href="https://www.facebook.com/dialog/share?app_id=145634995501895&display=popup&href=http://localhost:7777/enchiko/terms/flash-card/?id=<?php echo $id ?>" target="_blank">
          <li class="list-inline-item mr-3" data-toggle="tooltip" data-placement="bottom" title="Share Term on Facebook">
            <i class="fab fa-facebook-f text-primary"></i>
          </li>
        </a>
        <a href="https://twitter.com/intent/tweet?text=this%20is%20my%20Terms%20<3%20http://localhost:7777/enchiko/terms/flash-card/?id=<?php echo $id ?>" target="_blank">
          <li class="list-inline-item" data-toggle="tooltip" data-placement="bottom" title="Share Term on Twitter">
            <i class="fab fa-twitter text-info"></i>
          </li>
        </a>
      </ul>
    </div>   
  </nav>
  <div class="col-md-4">
      <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Các nhà quản trị của học phần này</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <?php
                      for ( $i = 0; $i < count($arrUsername); $i++ ){
                  if ( $i == 0 ){
                    echo '
                    <p><span class="font-weight-bold">Main admin</span> : '.$arrUsername[$i].'</p>
                    ';
                  }
                  else{
                    echo '
                    <p><span class="font-weight-bold">General amin</span> : '.$arrUsername[$i].'</p>
                    ';
                  }
                }
                    ?>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="leaveTag(<?php echo $id.','."'".$term_name."'".','. 0 ?>)">Từ chức quản trị</button>
                    <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                </div>

              </div>
        </div>
    </div>
  </div>
  <nav class="container-fluid">
    <div class="container">
      <a href="../flash-card/?id=<?php echo $id ?>">
        <div class="items pointer float-left" style="border-bottom: solid #FFCD1F 4px !important;transform: translateY(-63px);">
          <svg viewBox="-2 54 110 110" width="5.5em" class="ml-4">
             <g stroke="none" fill="#4257b2" stroke-width="1px">
                <path d="M49.862 119.264H25.573a1.3 1.4 0 1 1 0-2.8h24.29a1.4 1.4 0 0 1 0 2.8zm11.168-8.312H25.573a1.4 1.4 0 0 1 0-2.8H61.03a1.4 1.4 0 0 1 0 2.8zm-30.973-8.309a5.89 5.89 0 0 1-5.884-5.884c0-3.244 2.64-5.883 5.884-5.883s5.884 2.64 5.884 5.883a5.89 5.89 0 0 1-5.884 5.884zm0-8.967a3.087 3.087 0 0 0-3.084 3.083 3.088 3.088 0 0 0 3.084 3.084c1.7 0 3.084-1.383 3.084-3.084 0-1.7-1.384-3.083-3.084-3.083z" stroke="none" fill="#4257b2" stroke-width="1px"/>
                <path d="M95.279 89.923h-4.523V85.4c0-2.537-2.064-4.6-4.6-4.6H14.6a4.605 4.605 0 0 0-4.6 4.6v39.34c0 2.536 2.064 4.6 4.6 4.6h4.523v4.522c0 2.536 2.063 4.6 4.6 4.6h71.556c2.536 0 4.6-2.064 4.6-4.6V94.523c0-2.537-2.064-4.6-4.6-4.6zm1.8 43.94c0 .992-.807 1.8-1.8 1.8H30.08v-6.323h56.075c2.536 0 4.6-2.064 4.6-4.6V92.723h4.523c.993 0 1.8.807 1.8 1.8v39.34zm-75.156 0v-4.523h5.358v6.322h-3.558c-.993 0-1.8-.807-1.8-1.8zM12.8 124.74V85.4c0-.993.808-1.8 1.8-1.8h65.197v42.94H14.6c-.992 0-1.8-.808-1.8-1.8zM87.956 85.4v39.34c0 .992-.808 1.8-1.8 1.8h-3.559V83.6h3.56c.991 0 1.8.807 1.8 1.8z" fill="#64D9D9" stroke="none" stroke-width="1px"/>
             </g>
          </svg>
          <p class="text-center text-primary font-weight-bold">Thẻ ghi nhớ</p>
        </div>
      </a>

      <a href="../question-game/?id=<?php echo $id ?>">
        <div class="items pointer float-left ml-3">
          <svg viewBox="495 54 170 110">
            <g stroke="none" fill="#4257b2" stroke-width="1px">
              <path d="M550.4 129.121h-25.8a4.605 4.605 0 0 1-4.6-4.6v-18.14c0-2.536 2.063-4.6 4.6-4.6h39.898c2.537 0 4.6 2.064 4.6 4.6v11.64a1.4 1.4 0 1 1-2.8 0v-11.64c0-.993-.808-1.8-1.8-1.8H524.6c-.992 0-1.8.807-1.8 1.8v18.14c0 .993.808 1.8 1.8 1.8h25.8a1.4 1.4 0 1 1 0 2.8zm9.186-16.307h-30.074a1.4 1.4 0 1 1 0-2.8h30.074a1.4 1.4 0 1 1 0 2.8zm-17.14 8.074h-12.934a1.4 1.4 0 1 1 0-2.8h12.933a1.4 1.4 0 1 1 0 2.8zm82.618 5.2h-34.585a4.605 4.605 0 0 1-4.6-4.6v-9.746c0-2.536 2.063-4.6 4.6-4.6h34.585c2.536 0 4.6 2.064 4.6 4.6v9.747c0 2.536-2.064 4.6-4.6 4.6zm-34.585-16.146c-.992 0-1.8.807-1.8 1.8v9.747c0 .992.808 1.8 1.8 1.8h34.585c.992 0 1.8-.808 1.8-1.8v-9.747c0-.993-.808-1.8-1.8-1.8h-34.585zm29.252 8.073h-25.028a1.4 1.4 0 1 1 0-2.8h25.028a1.4 1.4 0 1 1 0 2.8zm-.708-26.269H605.46a1.4 1.4 0 1 1 0-2.8h13.563c.992 0 1.8-.807 1.8-1.8V77.4c0-.993-.808-1.8-1.8-1.8h-47.31c-.993 0-1.8.807-1.8 1.8v9.746c0 .993.807 1.8 1.8 1.8h4.762a1.4 1.4 0 1 1 0 2.8h-4.763a4.605 4.605 0 0 1-4.6-4.6V77.4c0-2.537 2.063-4.6 4.6-4.6h47.311c2.537 0 4.6 2.063 4.6 4.6v9.746c0 2.536-2.063 4.6-4.6 4.6z" fill="#4257b2" stroke="none" stroke-width="1px"></path>
              <path d="M576.39 144.691a4.578 4.578 0 0 0 .983-2.832v-19.17c0-2.538-2.063-4.6-4.6-4.6H553.6a4.605 4.605 0 0 0-4.6 4.6v19.17c0 1.152.429 2.204 1.131 3.012.015.016.029.034.045.05a4.583 4.583 0 0 0 3.424 1.538h19.172a4.58 4.58 0 0 0 3.41-1.524c.035-.033.066-.07.097-.106l.089-.11c.007-.01.015-.018.021-.028zm-22.79-1.032a1.8 1.8 0 0 1-.53-.088l3.496-5.27 2.4 3.616a1.4 1.4 0 0 0 2.333 0l5.454-8.22 6.551 9.873a1.77 1.77 0 0 1-.531.09H553.6zm0-22.77h19.173c.992 0 1.8.806 1.8 1.8v17.729l-6.654-10.026a1.4 1.4 0 0 0-2.333 0l-5.453 8.219-2.4-3.616a1.399 1.399 0 0 0-2.333 0l-3.6 5.424v-17.73c0-.994.809-1.8 1.8-1.8zm5.479 10.893c2.335 0 4.234-1.899 4.234-4.233s-1.899-4.234-4.234-4.234-4.234 1.9-4.234 4.234 1.9 4.233 4.234 4.233zm0-5.667c.79 0 1.434.643 1.434 1.434a1.435 1.435 0 0 1-2.868 0c0-.79.643-1.434 1.434-1.434zm43.18-26.295h-22.584a4.605 4.605 0 0 1-4.6-4.6v-9.747c0-2.536 2.063-4.6 4.6-4.6h22.585c2.537 0 4.6 2.064 4.6 4.6v9.747c0 2.536-2.063 4.6-4.6 4.6zm-22.584-16.147c-.992 0-1.8.807-1.8 1.8v9.747c0 .992.808 1.8 1.8 1.8h22.585c.993 0 1.8-.808 1.8-1.8v-9.747c0-.993-.807-1.8-1.8-1.8h-22.585zm17.253 8.073H583.9a1.4 1.4 0 1 1 0-2.8h13.028a1.4 1.4 0 1 1 0 2.8z" stroke="none" fill="#64D9D9" stroke-width="1px"></path>
            </g>
          </svg>
          <p class="text-center text-primary font-weight-bold">Trờ chơi từ vựng</p>
        </div>
      </a>
    </div> 
  </nav>

  <nav class="container-fuild">
    <div class="container" style="margin-top: 15em; padding-bottom: 5em">
       <div class="row">
          <div class="slide-card shadow pointer" id="card-en" onclick='slideCard(0, event)'>
             <div class="content-text">
                <h1 class="text-center font-weight-bold text-mute" id="en-key"></h1>
             </div>
             <div class="guide-bottom">
                <p class="text-center text-white">
                   <span class="text-white btn-inner-icon"><i class="ni ni-ungroup"></i></span>
                   Nhấp vào thẻ để lật
                </p>
             </div>
          </div>
          <div class="slide-card shadow pointer" id="card-vn" onclick='slideCard(1, event)'>

             <button class="btn btn-3 btn-icon btn-white rounded" id="btn-img" data-toggle="tooltip" data-placement="bottom" title="Bật tắt chế độ hình ảnh">
               <span class="btn-inner--icon">
                <i class="ni ni-image"></i>
               </span>
             </button>

             <div class="img-content-en shadow transform-perspective-left img-en"></div>

             <div class="content-text">
                <h1 class="text-center font-weight-bold text-mute" id="vn-key"></h1>
             </div>
          </div>
       </div>
       <div class="row">
         <div class="controller-box">
            <div class="controler-btn">
               <i class="ni ni-bold-left float-left shadow pointer" onclick="controller(0)"></i>
               <i class="ni ni-bold-right float-right shadow pointer" onclick="controller(1)"></i>
               <p class="text-center text-mute font-weight-bold text-primary">
                  <span class="number-controler">1</span>
                  /
                  <span>
                  <?php echo count($en) ;?>
                  </span>
               </p>
            </div>
         </div>
       </div>
    </div>
  </nav>

  <nav class="container mt-5 pb-5" id="terms-content">
    <div class="row">
      <h4 class="text-mute font-weight-bold float-left">Từ vựng trong phần này &nbsp;
      </h4>
      <div>
         <h4 class="badge badge-default text-white">
            <?php echo count($en); ?>
         </h4>
      </div>
    </div>
  </nav>
  <div class="nav-bottom" style="max-height: 5em; overflow: hidden">
    <ul class="list-inline text-center w-100 mt-2" style="font-size: 16px;">
      <li class="list-inline-item">
        <a href="<?php echo $web_facebook ?>">
          <i class="fab fa-facebook-f text-primary"></i>
        </a>
      </li>
      <li class="list-inline-item">
        <a href="<?php echo $web_instagram ?>">
          <i class="fab fa-instagram text-danger"></i>
        </a>
      </li>
      <li class="list-inline-item">
        <a href="<?php echo $web_twitter ?>">
          <i class="fab fa-twitter text-info"></i>
        </a>
      </li>
    </ul>
    <p style='text-align: center; font-size: 12px; color: #Fff'>Coder by @LETUAN</p>
  </div>
  <div id="tag-result"></div>
  <!-- Core -->
    <script type="text/javascript" src="../../assets/vendor/popper/popper.min.js"></script>
    <script type="text/javascript" src="../../assets/vendor/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/vendor/headroom/headroom.min.js"></script>
      
    <!-- Optional JS -->
    <script type="text/javascript" src="../../assets/vendor/onscreen/onscreen.min.js"></script>
    <script type="text/javascript" src="../../assets/vendor/nouislider/js/nouislider.min.js"></script>
    <script type="text/javascript" src="../../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- controller -->
    <script type="text/javascript" src="../../controller/login/login_ajax.js"></script>
    <!-- Argon JS -->
    <script type="text/javascript" src="../../assets/js/argon.js?v=1.0.0"></script>
    <!-- add tag -->
    <script type="text/javascript" src="../../controller/term/tag-ajax.js"></script>
    <!-- To array JS-->
      <script type='text/javascript'>
        <?php
            $js_en  = json_encode( $en );
            $js_vn  = json_encode( $vn );
            $js_img = json_encode( $img);
            
            echo 'var en_key = ' . $js_en . ";\n";
            echo 'var vn_key = ' . $js_vn . ";\n";
            echo 'var img_url = ' . $js_img . ";\n"; 
        ?>
      </script>
    <!-- Index Js -->
    <script type="text/javascript" src="index.js"></script>
</body>
</html>