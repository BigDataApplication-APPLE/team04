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

    <div id="rankingArea">             
      <h1>Ranking Board</h1>
      <?php
        if (!isset($_POST['rankingOpt'])) $_POST['rankingOpt']='budget';
        if (!isset($_POST['sortOpt'])) $_POST['sortOpt']='desc';
      ?>

      <div class="rankingOption">
        <form action="rankingPage.php" method=POST>
            <p>
              <?php if ($_POST['rankingOpt']=='budget') echo 'Movie Budget'; else if ($_POST['rankingOpt']=='revenue') echo 'Movie Gross'; else if ($_POST['rankingOpt']=='studio') echo 'Film Distributor Revenue'; ?> in
              <?php if ($_POST['sortOpt']=='desc') echo 'Descending'; else if ($_POST['sortOpt']=='asc') echo 'Ascending'; ?> order
            </p>
            <select class="opt", name="rankingOpt">
              <option value='budget'> Movie Budget </option>
              <option value='revenue'> Movie Gross </option>
              <option value='studio'> Distributor Revenue </option>
            </select>
            <select class="opt", name="sortOpt">
              <option value='desc'> Descending </option>
              <option value='asc'> Ascending </option>
            </select>
            <input type=submit value="Show" class="btn">
        </form>
      </div>

      <table class="ranking-list">
        <thead>
            <tr>
              <th width="50">Rank</th>
              <th width="200"><?php if ($_POST['rankingOpt']=='studio') echo 'Studio'; else echo 'Movie Title'; ?></th>
              <th width="200"><?php if ($_POST['rankingOpt']=='budget') echo 'Movie Budget'; else if ($_POST['rankingOpt']=='revenue') echo 'Movie Gross'; else if ($_POST['rankingOpt']=='studio') echo 'Distributor Revenue'; ?></th>
              <?php if ($_POST['rankingOpt']!='studio') { ?><th width="70">Detail</th> <?php } ?>
            </tr>
          </thead>
        <?php
          $sql_budget_desc = "
            SELECT RANK() OVER(ORDER BY budget DESC) AS ranking, movieTitle as title, budget
            FROM movie_detail
            LIMIT 20
            ";
          $sql_budget_asc = "
            SELECT RANK() OVER(ORDER BY budget ASC) AS ranking, movieTitle as title, budget
            FROM movie_detail
            LIMIT 20
            ";
          $sql_profit_desc = "
            SELECT RANK() OVER(ORDER BY revenue DESC) AS ranking, movieTitle as title, revenue
            FROM movie_detail
            LIMIT 20
            ";
          $sql_profit_asc = "
            SELECT RANK() OVER(ORDER BY revenue ASC) AS ranking, movieTitle as title, revenue
            FROM movie_detail
            LIMIT 20
            ";
           $sql_studio_desc = "
            SELECT RANK() OVER(ORDER BY sales DESC) AS ranking, studioName as studio, sales
            FROM Studio
            LIMIT 20
            ";
          $sql_studio_asc = "
            SELECT RANK() OVER(ORDER BY sales ASC) AS ranking, studioName as studio, sales
            FROM Studio
            LIMIT 20
            ";
          if ($_POST['rankingOpt'] == 'budget' && $_POST['sortOpt'] == 'desc') {
            $res = mysqli_query($conn, $sql_budget_desc);
          }
          else if ($_POST['rankingOpt'] == 'budget' && $_POST['sortOpt'] == 'asc') {
            $res = mysqli_query($conn, $sql_budget_asc);
          }
          else if ($_POST['rankingOpt'] == 'revenue' && $_POST['sortOpt'] == 'desc') {
            $res = mysqli_query($conn, $sql_profit_desc);
          }
          else if ($_POST['rankingOpt'] == 'revenue' && $_POST['sortOpt'] == 'asc') {
            $res = mysqli_query($conn, $sql_profit_asc);
          }
          else if ($_POST['rankingOpt'] == 'studio' && $_POST['sortOpt'] == 'desc') {
            $res = mysqli_query($conn, $sql_studio_desc);
          }
          else if ($_POST['rankingOpt'] == 'studio' && $_POST['sortOpt'] == 'asc') {
            $res = mysqli_query($conn, $sql_studio_asc);
          }
          if (mysqli_num_rows($res)>0) {        
            while ($ranking = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        ?>
        <tbody class="ranking-info">
          <tr>
            <td id="rRank"><?php echo $ranking['ranking']; ?></td>
            <td id="rTitle">
              <?php 
                if ($_POST['rankingOpt']=='studio')
                  echo $ranking['studio'];
                else
                  echo $ranking['title'];
              ?></td>
            <td id="rInfo">
              <?php 
                if ($_POST['rankingOpt']=='budget') echo number_format($ranking['budget']).' &#8361';
                else if ($_POST['rankingOpt']=='revenue') echo number_format($ranking['revenue']).' &#8361';
                else if ($_POST['rankingOpt']=='studio') echo number_format($ranking['sales']).' &#8361'; ?></td>
            <?php if ($_POST['rankingOpt']!='studio') { ?>
              <td id="rLink"><a href="movie_detail.php?title=<?php echo $ranking['title']; ?>"> <i class="fa-solid fa-circle-info"></i></a></td>
              <?php }?>
          </tr>          
        </tbody>
        <?php } }?>              
      </table>
  </div>
</body>
</html>