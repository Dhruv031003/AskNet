<?php
session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true){
    header('location: ../index.php');
}
else{
    session_unset();
    session_destroy();
    header("location: ../index.php");
}

?>