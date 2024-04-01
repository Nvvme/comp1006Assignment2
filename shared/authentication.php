<?php
// Start the session if it hasn't been started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login page if the user is not logged in
if (empty($_SESSION['userId'])) { // Use user_id for a more reliable check
    header('location:login.php');
    exit(); // Ensure no further code is executed after the redirect
}
// :)
?>
