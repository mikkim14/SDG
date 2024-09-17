<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "sdg_12"; 

$conn = mysqli_connect($host, $user, $pass, $database);

if (!$conn) {
    die("Error! Wrong Input: ". mysqli_connect_error()); 
}
?>