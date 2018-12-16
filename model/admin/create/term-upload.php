<?php
    require_once("../../../connect/connect.php");
    $name     = $_POST['name'];
    $file_url = 'package/terms/img/' . $_FILES['file']['name'];
    $arrUsername = array( $_POST['username'] );
    $date     = $_POST['date'];
    move_uploaded_file($_FILES['file']['tmp_name'], '../../../package/terms/img/' . $_FILES['file']['name']);

    $check_query = mysqli_query($conn, 'SELECT `name`, `id` FROM `term-voca` WHERE `name` = "'.$name.'"');
    if( mysqli_num_rows($check_query) === 0  ){
        $strUsername = serialize( $arrUsername );
        $sql = "
                INSERT INTO `term-voca` (`name`, `img`, `username`, `date`)
                VALUES ('$name', '$file_url', '$strUsername', '$date')
                ";
        $query = mysqli_query($conn, $sql);
        if ( !$query ){
            echo 'query error';
        }
        else{
            echo 0;
        }
    }
    else{
        $row = mysqli_fetch_assoc($check_query);
        $id = $row['id'];
        echo '
            <script>$("#modal-default").modal("show");$("#goto_url").attr("href", "../../terms/flash-card/?id='.$id.'"); $("#load-circle").hide();</script>
        ';
    }
?>