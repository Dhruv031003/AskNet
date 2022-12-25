<?php
$server="localhost";
$username="root";
$password="";
$database="forum";

$conn=mysqli_connect($server,$username,$password,$database);
if(!$conn){
    die("Couldn't connect to the server".mysqli_connect_error());
}
?>