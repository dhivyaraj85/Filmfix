<?php
session_start();
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
    $user_id = $_SESSION["new_user_id"];
    $_SESSION["user_id"] = $user_id ;
    header("Location: https://secret-island-17790.herokuapp.com/pagination-php/index.php");
   
} else {
   
    echo "Error: " . $sql . "<br>" . $conn->error;
    header("Location: https://secret-island-17790.herokuapp.com/"); /* Redirect browser */
    exit();
    
}

$conn->close();
?>