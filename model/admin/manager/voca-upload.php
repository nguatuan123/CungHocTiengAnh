<?php
require_once("../../../connect/connect.php");
$key_done = $_POST['key_done'];
$key_press = $_POST['key_press'];
if ( empty($_FILES['file']) ) {
    if ( $_POST['id'] === 'undefined' ){
        $file_url = 'none';
        $en       = $_POST['en'];
        $vn       = $_POST['vn'];
        $name     = $_POST['name'];

        $sql      = "
            INSERT INTO `vocabulary` (`img`, `en`, `vn`, `name`)
            VALUES ('$file_url', '$en', '$vn', '$name')
            ";
        $query = mysqli_query($conn, $sql);

        if (!$query){
            echo 'error';
        }
        else {
            if( $key_done = $key_press){
                $query_id = mysqli_multi_query($conn, 'SET @s := 0; UPDATE `vocabulary` SET id = (@s := @s + 1) ORDER BY id;SET  @num := 0; UPDATE `vocabulary` SET id = @num := (@num+1); ALTER TABLE `vocabulary` AUTO_INCREMENT =1;');
                if ( !$query_id ){
                    echo 'Reset id error';
                }
                else{
                     echo '
                    <script>
                        window.location.href = "";
                    </script>';
                }
               
            }
            else{
                echo $key_press;
            }
        }
    }

    else {
        $en       = $_POST['en'];
        $vn       = $_POST['vn'];
        $name     = $_POST['name'];
        $id       = $_POST['id'];
        $sql      = "
            UPDATE `vocabulary` SET `en` = '$en', `vn` = '$vn', `name` = '$name'
            WHERE `id` = $id;
            ";
        $query = mysqli_query($conn, $sql);
        if (!$query) {
            echo 'errors';
        }
        else {
            if( $key_done = $key_press){
                $query_id = mysqli_multi_query($conn, 'SET @s := 0; UPDATE `vocabulary` SET id = (@s := @s + 1) ORDER BY id;SET  @num := 0; UPDATE `vocabulary` SET id = @num := (@num+1); ALTER TABLE `vocabulary` AUTO_INCREMENT =1;');
                if ( !$query_id ){
                    echo 'Reset id error';
                }
                else{
                    echo '
                    <script>
                        window.location.href = "";
                    </script>';
                }
            }
            else{
                echo $key_press;
            }
        }
    }
} 

else {
    if ( $_POST['id'] === 'undefined' ){
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

        if (!$query){
            echo 'error';
        }
        else {
            if( $key_done = $key_press){
                $query_id = mysqli_multi_query($conn, 'SET @s := 0; UPDATE `vocabulary` SET id = (@s := @s + 1) ORDER BY id;SET  @num := 0; UPDATE `vocabulary` SET id = @num := (@num+1); ALTER TABLE `vocabulary` AUTO_INCREMENT =1;');
                if ( !$query_id ){
                    echo 'Reset id error';
                }
                else{
                    echo '
                    <script>
                        window.location.href = "";
                    </script>';
                }
                
            }
            else{
                echo $key_press;
            }
        }
    }
    else{
        $file_url = 'package/terms/img-voca/' . $_FILES['file']['name'];
        $en       = $_POST['en'];
        $vn       = $_POST['vn'];
        $name     = $_POST['name'];
        $id       = $_POST['id'];
        $url_img_old = $_POST['url_img_old'];
        move_uploaded_file($_FILES['file']['tmp_name'], '../../../package/terms/img-voca/' . $_FILES['file']['name']);
        $sql = "
                UPDATE `vocabulary` SET `img` = '$file_url', `en` = '$en', `vn` = '$vn', `name` = '$name'
                WHERE `id` = $id;
                ";
        $query = mysqli_query($conn, $sql);
        if (!$query) {
            echo 'errors';
        }
        else {
            if( $key_done = $key_press){
                $query_id = mysqli_multi_query($conn, 'SET @s := 0; UPDATE `vocabulary` SET id = (@s := @s + 1) ORDER BY id;SET  @num := 0; UPDATE `vocabulary` SET id = @num := (@num+1); ALTER TABLE `vocabulary` AUTO_INCREMENT =1;');
                if ( !$query_id ){
                    echo 'Reset id error';
                }
                else{
                    echo '
                    <script>
                        window.location.href = "";
                    </script>';
                }
            }
            else{
                echo $key_press;
            }
        }
    }
}
?>
