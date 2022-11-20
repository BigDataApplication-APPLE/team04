<?php
include "header.php";
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>write Review</title>
    <link rel="stylesheet" href="write.css?after&1">
    <style>
      .review {
        max-width: 800px;
        margin: 0px auto;
      }
    </style>
</head>
<body style="margin:0px">
        <div class="review">
            <div class="writeTitle">Write Comment</div>
            <form class="writeForm" action="writeAction.php" method="post">
                <input type="hidden" name="movieId" value="<?=$_GET['movieId']?>">
                <textarea class="writeTextarea" name="content" placeholder="Write your movie comment"  required></textarea>
                <div class="writeBtn">
                <input type="submit" value="Write" class="submitbtn"> &nbsp;
                <input type="button" value="Cancel" class="submitbtn" onclick="history.back(1)">
                </div>
            </form>
        </div>
</body>
</html>
