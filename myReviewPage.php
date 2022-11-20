<?php $conn = mysqli_connect('localhost', 'team04', 'team04', 'team04'); session_start(); ?>
<?php
	include "header.php";
?>

<html>
  <head>
    <meta charset="UTF-8">
    <title>MyReviews</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/e2a053a10f.js" crossorigin="anonymous"></script>
  </head>
  <body>

    <div id="myReviewArea">             
      <h1>My Reviews</h1>
      <?php if (!isset($_POST['mrOpt'])) $_POST['mrOpt']='date'; ?>

      <div class="orderOption">
        <form action="myReviewPage.php" method=POST>
            <p> Order Option : <?php if ($_POST['mrOpt']=='date') echo 'Lastest'; else if ($_POST['mrOpt']=='rating') echo 'Rating'; ?> </p>
            <select class="opt", name="mrOpt">
                <option value='date'> Latest Order </option>
                <option value='rating'> Rating Order </option>
            </select>
            <input type=submit value="Reorder" class="btn">
        </form>
      </div>

      <table class="myReview-list">
        <thead>
          <tr>
              <th width="200">Movie Title</th>
              <th width="100">Rating</th>
              <th width="500">Content</th>
              <th width="100">Date</th>
              <th width="50">Rewatch</th>
              <th width="50">Modify</th>
              <th width="50">Delete</th>
          </tr>
        </thead>
        <?php
          $sql_date = "
            SELECT movieTitle as title, rate as rating, content, watchDate as date, isRewatched as rewatch, r.movieId, reviewId
            FROM Review as r, movie_detail as md
            WHERE r.movieId = md.movieId AND userId = '".$_SESSION["ses_userId"]."'
            ORDER BY date DESC
            LIMIT 20
            ";
          $sql_rating = "
            SELECT movieTitle as title, rate as rating, content, watchDate as date, isRewatched as rewatch, r.movieId, reviewId
            FROM Review as r, movie_detail as md
            WHERE r.movieId = md.movieId AND userId = '".$_SESSION["ses_userId"]."'
            ORDER BY rating DESC
            LIMIT 20
            ";
          if ($_POST['mrOpt'] == 'date') {
            $res = mysqli_query($conn, $sql_date);
          }
          else if ($_POST['mrOpt'] == 'rating') {
            $res = mysqli_query($conn, $sql_rating);
          }
          if (mysqli_num_rows($res)>0) {        
            while ($mr = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        ?>
        <tbody class="myReview-info">
          <tr>
            <td id="mrTitle", width="200"><?php echo $mr['title']; ?></td>
            <td id="mrStar", width="100">
            <?php
            while ($mr['rating']>0) {
              echo '<i class="fa-solid fa-star"></i>';
              $mr['rating']--;
            }
            ?>
            </td>
            <td id="mrContent", width="500"><?php echo $mr['content'] ?></td>
            <td width="100"><?php echo $mr['date']; ?></td>
            <?php
            if ($mr['rewatch'] == 0) { ?>
              <td width="50"><?php echo 'X'; ?></td>
            <?php } else { ?>
            <td width="50"><?php echo 'O'; } ?></td>
            <td width="50"><a href="modifyReview.php?movieTitle=<?php echo $mr['title']; ?>&reviewId=<?php echo $mr['reviewId']; ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
            <td width="50"><a href="processReview.php?mode=delete&reviewId=<?php echo $mr['reviewId']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>

            
          </tr>          
        </tbody>
        <?php } }?>              
      </table>
  </div>
</body>
</html>