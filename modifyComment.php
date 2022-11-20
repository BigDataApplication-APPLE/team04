<?php
    $commentId = $_GET['commentId'];
    $movieId = $_GET['movieId'];
    $mysqli = mysqli_connect('localhost', 'team04', 'team04', 'team04');
    $sql = "SELECT * FROM comment where commentId='".$commentId."'";

    $res = mysqli_query($mysqli, $sql);

    $row = null;
    if($res) {
      $row = mysqli_fetch_array($res);
    }

    include "header.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Write Comment</title>
    <link rel="stylesheet" href="write.css?after&1">
    <style>
      .review {
        max-width: 800px;
        margin: 0px auto;
      }
    </style>
    <script>

      function deleteBoard() {
        event.stopPropagation();
        event.preventDefault();

        if(!confirm("Are you sure you want to delete?")) {
          return false;
        }
        location.href = "deleteAction.php?movieId=<?=$movieId?>&commentId=<?=$commentId?>";
      }
    </script>
</head>
<body style="margin:0px">
        <div class="review">
            <div class="writeTitle">Modify Comment</div>
            <form class="writeForm" name="writeForm" action="modifyAction.php" method="post">
                <input type=hidden name=commentId value="<?=$commentId?>">
                <input type=hidden name=movieId value="<?=$movieId?>">
                <textarea class="writeTextarea" name="content" placeholder="Write your movie comment"  required><?=$row["content"]?></textarea>
                <div class="writeBtn">
                <input type="submit" value="Write" class="submitbtn"> &nbsp;
                <input type="button" value="Cancel" class="submitbtn" onclick="event.stopPropagation(); event.preventDefault(); history.back(1)"> &nbsp;
                <input type="button" value="Delete" class="submitbtn" onclick="deleteBoard();">
                </div>
            </form>
        </div>
</body>
</html>
