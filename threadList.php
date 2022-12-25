<?php
require "partials/_dbconnect.php";
require "partials/_header.php";

$id = $_GET["catid"];
$alert = false;

$signup = NULL;
$pass_mismatch = NULL;
$user_exists = NULL;

if (isset($_GET["signup"])) {
    $signup = $_GET["signup"];
}
if (isset($_GET["pass_mismatch"])) {
    $pass_mismatch = $_GET["pass_mismatch"];
}
if (isset($_GET["user_exists"])) {
    $user_exists = $_GET["user_exists"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $thread_user_id=$_SESSION['user_id'];
    $title = $_POST["title"];
    $desc = $_POST["description"];
    $question_query = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$title', '$desc', '$id', '$thread_user_id', current_timestamp())";
    $question_result = mysqli_query($conn, $question_query);
    $alert = true;
}
    

$category_query = "SELECT * FROM categories WHERE category_id=$id";
$category_result = mysqli_query($conn, $category_query);
$category_row = mysqli_fetch_assoc($category_result);

$thread_query = "SELECT * FROM `threads` WHERE `thread_cat_id` = $id";
$thread_result = mysqli_query($conn, $thread_query);



$no_threads = true;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Forum | ThreadList</title>
</head>

<body>
    <?php
    require "partials/_login_modal.php";
    require "partials/_signup_modal.php";
    require "partials/_alerts.php";
    if (isset($_GET["login"])) {
        $login = $_GET["login"];
        if ($login) {
            echo '<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
        <strong>Login successful.</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
        <strong>Wrong credentials!!!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    }

    if ($alert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> Your question is added.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    } ?>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $category_row["category_name"] ?></h1>
            <p class="lead"><?php echo $category_row["category_description"] ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum to share knowledge with others.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
        <?php
        if (isset($_SESSION["loggedIn"])) {
            echo '
        <div>
            <h2>Start a Discussion</h2>
            <form action="' . $_SERVER["REQUEST_URI"] . '" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Problem Title</label>
                    <input type="text" class="form-control" name="title" aria-describedby="titleHelp">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Problem Description</label>
                    <textarea name="description" rows="5" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
        } else {
            echo '<h5 class="m-3 text-danger">Login/Signup to start a discussion.</h5>';
        }
        ?>

        <div>
            <h1 class="m-2">Browse Questions</h1>
            <?php
            while ($thread_row = mysqli_fetch_assoc($thread_result)) {
                $thread_user_id = $thread_row['thread_user_id'];
                $user_query = "SELECT user_email from users WHERE user_id='$thread_user_id'";
                $user_result = mysqli_fetch_assoc(mysqli_query($conn, $user_query));

                echo '<div class="my-5 row">
                <div class="col-auto mx-0">
                    <img src="user.png" width="60px" alt="...">
                </div>
                <div class="col mx-0">
                <div class="row">
                <h5>' . $user_result['user_email'] . '</h5>
                </div>
                <div class="row">
                <a href="thread.php?threadid=' . $id . '" style="font-size:30px">' . $thread_row['thread_title'] . '</a>
                <h5>' . $thread_row['thread_desc'] . '</h5>
                </div>
                </div>
            </div>';
                $no_threads = false;
            }
            if ($no_threads) {
                echo '<h3 class="m-3">No Questions available. Be the first one to ask a question.</h3>';
            }

            ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
<?php
require "partials/_footer.php";
?>