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

$sql = "select movieid1,movieid2,movieid3,movieid4,movieid5 from collab_reco where USERID=2 union all select  movieid1,movieid2,movieid3,movieid4,movieid5  from content_reco_new_25 where userid=2;";
$result = $conn->query($sql);
$movie_arrays =array ();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc() ) {
       

        //echo "id: " . $row["imdbId"]. "<br>";
        $movie_id1 = round($row["movieid1"]);
        $movie_id2 = round($row["movieid2"]);
        $movie_id3 = round($row["movieid3"]);
        $movie_id4 = round($row["movieid4"]);
        $movie_id5 = round($row["movieid5"]);
        
        array_push($movie_arrays, $movie_id1,$movie_id2,$movie_id3,$movie_id4,$movie_id5);
       
        
        $movie_id_array = array_unique($movie_arrays);
        


      
      
       /* $service_url = 'http://www.omdbapi.com/?i=tt'.$movie_id.'&apikey=dd8cd3ff';
        
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
        var_export($decoded->Title);
        //echo "<br>";
        //echo "<h4>Overview</h4>";
        var_export($decoded->Plot);
        //echo "<br>";
        //echo "<br>";
        //echo "<br>";
        $poster_path = var_export($decoded->Poster, True);
        //echo $poster_path;
        $poster_base_url = str_replace("'","",$poster_path);

        //echo '<img src="'.$poster_base_url.'"/>';*/


        } 
        print_r($movie_id_array);
    }
    
 else {
    echo "0 results";
}
$conn->close();

?>


