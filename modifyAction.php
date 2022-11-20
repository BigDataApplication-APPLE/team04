<?php

    $commentId = $_POST['commentId'];
    $movieId = $_POST['movieId'];
    $content = $_POST['content'];
    $mysqli = mysqli_connect('localhost', 'team04', 'team04', 'team04');
    $sql = "update comment set content='".addslashes($content)."' where commentId='".$commentId."'";


    $res = mysqli_query($mysqli, $sql);

    if($res) {


      echo "<script>window.location.replace('commentBoard.php?movieId=$movieId');
      </script>";


    } else {
        echo mysqli_error($mysqli);
    }
?>
