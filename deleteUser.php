<?php
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    $mysqli = mysqli_connect('localhost', 'team04', 'team04', 'team04');
    
    //로그인한 유저 정보 받아오기
    $ses_id = $_SESSION['ses_id'];
    $ses_pw = $_SESSION['ses_pw'];
    $ses_age = $_SESSION['ses_age']; 
    $ses_sex = $_SESSION['ses_sex'];
    
    //입력한 username&pw 정확한지 확인
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(($username != $ses_id)&&($password != $ses_pw)){
        echo "<script>alert('Please check username and password');
        history.back();
        </script>";
    }
    //UserInfo 테이블에서 해당 유저 삭제
    else{
        $query = "DELETE from User WHERE id = '$username'";
        mysqli_query($mysqli, $query); 
        session_destroy();
        echo "<script>alert('Account Delete Successful');
        location.href='login.html';</script>";
    }
?>
