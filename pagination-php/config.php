<?php
$user = "root";
$pass = "password";
$conn       = new mysqli( '127.0.0.1', 'root', 'password', 'movieDB' );

$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 25;
$page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
$links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
$query = "SELECT * FROM movies ";

require_once 'paginator.class.php';
$paginator  = new Paginator($conn, $query);
$results    = $paginator->getData($limit, $page);

?>