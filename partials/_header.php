<?php
session_start();
if(!isset($query)){
  $query=" ";
}
echo '
<nav class="navbar navbar-expand-lg bg-dark navbar-dark" style="box-shadow: #b7b5b5 0px 0px 40px;z-index:2">
  <div class="container-fluid">
    <a class="navbar-brand" href="/forum">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/forum">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
          ';
            $cat_query = "SELECT category_name,category_id from categories LIMIT 3";
            $cat_result = mysqli_query($conn, $cat_query);
            while ($row = mysqli_fetch_assoc($cat_result)) {
              echo '<li><a class="dropdown-item" href="threadList.php?catid=' . $row["category_id"] . '">' . $row['category_name'] . '</a></li>';
            };
            echo '</ul></li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>
      <form class="d-flex col" action="search.php" method="GET">
        <input class="form-control me-2" name="search" type="search" value="'.$query.'" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      </div>
      ';
      if (!isset($_SESSION["loggedIn"]) && !$_SESSION["loggedIn"] == true) {
      echo '
      <div class="row">
      <button class="col btn btn-outline-warning mx-2" type="submit" data-bs-toggle="modal" data-bs-target="#loginModal">LogIn</button>
      <button class="col btn btn-outline-warning mx-2" type="submit" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>
    </div>';
      } else {
      echo '
      <div class="row">
      <a href="partials/_logout.php" role="button"><button class="col btn btn-outline-warning mx-2" type="submit">LogOut</button></a>
      </div>';
        }
      echo '
  </div>
</nav>';
