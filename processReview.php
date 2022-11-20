<?php
    $conn = mysqli_connect('localhost', 'team04', 'team04', 'team04');
    session_start();
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n",mysqli_connect_error());
        exit();
    } 
    switch($_GET['mode']){
        case 'write':
            $sql = "
            INSERT INTO Review (reviewId, watchDate, rate, content,  isRewatched, userId, movieId)
            VALUES (null, date_format(now(), '%Y-%m-%d'), '".$_POST['rate']."', '".$_POST['content']."', '".$_POST['isRewatched']."', '".$_SESSION['ses_userId']."', '".$_POST['movieId']."')
            ";
            $res = mysqli_query($conn, $sql);
            break;
        case 'update':
            $reviewId = $_POST['reviewId'];
            $sql = "
                UPDATE Review
                SET rate = '".$_POST['rate']."', content = '".$_POST['content']."', isRewatched = '".$_POST['isRewatched']."'
                WHERE reviewId='".$_POST['reviewId']."'
            ";
            $res = mysqli_query($conn, $sql);
            break;
        case 'delete':
            $sql = "
                DELETE FROM Review
                WHERE reviewId='".$_GET['reviewId']."'
            ";
            $res = mysqli_query($conn, $sql);
            break;
    }
    mysqli_close($conn);
?>
<script>location.replace("myReviewPage.php");</script>