<?php
require "_dbconnect.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email=$_POST["email"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];

    if($cpassword!=$password){
        header("location: ../index.php?pass_mismatch=true");
    }
    else{
        $user_check_query="SELECT * from users WHERE user_email='$email'";
        $user_check_result=mysqli_query($conn,$user_check_query);
        $passHash=password_hash($password,PASSWORD_DEFAULT);
        if(mysqli_num_rows($user_check_result)==0){
            $user_insert_query="INSERT INTO `users` (`user_email`, `user_password`) VALUES ('$email','$passHash')";
            $user_insert_result=mysqli_query($conn,$user_insert_query);
            if($user_insert_query){
                header("location: ../index.php?signup=true");
                exit();
            }
            else{
                header("location: ../index.php?signup=false");
            }
        }
        else{
            header("location: ../index.php?user_exists=true");
        }
    }
}
?>