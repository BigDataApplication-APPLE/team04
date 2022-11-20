<!DOCTYPE html>
<?php
  error_reporting(E_ERROR);
  $directorAge = "";
  $directorWoman = "";
  $directorMan = "";
  $actorAge = "";
  $actorWoman = "";
  $actorMan = "";
  $actor = "";
  $actorIssue1 = "";
  $actorIssue2 = "";
  if(isset($_POST["directorAge"])) {
    $directorAge = $_POST["directorAge"];
  }
  if(isset($_POST["directorWoman"])) {
    $directorWoman = $_POST["directorWoman"];
  }
  if(isset($_POST["directorMan"])) {
    $directorMan = $_POST["directorMan"];
  }
  if(isset($_POST["actorAge"])) {
    $actorAge = $_POST["actorAge"];
  }
  if(isset($_POST["actorWoman"])) {
    $actorWoman = $_POST["actorWoman"];
  }
  if(isset($_POST["actorMan"])) {
    $actorMan = $_POST["actorMan"];
  }
  if(isset($_POST["actorHeight"])) {
    $actorHeight = $_POST["actorHeight"];
  }
  if(isset($_POST["actorIssue1"])) {
    $actorIssue1 = $_POST["actorIssue1"];
  }
  if(isset($_POST["actorIssue2"])) {
    $actorIssue2 = $_POST["actorIssue2"];
  }


  $where = "";
  if( $directorAge ) {
    if(sizeof($directorAge) > 0) { //age 선택값이 있을때
      $where .= "and (";
    }
    for($i=0; $i < sizeof($directorAge); $i++) {
      $this_directorAge = $directorAge[$i];
      $this_directorAge_arr = explode("-", $this_directorAge);
      $start_directorAge = $this_directorAge_arr[0];
      $end_directorAge = $this_directorAge_arr[1];

      if($i == 0) {
        $where .= " (D.directorAge >= '$start_directorAge' and D.directorAge <= '$end_directorAge') ";
      }
      else {
        $where .= " or (D.directorAge >= '$start_directorAge' and D.directorAge <= '$end_directorAge') ";
      }
    }
    if($directorAge && sizeof($directorAge) > 0) {
      $where .= ")";
    }
  }

  $whereDirectorSex = "";
  if($directorWoman == "Y") { //여자일 때
    if(!$whereDirectorSex) {
      $whereDirectorSex .= " D.directorSex ='여성' ";
    }
    else {
      $whereDirectorSex .= " or D.directorSex ='여성' ";
    }
  }
  if($directorMan == "Y") { //남자일 때
    if(!$whereDirectorSex) {
      $whereDirectorSex .= " D.directorSex ='남성' ";
    }
    else {
      $whereDirectorSex .= " or D.directorSex ='남성' ";
    }
  }

  if($whereDirectorSex) {
    $whereDirectorSex = "and (" . $whereDirectorSex  . ")";
  }

  $whereActorAge = "";
  if($actorAge) {
    if(sizeof($actorAge) > 0) {
      $whereActorAge .= "and (";
    }
    for($i=0; $i < sizeof($actorAge); $i++) {
      $this_actorAge = $actorAge[$i];
      $this_actorAge_arr = explode("-", $this_actorAge);
      $start_actorAge = $this_actorAge_arr[0];
      $end_actorAge = $this_actorAge_arr[1];

      if($i == 0) {
        $whereActorAge .= " (A.actorAge >= '$start_actorAge' and A.actorAge <= '$end_actorAge') ";
      }
      else {
        $whereActorAge .= " or (A.actorAge >= '$start_actorAge' and A.actorAge <= '$end_actorAge') ";
      }
    }
    if(sizeof($actorAge) > 0) {
      $whereActorAge .= ")";
    }
  }



  $whereActorSex = "";
  if($actorWoman == "Y") { //여자일때
    if(!$whereActorSex) {
      $whereActorSex .= " A.actorSex ='여성' ";
    }
    else {
      $whereActorSex .= " or A.actorSex ='여성' ";
    }
  }
  if($actorMan == "Y") { //남자일 때
    if(!$whereActorSex) {
      $whereActorSex .= " A.actorSex ='남성' ";
    }
    else {
      $whereActorSex .= " or A.actorSex ='남성' ";
    }
  }

  if($whereActorSex) {
    $whereActorSex = "and (" . $whereActorSex  . ")";
  }




  $whereActorHeight = "";
  if($actorHeight) {
    if(sizeof($actorHeight) > 0) {
      $whereActorHeight .= "and (";
    }
    for($i=0; $i < sizeof($actorHeight); $i++) {
      $this_actorHeight = $actorHeight[$i];
      $this_actorHeight_arr = explode("-", $this_actorHeight);
      $start_actorHeight = $this_actorHeight_arr[0];
      $end_actorHeight = $this_actorHeight_arr[1];

      if($i == 0) {
        $whereActorHeight .= " (A.actorHeight >= '$start_actorHeight' and A.actorHeight <= '$end_actorHeight') ";
      }
      else {
        $whereActorHeight .= " or (A.actorHeight >= '$start_actorHeight' and A.actorHeight <= '$end_actorHeight') ";
      }
    }
    if(sizeof($actorHeight) > 0) {
      $whereActorHeight .= ")";
    }
  }



  $whereActorIssue = "";
  if($actorIssue1 == "include") {
    if(!$whereActorIssue) {
      $whereActorIssue .= " A.issueId > 1 ";
    }
    else {
      $whereActorIssue .= " or A.issueId > 1 ";
    }
  }

  if($actorIssue2 == "exclude") {
    if(!$whereActorIssue) {
      $whereActorIssue .= " A.issueId = 1 ";
    }
    else {
      $whereActorIssue .= " or A.issueId = 1  ";
    }
  }

  if($whereActorIssue) {
    $whereActorIssue = "and (" . $whereActorIssue  . ")";
  }


  $mysqli = mysqli_connect('localhost', 'team04', 'team04', 'team04');

  $SQL = " SELECT A.actorId, A.actorName, A.actorSex, A.actorAge, A.actorHeight, D.directorName,
                  D.directorSex, D.directorAge, D.directorId, E.movieTitle, E.movieId
 FROM ACTOR A, MOVIE_ACTOR B, MOVIE_DIRECTOR C, DIRECTOR D, MOVIE_DETAIL E
 where A.actorId = B.actorId and C.movieId = B.movieId and C.directorId = D.directorId
 and E.movieId = B.movieId
 $where
 $whereDirectorSex
 $whereActorAge
 $whereActorSex
 $whereActorHeight
 $whereActorIssue
 order by A.actorName asc ";


