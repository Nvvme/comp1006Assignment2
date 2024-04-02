<?php
// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Capture form inputs
$username = $_POST['username'];
$password = $_POST['password'];

// Connect to the database
include('shared/database.php');

// Prepare and execute the query to find the user by username
$sql = "SELECT userId, username, password, last_login FROM users WHERE username = :username"; 
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();
$user = $cmd->fetch(); 

// Redirect if no user found or if the password doesn't match
if (!$user || !password_verify($password, $user['password'])) {
    $db = null; // Close database connection
    header('location:login.php?invalid=true');
    exit;
} else {
    // If login is valid, update last login time
    $sqlUpdate = "UPDATE users SET last_login = NOW() WHERE userId = :userId";
    $cmdUpdate = $db->prepare($sqlUpdate);
    $cmdUpdate->bindParam(':userId', $user['userId'], PDO::PARAM_INT);
    $cmdUpdate->execute();

    // Start a session and store user identity
    session_start();
    $_SESSION['userId'] = $user['userId'];
    $_SESSION['username'] = $username;
    $_SESSION['lastLogin'] = $user['last_login'];
    
    $db = null; // Close database connection
    header('location:index.php'); // Redirect to the main page or dashboard
    exit;
}
?>
