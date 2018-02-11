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
            <a class="navbar-brand" href="#">Filmfix</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
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
            <?php echo "User Name : " . $_POST["form-username"]; ?><br>
            
        </header>

    



        <!-- Page Features -->
        <div class="row text-center">
        
<?php

$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "ba0dd49e70befd";
$password = "e8e0885d";
$dbname = "heroku_54c3b520208a1ef";

// Check connection

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT imdbId FROM LINKS;";
$result = $conn->query($sql);
$count=0;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc() ) {
        if ($count!=8){

        //echo "id: " . $row["imdbId"]. "<br>";
        $count = $count+1;
        $movie_id = $row["imdbId"];
        $service_url = 'http://www.omdbapi.com/?i=tt'.$movie_id.'&apikey=dd8cd3ff';
        
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
        
        //echo "<H2>Title:</H2> ";
        //var_export($decoded->Title);
        //echo "<br>";
        //echo "<h4>Overview</h4>";
        //var_export($decoded->Plot);
        //echo "<br>";
        //echo "<br>";
        //echo "<br>";
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
        } else{
            break;
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
    <footer class="py-5 bg-dark">
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