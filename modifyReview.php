<?php $conn = mysqli_connect('localhost', 'team04', 'team04', 'team04'); session_start(); ?>
<?php
	include "header.php";
?>
<?php $sql = "SELECT reviewId, rate, content, isRewatched FROM review WHERE reviewId = '".$_GET['reviewId']."'"; $res = mysqli_query($conn, $sql); ?>
<?php $row = mysqli_fetch_array($res, MYSQLI_ASSOC); ?> 
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/e2a053a10f.js" crossorigin="anonymous"></script>
  </head>

  <body>
        
    <div class=writeBoard>
      <form class="writeForm" action="processReview.php?mode=update" method="POST">
        <h2>[Movie] <?php echo $_GET['movieTitle'] ?></h2>
        <input type="hidden" name="reviewId", value="<?php echo $_GET['reviewId'] ?>">
        Rating: 
        <select class="opt", id='opt_star', name="rate">
          <option value=<?php echo $row['rate'] ?> selected='selected'><?php $cnt_stars=$row['rate']; while ($cnt_stars>0) {
              echo '&#xf005&nbsp;'; $cnt_stars--; } ?> </option>
          <option value=5> &#xf005 &#xf005 &#xf005 &#xf005 &#xf005 </option>
          <option value=4> &#xf005 &#xf005 &#xf005 &#xf005 </option>
          <option value=3> &#xf005 &#xf005 &#xf005 </option>
          <option value=2> &#xf005 &#xf005 </option>
          <option value=1> &#xf005 </option>
        </select>
        &nbsp;&nbsp;&nbsp;Rewatch: 
        <select class="opt", name="isRewatched">
          <option value=<?php echo $row['isRewatched'] ?> selected><?php if ($row['isRewatched'] == 0) { ?><td width="50"><?php echo 'No'; ?></td> <?php } else { ?> <td width="50"><?php echo 'Yes'; } ?></td></option>
          <option value=0> No </option>
          <option value=1> Yes </option>
        </select>      
        <div class="contentArea">
            <textarea name="content" class="content" required><?php echo $row['content'] ?></textarea>
        </div>
        <input type="submit" value="Rewrite" class="btn_c">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" value="Cancle" class="btn_c" onclick="history.back(1)">
        </div>
      </form>
    </div>
    <?php mysqli_close($conn);?>
  </body>
</html>