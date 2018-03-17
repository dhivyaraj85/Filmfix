<!DOCTYPE html>
<html>
<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
<div class="row">
<div class="col-md-8">
<?php

// php code to search data in mysql database and set it in input text

if(isset($_POST['movie_name']))
{
    
    $movie_name = $_POST['movie_name'];
    
    // connect to mysql
    $servername = "us-cdbr-iron-east-05.cleardb.net";
    $username = "ba0dd49e70befd";
    $password = "e8e0885d";
    $dbname = "heroku_54c3b520208a1ef";
    $connect = mysqli_connect( $servername, $username ,  $password , $dbname);
    
    // mysql search query
    $query = "select movieId, Title  from movies where title like '%".$movie_name."%';";
    //echo  $query;
    $result = mysqli_query($connect, $query);
    
    // if id exist 
    // show data in inputs
    if(mysqli_num_rows($result) > 0)
    {

        echo "<table align='center' class='table'>";
        echo "<thead><tr>
          <th>Movie ID</th>
          <th>Movie Name</th>
          <th>Rating</th>
        </tr></thead>";
      while ($row = mysqli_fetch_array($result))
      {
        $movie_id = $row['movieId'];
        $title = $row['Title'];
        echo "<tr>";
        echo "<td>".$movie_id."</td>";
        echo "<td>".$title."</td>";
        echo "<td><input name='rating' type='number' min='1' step='0.1' /></td>";
        echo "</tr>";
        
      }  
      echo"</table>";
    }
    
    // if the id not exist
    // show a message and clear inputs
    else {
        echo "Undifined ID";
            $fname = "";
            $lname = "";
            $age = "";
    }
    
    
    mysqli_free_result($result);
    mysqli_close($connect);
    
}

// in the first time inputs are empty
else{
    $fname = "";
    $lname = "";
    $age = "";
}


?>
</div>
</div>
</body>
</html>