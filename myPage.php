<?php
	include "header.php";
?>

<?php
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    $mysqli = mysqli_connect('localhost', 'team04', 'team04', 'team04');
    $ses_userId = $_SESSION['ses_userId'];
    $ses_id = $_SESSION['ses_id'];
    $ses_pw = $_SESSION['ses_pw'];
    $ses_age = $_SESSION['ses_age']; 
    $ses_sex = $_SESSION['ses_sex'];

    if($ses_id == ''){
        echo"<script>alert('INVALID ACCESS');
            history.back();
            </script>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>myPage</title>
        <link rel="stylesheet" href="myPage.css">
    </head>
    <body>
        <div class="container">

            <?php
            $query = "
            SELECT distinct movieId
            FROM Review
            WHERE userId = '$ses_userId'";

            $result = mysqli_query($mysqli, $query);
            $movie = 0;
            if(mysqli_num_rows($result) >= 1 ){
                while($data = mysqli_fetch_array($result)){
                    $movie += 1;
                }
            }
            ?>

            <div id="myMovie">
                <span class="menu">Information</span><br>
            </div> 
            <div id="info_pic">
                <?php 
                if($ses_sex=='m'){ ?>
                    <img src="./data/image/man.png" style="height:200px; margin-left:30px">
                <?php }
                else{
                    ?>
                    <img src="./data/image/woman.png" style="height:200px; margin-left:30px">
                <?php }
                ?>
            </div>
            <div id="info_text">
                <div style="border-radius: 15px; border:2px solid #F26C6C; padding: 30px 20px;">
                    <span style="font-size: 20px; padding-left: 5px; color:#8D8D8D;">[USERNAME]  </span><span style="font-size: 20px; padding-left: 5px; color:#F26C6C;"><?php echo $ses_id?></span><br>
                    <span style="font-size: 20px; padding-left: 5px; color:#8D8D8D;">[AGE]  </span><span style="font-size: 20px; padding-left: 5px; color:#F26C6C;"><?php echo $ses_age?></span><br>
                    <span style="font-size: 20px; padding-left: 5px; color:#8D8D8D;">[SEX]  </span><span style="font-size: 20px; padding-left: 5px; color:#F26C6C;"><?php if($ses_sex=='m'){echo 'Man';} else{echo 'Woman';}?></span><br>
                    <span style="font-size: 20px; padding-left: 5px; color:#8D8D8D;">[Number of movies to watch]  </span><span style="font-size: 20px; padding-left: 5px; color:#F26C6C;"><?php if($movie){echo $movie;} else{echo 0;} ?></span>
                </div>
            </div>

        
            <div id="myReview" class="menu">
                <span>My Review</span>
            </div>
            <!-- href = "리뷰페이지" -->
            <div id="more">  
                <span><a href="myReviewPage.php" style="text-decoration: none; ">more></a></span>
            </div>
            
            <div id="review">
            <?php
            $query = "
            SELECT movieTitle , rate, content, watchDate
            FROM Review as r, movie_detail as md
            WHERE r.movieId = md.movieId AND userId = '$ses_userId'
            ORDER BY watchDate DESC
            LIMIT 3";

            $result = mysqli_query($mysqli, $query);
            if(mysqli_num_rows($result)>0){
                while($newArray = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    ?>
                    <div class="box">
                    <div class="movieTitle" style="display:inline-block;">[<?php echo $newArray['movieTitle']; ?>]</div>
                    <div class="movieTitle" style="display:inline-block;"><?php echo $newArray['content']; ?></div> <br>
                    <div class="sub" style="display:inline-block; margin-right:30px;"><?php echo $newArray['watchDate']; ?></div><div class="sub" style="display:inline-block;">Rate: <?php echo $newArray['rate']; ?>/5</div>
                    </div>
            <?php
                }
            }
            else{
                ?>
                    <div class="box">
                    <div class="sub" style="margin-right:30px; text-align: center; margin-top:20px;">No reviews have been registered yet.</div>
                    </div>
            <?php }
            ?>
            </div>

            <div id="accountSettings">
                <span class="menu">Account Settings</span><br>
                <form action="updatePW.php" method="post">
                    <span style="font-size: 24px; padding-left: 5px;">Change Password</span>
                    <div id="newpassword">
                        <input class="input-box" type="password" name="newpassword" size="12" minlength="8" maxlength="12" placeholder="Enter new password">
                        <input class="submit-btn" type="submit" name="changePW" value="CHANGE" class="submit-btn">
                    </div> 
                </form>

                <form style="margin-top: 10px;" action="deleteUser.php" method="post">
                    <span style="font-size: 24px; padding-left: 5px;">Delete Account</span>
                    <div id="deleteAccount">
                        <input class="input-box" type="text" name="username" size="12" minlength="4" maxlength="12" placeholder="Enter username">
                        <input class="input-box" type="password" name="password" size="12" minlength="8" maxlength="12" placeholder="Enter password">
                        <input class="submit-btn" type="submit" name="deleteAccount" value="DELETE" class="submit-btn">
                    </div>
                </form>
            </div>

        </div>
    </body>
</html>