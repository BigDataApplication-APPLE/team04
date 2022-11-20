<?php
    $movieId = $_GET['movieId'];
    $commentId = $_GET['commentId'];
    $mysqli = mysqli_connect('localhost', 'team04', 'team04', 'team04');
    $sql = "delete from comment where commentId='".$commentId."'";


    $res = mysqli_query($mysqli, $sql);

    if($res) {


      echo "<script>alert('Successfully Deleted');window.location.replace('commentBoard.php?movieId=$movieId');
      </script>";


    } else {
        echo mysqli_error($mysqli);
    }
?>
