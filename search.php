<?php
require "partials/_dbconnect.php";
$query=$_GET['search'];
require "partials/_header.php";
$search_query = "SELECT * FROM threads WHERE MATCH(thread_title,thread_desc) against ('$query')";
$search_result = mysqli_query($conn, $search_query);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Threads</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php
    require "partials/_login_modal.php";
    require "partials/_signup_modal.php";
    ?>
    <div class="search my-3 container">
        <h1 class="text-center text-warning">Search results for "<em><?php echo $_GET['search']?></em>"</h1>
        <?php
        if (mysqli_num_rows($search_result) == 0) {
            echo '<h2 class="text-center my-5">No results</h2>';
            exit();
        }
        while ($row = mysqli_fetch_assoc($search_result)) {
            echo '
        <div class="result container my-5">
            <a href="thread.php?threadid='.$row['thread_id'].'"><h3>' . $row['thread_title'] . '</h3></a>
            <p>' . $row['thread_desc'] . '</p>
            </div>
        ';
        } ?>
    </div>
    <?php
    require "partials/_footer.php"
    ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>