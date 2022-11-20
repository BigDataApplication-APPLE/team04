<?php

function get_movie_title($movieId) {
  $mysqli = mysqli_connect('localhost', 'team04', 'team04', 'team04') or die(mysqli_error());
  $sql = "select * from movie_detail where movieId='$movieId'";
  $res = mysqli_query($mysqli, $sql);
  $row = mysqli_fetch_array($res);
  return $row['movieTitle'];
}

?>
