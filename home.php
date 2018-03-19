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
                           <span class="sr-only">(current)</span>
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

        <!-- Jumbotron Header -->
        <header class="jumbotron my-4">
            <h3 class="display-3">Personalized Movie Recommendation System!</h3>
            <p class="lead">Rate and View your Movie Recommendations.</p>
           <?php echo "User id : " . $_SESSION["user_id"]; ?><br>  
        </header>

    



        <!-- Page Features -->
    <div class="row text-center">
        
    <form name="button_click" role="form" action="search_db.php" method="POST" class="login-form">
    <div class="container">
	<div class="row">
        <div class="col-md-6">
    		
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" name="movie_name" class="form-control input-lg" placeholder="Search Movies" />
                    <span class="input-group-btn" onclick="search_db();">
                        <button class="btn btn-success btn-lg" type="button" onclick="search_db();">
                            <i class="glyphicon glyphicon-search" onclick="search_db();" ></i>
                        </button>
                    </span>
                </div>

            </div>
        </div>
	</div>
</div>
</form>



<script>
        function search_db() {
            
            document.forms['button_click'].action = 'search_db.php';
            document.forms['button_click'].method ='POST'; 
            document.forms['button_click'].submit();
            
        }
</script>  
            

<div class="container-fluid" style="margin-top:50px;">
<?php 
// connect to mysql
    $servername = "us-cdbr-iron-east-05.cleardb.net";
    $username = "ba0dd49e70befd";
    $password = "e8e0885d";
    $dbname = "heroku_54c3b520208a1ef";
   
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    // mysql search query
    $sql = "select movieid1,movieid2,movieid3,movieid4,movieid5, movieid6,movieid7,movieid8,movieid9,movieid10 from not_rated_reco where userid=".$_SESSION["user_id"].";";
    //$query = "select movieId, Title  from movies where title like '%".$movie_name."%';";
    //echo  $query;
    $result = $conn->query($sql);
    
    $movie_arrays =array ();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc() ) {
            $movie_id1 = round($row["movieid1"]);
            $movie_id2 = round($row["movieid2"]);
            $movie_id3 = round($row["movieid3"]);
            $movie_id4 = round($row["movieid4"]);
            $movie_id5 = round($row["movieid5"]);
            $movie_id6 = round($row["movieid6"]);
            $movie_id7 = round($row["movieid7"]);
            $movie_id8 = round($row["movieid8"]);
            $movie_id9 = round($row["movieid9"]);
            $movie_id10 = round($row["movieid10"]);

            array_push($movie_arrays, $movie_id1,$movie_id2,$movie_id3,$movie_id4,$movie_id5,
            $movie_id6,$movie_id7,$movie_id8,$movie_id9,$movie_id10);
           
            
            $movie_id_array = array_unique($movie_arrays);
            
        }
        
    //print_r( $movie_id_array);
    echo "<table align='center' class='table'>";
    echo "<thead><tr>
      <th>Movie ID</th>
      <th>Movie Name</th>
      <th>Rating</th>
      </tr></thead>";

    foreach ($movie_id_array as &$movie) {
     
        $sql_subquery = "select movieId,title from links where movieId=".$movie.";";
        $sub_result = $conn->query($sql_subquery);
        if ($sub_result->num_rows > 0){
          

            while($sub_row = $sub_result->fetch_assoc() ){
                $movieId = $sub_row["movieId"];
                $title = $sub_row["title"];
                echo "<tr>";
                echo "<td align='left'>".$movieId."</td>";
                echo "<td align='left'>".$title."</td>";
                echo "<td align='left'id='rating_value' ><input class='rating' name='rating'  name='rating' type='number' min='1' step='0.1' /></td>";
                echo "</tr>";
            }
           
            }
        }
        echo"</table>";
    }
    else{
        echo "0 results";
    }
      
    $conn->close();

    
?>
</div>
<div style="margin:10px;">
<button style="align:center;" class="btn btn-success btn-lg" onclick="exportTableToCSV('new_rating.csv',<?php echo $_SESSION["user_id"]; ?>)"> Save ratings to CSV File</button>
</div>
</div>
        <!-- /.row -->
       
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