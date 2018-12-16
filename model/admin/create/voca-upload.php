<?php
    require_once("../../../connect/connect.php");
    header('Content-Type: text/html; charset=UTF-8');
    $count = $_POST['count'];
    $end = $_POST['end'];
    $name     = $_POST['name'];
    if (!isset($_FILES['file'])) {
        $file_url = 'none';
        $en       = $_POST['en'];
        $vn       = $_POST['vn'];
        $name     = $_POST['name'];
        $sql      = "
                INSERT INTO `vocabulary` (`img`, `en`, `vn`, `name`)
                VALUES ('$file_url', '$en', '$vn', '$name')
                ";
        $query = mysqli_query($conn, $sql);
        if ( !$query ){
            echo 'query error';
        }
        else{
            if ($count == $end){
                echo '<script>window.location = "../my-terms"</script>';
            }
        }
    } 
    else {
        $file_url = 'package/terms/img-voca/' . $_FILES['file']['name'];
        $en       = $_POST['en'];
        $vn       = $_POST['vn'];
        $name     = $_POST['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], '../../../package/terms/img-voca/' . $_FILES['file']['name']);
        $sql = "
                INSERT INTO `vocabulary` (`img`, `en`, `vn`, `name`)
                VALUES ('$file_url', '$en', '$vn', '$name')
                ";
        $query = mysqli_query($conn, $sql);
        if ( !$query ){
            echo 'query error';
        }
        else{
            if ($count == $end){
                echo '<script>window.location = "../my-terms"</script>';
            }
        }
    }
?>