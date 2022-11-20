<?php
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    $mysqli = mysqli_connect("localhost", "team04", "team04", "team04");
    if (mysqli_connect_error()) {
        exit();
    }
    else{
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query="select * from User where id='$username' and pw='$password'";
        $result=mysqli_query($mysqli,$query);
        $userInfo=mysqli_fetch_array($result);
        if($userInfo != null){
            $_SESSION['ses_userId'] = $userInfo['userId'];
            $_SESSION['ses_id'] = $userInfo['id'];
            $_SESSION['ses_pw'] = $userInfo['pw'];
            $_SESSION['ses_age'] = $userInfo['userAge'];
            $_SESSION['ses_sex'] = $userInfo['userSex'];
            echo "<script>alert('로그인 성공');
            location.href='myPage.php';//메인페이지 주소 넣기
            </script>";
        }else{
            echo"<script>alert('Please Try Again');
            history.back();
            </script>";
        }
    }
?>

