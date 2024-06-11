<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$dbname = "appointments";

$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn){
    die("Connection Failed: ". mysqli_connect_error());
}

?>