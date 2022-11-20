<?php
    session_start();
    //로그인 아이디 가져오기
    $login_id = $_SESSION['ses_userId'];
    $content = $_POST['content'];
    $movieId = $_POST['movieId'];
    $mysqli = mysqli_connect('localhost', 'team04', 'team04', 'team04');
    $sql = "INSERT INTO comment(userId, movieId, writeDate, content) VALUES ('$login_id', '$movieId', curdate(), '$content');";

    $res = mysqli_query($mysqli, $sql);

    if($res) {


      echo "<script>window.location.replace('commentBoard.php?movieId=$movieId');
      </script>";


    } else {
        echo mysqli_error($mysqli);
    }
?>
