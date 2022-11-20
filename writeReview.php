<?php $conn = mysqli_connect('localhost', 'team04', 'team04', 'team04'); session_start(); ?>
<?php
	include "header.php";
?>
<?php 
  $sql = '
    SELECT movieId
    FROM movie_detail
    WHERE movieTitle="'.$_GET['title'].'"';
  $res = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    $movieId = $row['movieId'];
  }
?>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/e2a053a10f.js" crossorigin="anonymous"></script>
  </head>

  <body>
    <div class=writeBoard>
      <form class="writeForm" action="processReview.php?mode=write" method="POST">
        <h2>[Movie] <?php echo $_GET['title']; ?></h2>
        <input type="hidden" name="movieTitle", value="<?php echo $_GET['title'] ?>">
        <input type="hidden" name="movieId", value="<?php echo $movieId; ?>">
        Rating: 
        <select class="opt", id='opt_star', name="rate">
          <option value=5> &#xf005 &#xf005 &#xf005 &#xf005 &#xf005 </option>
          <option value=4> &#xf005 &#xf005 &#xf005 &#xf005 </option>
          <option value=3> &#xf005 &#xf005 &#xf005 </option>
          <option value=2> &#xf005 &#xf005 </option>
          <option value=1> &#xf005 </option>
        </select>
        &nbsp;&nbsp;&nbsp;Rewatch: 
        <select class="opt", name="isRewatched">
          <option value=0> No </option>
          <option value=1> Yes </option>
        </select>        
        <div class="contentArea">
            <textarea name="content" class="content" placeholder="Comment"></textarea>
        </div>
        <input type="submit" value="Write" class="btn_c">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" value="Cancle" class="btn_c" onclick="history.back()">
        </div>
      </form>
    </div>
    <?php mysqli_close($conn);?>
  </body>
</html>