<?php
header('Content-Type: text/html; charset=UTF-8');

include "header.php";
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>search filter page</title>
    <link rel="stylesheet" href="filter.css?after">
  </head>
  <body style="margin:0px">
      <div id="form" style="width:1000px;">
          <form action="searchResult.php" method="post">
              <div class="directorFilter">
                  <p style="font-size:20px; font-weight: bold;">Director</p>
                  <div>Age&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" id="chk1" name="directorAge[]" value="0-19"><label for="chk1">0-19</label>
                      <input type="checkbox" id="chk2" name="directorAge[]" value="20-29"><label for="chk2">20-29</label>
                      <input type="checkbox" id="chk3" name="directorAge[]" value="30-39"><label for="chk3">30-39</label>
                      <input type="checkbox" id="chk4" name="directorAge[]" value="40-49"><label for="chk4">40-49</label>
                      <input type="checkbox" id="chk5" name="directorAge[]" value="50-300"><label for="chk5">over 50</label>
                  </div>
                  <div>Sex&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" id="chk6" name="directorWoman" value="Y"><label for="chk6">Woman</label>
                      <input type="checkbox" id="chk7" name="directorMan" value="Y"><label for="chk7">Man</label>
                  </div>
              </div>
              <div class="actorFilter" >
                  <p style="font-size:20px; font-weight: bold;">Actor</p>
                  <div>Age&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" id="achk1" name="actorAge[]" value="0-19"><label for="achk1" width="100px;">0-19</label>
                      <input type="checkbox" id="achk2" name="actorAge[]" value="20-29"><label for="achk2">20-29</label>
                      <input type="checkbox" id="achk3" name="actorAge[]" value="30-39"><label for="achk3">30-39</label>
                      <input type="checkbox" id="achk4" name="actorAge[]" value="40-49"><label for="achk4">40-49</label>
                      <input type="checkbox" id="achk5" name="actorAge[]" value="50-300"><label for="achk5">over 50</label>
                  </div>
                  <div>Sex&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" id="achk6" name="actorWoman" value="Y"><label for="achk6">Woman</label>
                      <input type="checkbox" id="achk7" name="actorMan" value="Y"><label for="achk7">Man</label>
                  </div>
                  <br>
                  <div>
                      Height
                      <input type="checkbox" id="achk8" name="actorHeight[]" value="0-160"><label for="achk8">under 160cm</label>
                      <input type="checkbox" id="achk9" name="actorHeight[]" value="160-169"><label for="achk9">160-169cm</label>
                      <input type="checkbox" id="achk10" name="actorHeight[]" value="170-179"><label for="achk10">170-179cm</label>
                      <input type="checkbox" id="achk11" name="actorHeight[]" value="180-189"><label for="achk11">180-189cm</label>
                      <input type="checkbox" id="achk12" name="actorHeight[]" value="190-400"><label for="achk12">over 190cm</label>
                  </div>
                  <div>
                      Issues&nbsp;
                      <input type="checkbox" id="achk13" name="actorIssue1" value="include"><label for="achk13">O</label>
                      <input type="checkbox" id="achk14" name="actorIssue2" value="exclude"><label for="achk14">X</label>
                  </div>
              </div>
              <div style="width:300px; margin:0px auto;">
              <input type="submit" value="Search" id="submit">
            </div>
          </form>
      </div>
  </body>
</html>

<?php
$mysqli = mysqli_connect("localhost", "team04", "team04", "team04");
if(mysqli_connect_errno()){
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
else {

}
?>
