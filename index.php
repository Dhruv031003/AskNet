<?php
require "partials/_dbconnect.php";
require "partials/_header.php";

$category_query = "Select * from categories";
$category_result = mysqli_query($conn, $category_query);
$signup=NULL;
$pass_mismatch=NULL;
$user_exists=NULL;
$login=0;

if(isset($_GET["signup"]) ){
    $signup=$_GET["signup"];
}
if(isset($_GET["pass_mismatch"])){
    $pass_mismatch=$_GET["pass_mismatch"];
}
if(isset($_GET["user_exists"])){
    $user_exists=$_GET["user_exists"];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coding Discussions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php
    require "partials/_login_modal.php";
    require "partials/_signup_modal.php";
    require "partials/_alerts.php";
    if(isset($_GET["login"])){
        $login=($_GET["login"]=="true")?1:0;
        if($login){
            echo '<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
        <strong>Login successful.</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
        <strong>Wrong credentials!!!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    }
    ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1200x400/?coding" class="d-block w-100" alt="..." style="object-fit:cover">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1200x400/?coders" class="d-block w-100" alt="..." style="object-fit:cover">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1200x400/?code" class="d-block w-100" alt="..." style="object-fit:cover">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container">
        <p class="text-center fw-bolder fs-2 my-2">Hello,Welcome to Dhruv's Forums</p>
        <div class="d-flex flex-wrap justify-content-space-between">
            <?php
            while ($row = mysqli_fetch_assoc($category_result)) {
                echo '<div class="card m-2" style="width: 300px;">
            <img src="https://source.unsplash.com/300x200/?' . $row["category_name"] . ',code" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">' . $row["category_name"] . '</h5>
            <p class="card-text">' . substr($row["category_description"], 0, 100) . '</p>
            <a href="threadList.php?catid=' . $row["category_id"] .'" class="btn btn-primary">See Thread List!</a>
            </div>
            </div>';
            }
            ?>
        </div>

    </div>

    <?php
    require "partials/_footer.php"
    ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>