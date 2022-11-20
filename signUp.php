<?php
    header('Content-Type: text/html; charset=utf-8');
    $mysqli = mysqli_connect('localhost', 'team04', 'team04', 'team04');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];

    //요소 채워져 있는지 확인
    if(($username == '')||($password == '')||($age == '')){
        echo "<script>alert('Please fill in all the details');
        history.back();</script>";
    } 
    else{ //다 채웠으면
        $query = "SELECT * FROM User WHERE id = '{$username}'";
        $result=mysqli_query($mysqli,$query);
        if(mysqli_num_rows($result)!=0){//아이디 중복 확인
            echo "<script>alert('Username already exists. Please change it.');
            history.back();</script>";
        }
        else{//사용할 수 있는 아이디 -> 유저 정보 저장
            $query = "insert into User (id, pw, userAge, userSex) values('$username','$password','$age','$sex')";
            $result = mysqli_query($mysqli, $query);
            if($result){
                echo "<script>alert('User Registration Successful');
                location.href='login.html'; </script>";
            }
    }
    }
?>