$res = mysqli_query($mysqli, $SQL);

include "header.php";
 ?>


<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="write.css?after&1">
    <title>searchResult</title>
    <style>
      .board {
        width: 100%;
        margin-top: 0px;
      }

      .commentboard {
        max-width: 1000px;
      }

      a {
        text-decoration:none
      }

      a:link {
        color : #F26C6C;
      }

      a:hover {
        color : red;
      }

      a:visited {
        color : #F26C6C;
      }


    </style>
</head>
<body style="margin:0px">
   <div class="commentboard">
    <table class=board>
        <thead>
            <tr align=center>

                <th width=60>No</th>
                <th>Title</th>
                <th>Actor Name</th>
                <th>Actor Age</th>
                <th>Actor Height</th>
                <th>Actor Sex</th>
                <th>Director Name</th>
                <th>Director Age</th>
                <th>Director Sex</th>
            </tr>
       </thead>

   <?php
    function transSex($sex) {
      $returnValue = "";
      if($sex == 1) {
        $returnValue = "남성";
      }
      else if($sex == 0) {
        $returnValue = "여성";
      }
      return $returnValue;
    }

          $mysqli = mysqli_connect('localhost', 'team04', 'team04', 'team04');

          $no = 0;
          if(mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_array($res)){
              $no++;
            ?>
                <tbody>
                    <tr align=center>
                        <td width=60><?=$no?></td>
                        <td><a href="commentBoard.php?movieId=<?=$row["movieId"]?>"><?=$row["movieTitle"]?> </a></td>
                        <td><?=$row["actorName"]?></td>
                        <td><?=$row["actorAge"]?></td>
                        <td><?=$row["actorHeight"]?></td>
                        <td><?=$row["actorSex"]?></td>
                        <td><?=$row["directorName"]?></td>
                        <td><?=$row["directorAge"]?></td>
                        <td><?=$row["directorSex"]?></td>
                    </tr>
                </tbody>
            <?php
            }
          }
          else {
            ?>
                <tbody>
                    <tr align=center>
                        <td colspan=8>No DATA</td>
                    </tr>
                </tbody>
            <?php
          }
      ?>
  </table>
</div>
</body>
</html>
