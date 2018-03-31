<?php
//$user = "root";
//$pass = "password";

$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "ba0dd49e70befd";
$password = "e8e0885d";
$dbname = "heroku_54c3b520208a1ef";

$conn       = new mysqli( 'us-cdbr-iron-east-05.cleardb.net', 'ba0dd49e70befd', 'e8e0885d', 'heroku_54c3b520208a1ef' );

$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 10;
$page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
$links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
$query = "select * from movies";

require_once 'paginator.class.php';
$paginator  = new Paginator($conn, $query);
$results    = $paginator->getData($limit, $page);

?>
