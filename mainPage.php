<?php $conn = mysqli_connect('localhost', 'team04', 'team04', 'team04'); session_start(); ?>
<?php
	include "header.php";
?>
<?php 
  $sql1 = "
    SELECT AVG(budget) as avg_budget, AVG(revenue) as avg_revenue
    FROM movie_detail
    ";
  $res1 = mysqli_query($conn, $sql1);
  while ($row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC)) {
    $avg_budget = (INT)$row1['avg_budget'];
    $avg_gross = (INT)$row1['avg_revenue'];
  }
?>
<?php 
  $sql2_1 = "
    SELECT movieTitle as title, Count(r.movieId) as cnt
    FROM review as r, movie_detail as md, User as u
    WHERE r.movieId = md.movieId AND r.userId = u.userId AND u.userAge BETWEEN 10 AND 19
    GROUP BY title
    ORDER BY cnt DESC
    LIMIT 3
    ";
  $res2_1 = mysqli_query($conn, $sql2_1);
  $sql2_2 = "
    SELECT movieTitle as title, Count(r.movieId) as cnt
    FROM Review as r, movie_detail as md, User as u
    WHERE r.movieId = md.movieId AND r.userId = u.userId AND u.userAge BETWEEN 20 AND 29
    GROUP BY title
    ORDER BY cnt DESC
    LIMIT 3
    ";
  $res2_2 = mysqli_query($conn, $sql2_2);
  $sql2_3 = "
    SELECT movieTitle as title, Count(r.movieId) as cnt
    FROM Review as r, movie_detail as md, User as u
    WHERE r.movieId = md.movieId AND r.userId = u.userId AND u.userAge BETWEEN 30 AND 39
    GROUP BY title
    ORDER BY cnt DESC
    LIMIT 3
    ";
  $res2_3 = mysqli_query($conn, $sql2_3);
  $sql2_4 = "
    SELECT movieTitle as title, Count(r.movieId) as cnt
    FROM Review as r, movie_detail as md, User as u
    WHERE r.movieId = md.movieId AND r.userId = u.userId AND u.userAge BETWEEN 40 AND 49
    GROUP BY title
    ORDER BY cnt DESC
    LIMIT 3
    ";
  $res2_4 = mysqli_query($conn, $sql2_4);
  $sql2_5 = "
    SELECT movieTitle as title, Count(r.movieId) as cnt
    FROM Review as r, movie_detail as md, User as u
    WHERE r.movieId = md.movieId AND r.userId = u.userId AND u.userAge BETWEEN 50 AND 59
    GROUP BY title
    ORDER BY cnt DESC
    LIMIT 3
    ";
  $res2_5 = mysqli_query($conn, $sql2_5);
  $sql2_6 = "
    SELECT movieTitle as title, Count(r.movieId) as cnt
    FROM Review as r, movie_detail as md, User as u
    WHERE r.movieId = md.movieId AND r.userId = u.userId AND u.userAge >= 60
    GROUP BY title
    ORDER BY cnt DESC
    LIMIT 3
    ";
    $res2_6 = mysqli_query($conn, $sql2_6);
?>
<?php $sql3 = "SELECT movieTitle as title, budget, revenue FROM movie_detail ORDER BY (revenue/budget) DESC LIMIT 10"; $res3 = mysqli_query($conn, $sql3); ?>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://kit.fontawesome.com/e2a053a10f.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.load("current", {'packages':["corechart"]});

      google.charts.setOnLoadCallback(drawChart2); // chart2
      google.charts.setOnLoadCallback(drawStuff3); // chart3

      function drawChart2() {
        var data2 = google.visualization.arrayToDataTable([
          ['Movie Title', 'Reviews', { role: "style" }],
          <?php while ($row2_1 = mysqli_fetch_array($res2_1, MYSQLI_ASSOC)) { ?> ['<?php echo $row2_1['title']; ?>', <?php echo $row2_1['cnt']; ?>, "#4285F4"], <?php } ?>
          <?php while ($row2_2 = mysqli_fetch_array($res2_2, MYSQLI_ASSOC)) { ?> ['<?php echo $row2_2['title']; ?>', <?php echo $row2_2['cnt']; ?>, "#DB4437"],<?php } ?>
          <?php while ($row2_3 = mysqli_fetch_array($res2_3, MYSQLI_ASSOC)) { ?> ['<?php echo $row2_3['title']; ?>', <?php echo $row2_3['cnt']; ?>, "#F4B400"], <?php } ?>
          <?php while ($row2_4 = mysqli_fetch_array($res2_4, MYSQLI_ASSOC)) { ?> ['<?php echo $row2_4['title']; ?>', <?php echo $row2_4['cnt']; ?>, "#0F9D58"],<?php } ?>
          <?php while ($row2_5 = mysqli_fetch_array($res2_5, MYSQLI_ASSOC)) { ?> ['<?php echo $row2_5['title']; ?>', <?php echo $row2_5['cnt']; ?>, "#AB47BC"], <?php } ?>
          <?php while ($row2_6 = mysqli_fetch_array($res2_6, MYSQLI_ASSOC)) { ?> ['<?php echo $row2_6['title']; ?>', <?php echo $row2_6['cnt']; ?>, "#00ACC1"], <?php } ?>
        ]);
        var view = new google.visualization.DataView(data2);
        view.setColumns([0, 1, { calc: "stringify", sourceColumn: 1, type: "string", role: "annotation" }, 2]);
        var options = {
            title: "Most Reviewed Movies by Age",
            width: 1060,
            height: 700,
            bar: {groupWidth: "55%"},
            legend: { position: "none" },
        };
        var chart2 = new google.visualization.BarChart(document.getElementById("chart2"));
        chart2.draw(view, options);
      };
    
      function drawStuff3() {
        var data3 = new google.visualization.arrayToDataTable([
            ['Title', 'Budget', 'Gross'],
            <?php while ($row3 = mysqli_fetch_array($res3, MYSQLI_ASSOC)) { ?>
            ['<?php echo $row3['title']; ?>', <?php echo $row3['budget']; ?>, <?php echo $row3['revenue']; ?>], <?php } ?> ]);

        var options = {
          width: 1060,
          height: 700,
          chart: {
            title: 'Most Profitable Movies',
            subtitle: 'Gross/Budget'
          },
          bars: 'horizontal',
          series: {
            0: { axis: 'Gross' }, 
            1: { axis: 'Gross' }
          },
          axes: {
            x: {
              profit: {label: '$million'},
              budget: {side: 'top', label: 'millions'}
            }
          }
        };

      var chart3 = new google.charts.Bar(document.getElementById('chart3'));
      chart3.draw(data3, options);
      };

    </script>
  </head>

  <body>
     
  <div class="graph_sty2"><div id="chart3"></div> </div>  

  <div class="graph_sty3">
        <i style="color: #4285F4;", class="fas fa-square">&nbsp;10s&nbsp;&nbsp;</i> 
        <i style="color: #DB4437;", class="fas fa-square">&nbsp;20s&nbsp;&nbsp;</i>
        <i style="color: #F4B400;", class="fas fa-square">&nbsp;30s&nbsp;&nbsp;</i>  
        <i style="color: #0F9D58;", class="fas fa-square">&nbsp;40s&nbsp;&nbsp;</i>  
        <i style="color: #AB47BC;", class="fas fa-square">&nbsp;50s&nbsp;&nbsp;</i>  
        <i style="color: #00ACC1;", class="fas fa-square">&nbsp;over 60s&nbsp;&nbsp;</i> 
      <div id="chart2"></div> </div>  

</body>
</html>
