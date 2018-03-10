<?php
include "config.php";
session_start();
if (isset($_POST["form-new-username"])){
$_SESSION["new_user_id"]= $_POST["form-new-username"];
}
?>
<?php
if (isset($_POST["form-new-username"])){
$_SESSION["new_user_id"]= $_POST["form-new-username"];
}
$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "ba0dd49e70befd";
$password = "e8e0885d";
$dbname = "heroku_54c3b520208a1ef";

//echo $_SESSION["new_user_id"] ;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO new_users (user_id) VALUES (".$_SESSION["new_user_id"] .")";

if ($conn->query($sql) === TRUE) {
    echo "<h1 style='text-align:center' >Welcome to Filmfix</h1>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Filmfix</title>
    <link href="style.css" rel="stylesheet"/>
</head>
<body>

<script>
function exportTableToCSV(filename , userId) {
    
    var csv = [];
    var rows = document.querySelectorAll("table tr");
    k=-1;
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td,th");
        rating = document.querySelectorAll(".rating");
        len = document.querySelectorAll(".rating").length;
        //console.log(len);
       if (i==0){
        for (var j = 0; j < cols.length ; j++) {
            row.push(cols[j].innerText);  
        }
        row.push("UserId");
        csv.push(row.join(",")); 
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
            else{
            row.push(cols[j].innerText);
            }
            console.log( row );
            
        }
        row.push(userId);
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
    saveTodb();
    document.cookie = "rating_data = " +csv;
    console.log(document.cookie);
}

function saveTodb(){
var mysql = require('mysql');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "password"
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
});
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
}

</script>
    <div class="container">
        <h1 style="text-align:center">Rate movies to get Personalized Recommendations!!</h1>
        <?php echo "New User Id : " . $_SESSION["new_user_id"]; ?><br> 
        <table class="table">
        <thead>
                        <tr>
                            <th>Movie Id</th>
                            <th width="60%">Title</th>
                            <th width="25%">Rating</th>
                        </tr>
                        </thead>
            <tbody>
                <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
                        <tr>
                                <td><?php echo $results->data[$i]['movieId']; ?></td>
                                <td><?php echo $results->data[$i]['title']; ?></td>
                                <td><input class="rating" name="rating" type="number" min="1" step="0.1" /></td>
                            
                        </tr>
                <?php endfor; ?>
            </tbody>
        </table>
        <?php echo $paginator->createLinks($links , 'pagination pagination-sm'); ?> 
        <button onclick="exportTableToCSV('new_rating.csv',<?php echo $_SESSION["new_user_id"]; ?>)"> Save ratings to CSV File</button>
        <p id="demo"></p>
    </div>
</body>

</html>