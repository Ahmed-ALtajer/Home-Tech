<?php 

$serverName = "localhost:3307";
$dbName = "hstore";
$userName = "root";
$password = "";

$conn = mysqli_connect($serverName,$userName,$password,$dbName);

if(!$conn)
{
    die("connection failed");
}

?>