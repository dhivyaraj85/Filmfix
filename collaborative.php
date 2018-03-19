<?php
session_start();
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

        <!-- Page Features -->
        <div class="row text-center">
        
<?php
$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "ba0dd49e70befd";
$password = "e8e0885d";
$dbname = "heroku_54c3b520208a1ef";

//$servername = "127.0.0.1";
//$username = "root";
//$password = "password";
//$dbname = "movieDB";

// Check connection
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "select movieid1,movieid2,movieid3,movieid4,movieid5,movieid6,movieid7,movieid8,movieid9,movieid10 from collab_reco where USERID=".$_SESSION["user_id"].";";

$result = $conn->query($sql);
$count=0;
$movie_arrays =array ();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc() ) {
        
        //echo "id: " . $row["imdbId"]. "<br>";
        $count = $count+1;
       /*$movie_id_1 = $row["movieid1"];
        $movie_id_2 = $row["movieid2"];
        $movie_id_3 = $row["movieid3"];
        
        $movie_array = array($movie_id_1 ,$movie_id_2,$movie_id_3);*/
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
    //print_r($movie_id_array);

        foreach ($movie_id_array as &$movie) {
            $sql_subquery = "select imdbId , tmdbId from LINKS where movieId=".$movie.";";
            $sub_result = $conn->query($sql_subquery);
            if ($sub_result->num_rows > 0){

                while($sub_row = $sub_result->fetch_assoc() ){
                    $imdbId = $sub_row["imdbId"];
                    if (strlen($imdbId)==5){
                        $imdbId= "00".$imdbId;
                    }
                    else if(strlen($imdbId)==6){
                        $imdbId= "0".$imdbId;
                    }
                    
                    $service_url = 'http://www.omdbapi.com/?i=tt'.$imdbId.'&apikey=dd8cd3ff';
                    
                    //echo $service_url;
                    $curl = curl_init($service_url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $curl_response = curl_exec($curl);
                    if ($curl_response === false) {
                        $info = curl_getinfo($curl);
                        curl_close($curl);
                        die('error occured during curl exec. Additioanl info: ' . var_export($info));
                    }
                    curl_close($curl);
                    $decoded = json_decode($curl_response);
                    if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                        die('error occured: ' . $decoded->response->errormessage);
                    }
                    
 
                    if ($decoded->Response=="False"){
                        echo "<h1> No ID </h1>";
                        $tmdbId = $sub_row["tmdbId"];
                        $service_url = 'https://api.themoviedb.org/3/movie/'.$tmdbId.'?api_key=aab43cfd89dea8cff2b0a29101c385af';
                    }
                    else{
                    $poster_path = var_export($decoded->Poster, True);
                    //echo $poster_path;
                    $poster_base_url = str_replace("'","",$poster_path);
                    //echo '<img src="'.$poster_base_url.'"/>';
                    echo "<div class='col-lg-3 col-md-6 mb-4'>";
                    echo "<div class='card'>";
                        echo "<img class='card-img-top' src='".$poster_base_url."' alt='' height='300'>";
                        echo "<div class='card-body'>";
                            echo "<h4 class='card-title'>".$decoded->Title."</h4>";
                            echo "<p class='card-text'>".$decoded->Plot."</p>";
                        echo "</div>";
                        echo "<div class='card-footer'>";
                            echo "<a href= class='btn btn-primary'>".$decoded->Ratings[0]->Value."</a>";
                        echo "</div>";
                    echo "</div>";
               echo "</div>";

                    }


               // end of while loop for select
                }

            }
            

        }    
   
    
} else {
    echo "0 results";
}
$conn->close();
?>
            
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


</body>

</html>