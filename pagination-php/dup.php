<?php 

    $numbers = range(1, 50);
    shuffle($numbers);
   echo("movieid".$numbers[0])."<br>";
   echo("movieid".$numbers[1])."<br>";
   echo("movieid".$numbers[2])."<br>";
   echo("movieid".$numbers[3])."<br>";
   echo("movieid".$numbers[4])."<br>";
   echo("movieid".$numbers[5])."<br>";
   echo("movieid".$numbers[6])."<br>";
   echo("movieid".$numbers[7])."<br>";
   echo("movieid".$numbers[8])."<br>";
   echo("movieid".$numbers[9])."<br>";
  echo "----"."<br>";

  $not_rated_movieid = " select movieid".$numbers[0]." ,movieid".$numbers[1]." ,movieid".$numbers[2]." ,movieid".$numbers[3].
  " ,movieid".$numbers[4]." ,movieid".$numbers[5]." ,movieid".$numbers[6]." ,movieid".$numbers[7].
  " ,movieid".$numbers[8]." ,movieid".$numbers[9]. "from not_rated_reco where USERID =".$_SESSION["user_id"].";";

  echo   $not_rated_movieid;





?>