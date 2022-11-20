<?php
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    $mysqli = mysqli_connect('localhost', 'team04', 'team04', 'team04');
    
    //로그인중인 유저 정보 받아오기
    $ses_id = $_SESSION['ses_id'];
    $ses_pw = $_SESSION['ses_pw'];
    $ses_age = $_SESSION['ses_age']; 
    $ses_sex = $_SESSION['ses_sex'];
    
    //새로 입력한 비밀번호 받아오기
    $newpassword = $_POST['newpassword'];
    
    //UserInfo 테이블 update
    $query = "UPDATE User set pw ='$newpassword' where id = '$ses_id'";
    mysqli_query($mysqli, $query); 
    
    //session pw값 update
    $_SESSION['ses_pw'] = $newpassword;

    //성공 alert, 마이페이지 이동
    echo"<script>alert('Password Change Successful');
    location.href='myPage.php';</script>";
?>