<?php
session_start();
if (isset($_POST["form-username"])){
$_SESSION["user_id"]= $_POST["form-username"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Filmfix - Personalized Movie Recommendation System</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"> </script>
    <link href="css/heroic-features.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#" style="margin-right: 40px" >Filmfix</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto" >
                    <li class="nav-item active" style="margin-right: 15px">
                        <a class="nav-link" href="home.php">Home
                         </a>
                    </li>
                    <li class="nav-item" style="margin-right: 15px">
                        <a class="nav-link" href="collaborative.php">Collaborative Filtering </a>
                    </li>
                    <li class="nav-item" style="margin-right: 15px">
                        <a class="nav-link" href="content.php">Content Based</a>
                    </li>
                    <li class="nav-item" style="margin-right: 15px">
                        <a class="nav-link" href="cooccurance.php">Cooccurrence </a>
                    </li>
                    <li class="nav-item" style="margin-right: 15px">
                        <a class="nav-link" href="hybrid.php">Hybrid </a>
                    </li>
                </ul>
            </div>
            <div>
            <li class="nav-item">
                        <a class="nav-link" href="index.php">Sign Out</a>
                    </li>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">


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
        echo "<td align='left'>".$movie_id."</td>";
        echo "<td align='left'>".$title."</td>";
        echo "<td align='left' ><input class='rating' name='rating' type='number' min='1' step='0.1' /></td>";
        echo "</tr>";
        
      }  
      echo"</table>";
    }
    
    // if the id not exist
    // show a message and clear inputs
    else {
        echo "No Results found";
    }
    
    
    mysqli_free_result($result);
    mysqli_close($connect);
    
}

// in the first time inputs are empty
else{
    echo "No Results found";
}


?>
<div style="margin:10px;margin-left:50px;padding-right:50px;">
<button style="align:center;" class="btn btn-success btn-lg" onclick="window.location.href='home.php'"> Back</button>

<button style="align:center;" class="btn btn-success btn-lg" onclick="exportTableToCSV('new_rating.csv',<?php echo $_SESSION["user_id"]; ?>)"> Save ratings to CSV File</button>
</div>

</div>
   <!-- /.container -->
 <!-- Footer -->
 <footer class="py-4 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"> </script>
    <script>
    function exportTableToCSV(filename , userId) {
    
    var csv = [];
    var rows = document.querySelectorAll("table tr");
    
    k=-1;
    for (var i = 0; i < rows.length; i++) {
        console.log("---");
        var row = [], cols = rows[i].querySelectorAll("td,th");
        row.push(userId);
        rating = document.querySelectorAll(".rating");
        len = document.querySelectorAll(".rating").length;
        console.log(len);
       if (i==0){
        for (var j = 0; j < cols.length ; j++) {
            row.push(cols[j].innerText);  
        }
        //row.push("UserId");
        //csv.push(row.join(",")); 
       } 
       else if (rating[k].value){
        for (var j = 0; j < cols.length; j++) {
         
            //document.getElementById("demo1").innerHTML = cols[0].innerText;
            //document.getElementById("demo2").innerHTML = rating[i].value;
            //document.getElementById("demo3").innerHTML = cols[1].innerText;
            //document.getElementById("demo4").innerHTML = cols[j].innerText;
            if (i!=0 && j==2){
                row.push(rating[k].value);
                
            }
            else if (j==0){
            row.push(cols[j].innerText);
            }
            console.log( row );
            
        }
       
        csv.push(row.join(",")); 
       }
       k++;       
    }

    // Download CSV file
   
    downloadCSV(csv.join("\n"), filename);
    console.log(csv);
    //Movie Id,Title,Rating,UserId
   
    for (i=1;i<csv.length;i++){
        console.log(csv[i]);
    }
    //saveTodb();
    document.cookie = "rating_data = " +csv;
    console.log(document.cookie);
}


function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
    
    document.getElementById('rating_value').value = '';
}

</script>



</body>

</html>
