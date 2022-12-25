<?php
if($signup){
    echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
    <strong>Signup successful!!!</strong> You can login usign your email and password.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if($pass_mismatch){
    echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
    <strong>Passwords do not match.</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if($user_exists){
    echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
    <strong>A user already exists with this email!!!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>
