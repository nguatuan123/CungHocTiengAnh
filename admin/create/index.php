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
      $row_web    = mysqli_fetch_assoc($query_web);
      $web_name     = $row_web['name'];
      $facebook     = $row_web['facebook'];
      $instagram    = $row_web['instagram'];
      $twitter    = $row_web['twitter'];
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
<script>
  <?php
    $js_username = json_encode($username);
    echo 'var username =' . $js_username . ";\n";
  ?>
</script>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" href="../../package/load-circle/load-circle.css"><!--Style -->
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="../../package/style/admin/primary/index.css"> <!-- primary style -->
    <link rel="stylesheet" href="../../assets/css/argon.css?v=1.0.0"><!-- Argon Boostrap -->
    <link rel="stylesheet" href="../../assets/font-awesome/fontawesome-free-5.3.1-web/css/all.css"><!-- Font awsome -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!-- Google Font -->
    <link rel="stylesheet" href="../../assets/vendor/nucleo/css/nucleo.css"><!-- Nucleo Icons -->
    <script type="text/javascript" src="../../assets/Jquery/jquery-3.3.1.min.js"></script><!-- Jquery -->   
</head>
<body>
  <div id="load-circle">
    <div class="bg-lds-ring bg-gradient-primary"></div>
    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
  </div>
  <div class="col-md-4">
      <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title text-primary" id="modal-title-default">Học phần này đã được tạo trước đó</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                  Bạn có muốn trở thành nhà phát triển chung của học phần này
                </div>

                <div class="modal-footer">
                    <a href="" id="goto_url"><button type="button" class="btn btn-primary">Muốn</button></a>
                    <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Không</button>
                </div>

            </div>
        </div>
      </div>
  </div>
  <header class="navbar navbar-expand-lg navbar-dark bg-gradient-primary shadow">
    <div class="container">
        <a href="../lastest/">
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
                      <a href="../lastest/"><?php echo $web_name ?>
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
                  <span class="text-white ml-2"><?php echo $row_name ?></span>
                </div>
              </a>
            </div>
          <a href="../../model/log-out/log-out.php" class="log-out" data-toggle="tooltip" data-placement="bottom" title="Log out"><i class="ni ni-button-power text-white"></i></a>
      </div>
    </div>
  </header>
  
  <nav class="container-fuild bg-white mt-5" style="margin-left: 12.5%">
      <h5 class="text-dark font-weight-bold pt-5 ml-5">Tạo học phần mới</h5>
    
        <input type="text" class="title mt-5 ml-5 float-left" id="title" placeholder="Chủ đề, chương..." autocomplete="off"><br><br>
        <label class="float-left ml-5" style="font-size: 46px; cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Thêm hình ảnh">
          <input type="file" name="file" id="img_tt" class="remove-img" accept="image/*" onchange="readURL(this);" style="display: none"/>
          <i class="ni ni-image"></i>
        </label>   <br><br><br>
        <span class="text-mute font-weight-bold ml-5">Tiêu đề</span>
        <p class="text-danger ml-5 result"></p>
        <div class="preview-title float-left preview_js">
          <i class="ni ni-fat-remove shadow float-right bg-white" onclick="removeFileTitle(this)"></i>
        </div>
  </nav>

  <div class="container container-1">
    <svg width="111px" height="89px" viewBox="0 0 111 89" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="mt-4 ml-4 float-left">
      <g id="Web" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g id="1-Create-Set" transform="translate(-224.000000, -378.000000)">
              <g id="Group-2-Copy-6" transform="translate(172.000000, 352.000000)">
                  <g id="Group-14" transform="translate(52.000000, 26.000000)">
                      <path d="M3.34242399,37.8067227 C3.04040889,37.8074211 2.75352066,37.9380274 2.55591948,38.16478 C2.3583183,38.3915326 2.26939948,38.6921748 2.31214842,38.9889911 L2.31413023,39.0014219 L2.51530821,40.308723 L1.19647279,40.111074 L1.18428047,40.111074 C0.621872757,40.0349481 0.101366147,40.4192012 0.0128930678,40.9758262 C-0.0755800112,41.5324512 0.300451977,42.0571546 0.859143864,42.1566585 L0.871337227,42.1566585 L0.873371192,42.1566585 L2.18611035,42.3704675 L1.58867133,43.5505606 L1.58867133,43.5505606 L1.58257986,43.5629913 C1.41341147,43.8927382 1.43429077,44.2870355 1.63735272,44.5973552 C1.84041466,44.9076749 2.19480932,45.0868721 2.56703966,45.0674449 C2.93926999,45.0480177 3.27278536,44.8329177 3.44195375,44.5031708 L4.05971292,43.3168623 L4.92945436,44.1703373 L5.00667204,44.2469936 L5.01678972,44.2573526 C5.4246366,44.6593397 6.08314704,44.6581473 6.48951415,44.2546858 C6.89588125,43.8512244 6.89703566,43.1974687 6.49209592,42.7925952 L5.54513576,41.8424711 L6.67498594,41.2634051 L6.72985086,41.2354359 L6.73996853,41.2250769 C7.07695346,41.0598698 7.29839856,40.7274994 7.31968028,40.3549784 C7.340962,39.9824575 7.15879116,39.6273607 6.84278296,39.4253856 C6.52677477,39.2234104 6.12576954,39.205773 5.79300837,39.3792133 L5.7828907,39.3895723 L4.59207892,39.9826229 L4.37464382,38.6792582 L4.37464382,38.6792582 L4.372662,38.6668274 C4.28524711,38.1701501 3.85025301,37.8081416 3.34238539,37.809416 L3.34242399,37.8067227 Z" id="Shape" fill="#FF725B"/>
                      <path d="M68.1377257,82 C66.4171961,82 65,83.4056722 65,85.1124042 C65,86.8189286 66.4171961,88.2247046 68.1377257,88.2247046 C69.8582553,88.2247046 71.2754514,86.8189286 71.2754514,85.1124042 C71.2754514,83.4056722 69.8582553,82 68.1377257,82 L68.1377257,82 Z M68.1377257,84.0748323 C68.727753,84.0748323 69.1836339,84.5270966 69.1836339,85.1124042 C69.1836339,85.6977117 68.727753,86.1497684 68.1377257,86.1497684 C67.5476984,86.1497684 67.0918175,85.6977117 67.0918175,85.1124042 C67.0918175,84.5270966 67.5476984,84.0748323 68.1377257,84.0748323 L68.1377257,84.0748323 Z" id="Shape" fill="#97A5AA"/>
                      <path d="M33.6680876,6.61013979e-05 C33.3956773,0.00451972079 33.1357584,0.114139175 32.9435777,0.305624394 L30.3274387,2.89975617 C29.9200509,3.30475607 29.9200509,3.96027363 30.3274387,4.36527353 L32.9435777,6.95919773 C33.3520278,7.36314118 34.0131275,7.36314118 34.4215777,6.95919773 L37.0377169,4.36527353 C37.4451047,3.96027363 37.4451047,3.30475607 37.0377169,2.89975617 L34.4215777,0.305624394 C34.2223004,0.107108782 33.9505484,-0.00309314576 33.6680876,6.61013979e-05 L33.6680876,6.61013979e-05 Z M33.6838956,2.50514591 L34.8194001,3.63106179 L33.6838956,4.75967621 L32.5457565,3.63106179 L33.6838956,2.50514591 L33.6838956,2.50514591 Z" id="Shape" fill="#97A5AA"/>
                      <path d="M107.321139,30.6818165 C107.048728,30.6862701 106.788809,30.7958896 106.596629,30.9873748 L103.98049,33.5815066 C103.573102,33.9865065 103.573102,34.642024 103.98049,35.0470239 L106.596629,37.6409481 C107.005079,38.0448916 107.666179,38.0448916 108.074629,37.6409481 L110.690768,35.0470239 C111.098156,34.642024 111.098156,33.9865065 110.690768,33.5815066 L108.074629,30.9873748 C107.875351,30.7888592 107.603599,30.6786573 107.321139,30.6818165 L107.321139,30.6818165 Z M107.336947,33.1868963 L108.472451,34.3128122 L107.336947,35.4414266 L106.198808,34.3128122 L107.336947,33.1868963 L107.336947,33.1868963 Z" id="Shape-Copy-3" fill="#FF725B" transform="translate(107.335629, 34.312828) rotate(12.000000) translate(-107.335629, -34.312828) "/>
                      <g id="Group-6" transform="translate(60.469846, 38.328990) rotate(-20.000000) translate(-60.469846, -38.328990) translate(28.969846, 10.828990)">
                          <rect id="Rectangle-2" stroke="#4257B2" stroke-width="2.20796928" x="1.10398464" y="8.50783079" width="52.2865461" height="44.4256847" rx="2.112"/>
                          <g id="Group-9" transform="translate(13.661017, 16.923077)" stroke="#4257B2" stroke-width="1.66922478">
                              <path d="M16.5730964,6.89582638 L20.7101324,9.01260504" id="Stroke-1" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M13.8067549,9.65636255 L19.4549728,16.7376951" id="Stroke-2" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M10.6688561,10.9438776 L11.2964358,17.3814526" id="Stroke-3" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M3.21768596,11.4578259 C5.38800557,11.4578259 7.1442149,13.2593067 7.1442149,15.4640582 C7.1442149,17.6688096 5.38800557,19.4702904 3.21768596,19.4702904 C1.04736635,19.4702904 -0.708842988,17.6688096 -0.708842988,15.4640582 C-0.708842988,13.2593067 1.04736635,11.4578259 3.21768596,11.4578259 Z" id="Stroke-14"/>
                              <path d="M25.7669771,8.80388589 C27.0244351,8.80388589 28.0377816,9.84333143 28.0377816,11.1117981 C28.0377816,12.3801347 27.0243939,13.4195392 25.7669771,13.4195392 C24.5095602,13.4195392 23.4961725,12.3801347 23.4961725,11.1117981 C23.4961725,9.84333143 24.509519,8.80388589 25.7669771,8.80388589 Z" id="Stroke-20"/>
                              <path d="M21.0239223,0.534077963 C22.0552781,0.534077963 22.8843862,1.38462462 22.8843862,2.42106774 C22.8843862,3.45739255 22.055233,4.30789458 21.0239223,4.30789458 C19.9926115,4.30789458 19.1634583,3.45739255 19.1634583,2.42106774 C19.1634583,1.38462462 19.9925664,0.534077963 21.0239223,0.534077963 Z" id="Stroke-44"/>
                              <path d="M9.95941214,-0.790752694 C12.3732689,-0.790752694 14.3276728,1.21403173 14.3276728,3.66859821 C14.3276728,6.1231647 12.3732689,8.12794912 9.95941214,8.12794912 C7.54555538,8.12794912 5.59115152,6.1231647 5.59115152,3.66859821 C5.59115152,1.21403173 7.54555538,-0.790752694 9.95941214,-0.790752694 Z" id="Stroke-26"/>
                              <path d="M11.8247639,20.5994955 C13.7515463,20.5994955 15.3095611,22.1976727 15.3095611,24.1526091 C15.3095611,26.1075455 13.7515463,27.7057228 11.8247639,27.7057228 C9.89798142,27.7057228 8.3399666,26.1075455 8.3399666,24.1526091 C8.3399666,22.1976727 9.89798142,20.5994955 11.8247639,20.5994955 Z" id="Stroke-32"/>
                              <path d="M23.3984451,18.5950141 C25.0816904,18.5950141 26.4415107,19.9898878 26.4415107,21.6950092 C26.4415107,23.4002967 25.0817345,24.7952147 23.3984451,24.7952147 C21.7151558,24.7952147 20.3553795,23.4002967 20.3553795,21.6950092 C20.3553795,19.9898878 21.7151998,18.5950141 23.3984451,18.5950141 Z" id="Stroke-38"/>
                          </g>
                          <g id="Group-8-Copy-2" transform="translate(45.186441, 0.000000)"/>
                      </g>
                  </g>
              </g>
          </g>
      </g>
    </svg>

    <h5 class="text-center mt-5"><b>Thêm hình ảnh gợi ý cho thẻ</b></h5>
    <h6 class="text-center">Dễ nhớ hơn khi có hình ảnh mô phỏng cho thẻ!</h6>
  </div>

  <div class="container container-2 mt-4">
     <div class="row bg-white shadow mt-5">
        <h3 class="text-mute mt-4 ml-5 float-left"><b>1</b></h3>
        <div class="TE float-left">
          <input type="text" class="card-small en_key" placeholder="Từ vựng.." autocomplete="off"><br>
          <span class="text-mute"><b>Tiếng Anh</b></span>
        </div>

        <label class="float-left" style="font-size: 24px; position: absolute; left: 50.9%; margin-top: 2%;" data-toggle="tooltip" data-placement="top" title="Thêm hình ảnh">
          <input type="file" name="file[]" class="inputfile img_vo remove-img" accept="image/*" onchange="readURL(this);" />
          <i class="ni ni-image"></i>
        </label>
       
        <div class="TV float-left">
          <input type="text" class="card-small vn_key" placeholder="Nghĩa.." autocomplete="off"><br>
          <span class="text-mute"><b>Tiếng Việt</b></span>
        </div>
        <div class="preview pointer preview_js">
          <i class="ni ni-fat-remove" onclick="removeFileTitle(this)"></i>
        </div>
      </div>
  </div>

  <div class="container mt-4" id="add-card">
    <button class="btn btn-primary w-100 rounded-0"><h5 class="text-white">Thêm thẻ</h5></button>
  </div>
  <button class="btn btn-primary rounded-0 mt-5 float-left mb-5" style="margin-left: 17%" id="create">Tạo</button>

<h6 id="result"></h6>
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
    <!-- Upload vocabulary -->
    <script type="text/javascript" src="../../controller/admin/create/term_update.js"></script>
    <!-- Index Js -->
    <script type="text/javascript" src="index.js"></script>
</body>
</html>
