<!DOCTYPE html>
<?php
  session_start();
  error_reporting(E_ERROR);
  //$login_id = $_SESSION["LOGIN_ID"];    //로그인 세션 값으로 받기
  $login_id = $_SESSION['ses_userId'];  // 현재 임의로 로그인

  $movieId = "";
  if(isset($_GET["movieId"])) {
    $movieId = $_GET["movieId"];
  }

include "showMovietitle.php";
include "header.php";

?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="write.css?after&1">
    <title>Show review</title>
    <style>
      .board {
        width: 100%;
        margin-top: 0px;
      }

      .commentboard {
        max-width: 1000px;
      }
    </style>
</head>
<body style="margin:0px">
  <p><center><h1><?=get_movie_title($movieId)?></h1></center></p>

   <div class="commentboard">
    <table class=board>
        <thead>
            <tr align=center>
                <th width=300>Comment</th>
                <th width=200>User ID</th>
                <th width=120>Date</th>
            </tr>
       </thead>

   <?php
          $mysqli = mysqli_connect('localhost', 'team04', 'team04', 'team04');

          $where = "";
          if($movieId) {
            $where = " where movieId='$movieId' ";
          }

          $sql = "SELECT * FROM comment $where ORDER BY commentId ASC";

          $res = mysqli_query($mysqli, $sql);

          if(mysqli_num_rows($res) == 0) {
            ?>
            <tr align=center>
                <td colspan=3>No Data</td>
            </tr>
            <?php
          }
          else {
            while($row = mysqli_fetch_array($res)){
              $isLogin = false;
              if($login_id == $row['userId']) {
                $isLogin = true;
              }
        ?>
            <tbody>
                <tr align=center>

                    <td><?php echo $row['content'];?></a><?php
                      if($isLogin) {
                        ?>
                          <a style='cursor:pointer' onclick='location.href="modifyComment.php?movieId=<?=$movieId?>&commentId=<?=$row['commentId']?>"'>[수정]</a>
                          <a style='cursor:pointer' onclick="if(!confirm('Are you sure you want to delete?')) return; location.href='deleteAction.php?movieId=<?=$movieId?>&commentId=<?=$row['commentId']?>'">[삭제]</a>
                        <?php
                      }
                    ?></td>
                    <td><?php echo $row['userId'];?></a></td>
                    <td><?php echo $row['writeDate'];?></td>
                </tr>
            </tbody>
        <?php
            }
          }
          ?>
  </table>
  <div style="text-align:right; display:inline-block; width:100%">
    <button class=write_btn onclick="window.location.href='writeComment.php?movieId=<?=$movieId?>'">Write</button>
  </div>
</div>
</body>
</html>
