<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    require "_dbconnect.php";
    $email=$_POST["email"];
    $password=$_POST["password"];

    $login_query = "SELECT * from `users` WHERE user_email='$email'";
    $login = mysqli_query($conn, $login_query);

    if(mysqli_num_rows($login)==1){
        while($row=mysqli_fetch_assoc($login)){
            if(password_verify($password,$row['user_password'])){
                session_start();
                $_SESSION["loggedIn"]=true;
                $_SESSION["user_id"]=$row["user_id"];
                header("location: ../index.php?login=true"); 
            }
            else{
                header("location: ../index.php?login=false");
            }
        }
    }
    else{
        header("location: ../index.php?login=false");
    }
}
?>