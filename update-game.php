<?php
$title = 'Saving Game Updates...';
include('shared/header.php'); // Including the header as always

// Capture form inputs.. again the usual stuff
$gameId = $_POST['game_id']; // Game ID from the hidden input in the edit form
$title = $_POST['title'];
$releaseYear = $_POST['release_year'];
$genre = $_POST['genre'];
$platformId = $_POST['platform_id'];
$developer = $_POST['developer'];
$description = $_POST['description'];
$good = true; // Flag to check if inputs are valid. lets use something like good instead of ok

// Input validation to ensure data integrity
if (empty($title)) {
    echo 'Game name is required<br />';
    $good = false;
}

if (empty($releaseYear)) {
    echo 'Release year is required<br />';
    $good = false;
} else {
    if (!is_numeric($releaseYear) || $releaseYear < 1950) {
        echo 'Release year must be a number and not before 1950<br />';
        $good = false;
    }
}

if (empty($genre)) {
    echo 'Genre is required<br />';
    $good = false;
}

if (empty($platformId)) {
    echo 'Platform is required<br />';
    $good = false;
}

if ($good) {
    // Database connection
    require 'shared/database.php';

    // SQL UPDATE command setup
    $sql = "UPDATE games SET title = :title, release_year = :releaseYear, 
            genre = :genre, platform_id = :platformId, developer = :developer, 
            description = :description WHERE game_id = :gameId";

    // Preparing SQL statement
    $cmd = $db->prepare($sql);

    // Binding form inputs to SQL command parameters
    $cmd->bindParam(':title', $title, PDO::PARAM_STR, 255);
    $cmd->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
    $cmd->bindParam(':genre', $genre, PDO::PARAM_STR, 255);
    $cmd->bindParam(':platformId', $platformId, PDO::PARAM_INT);
    $cmd->bindParam(':developer', $developer, PDO::PARAM_STR, 255);
    $cmd->bindParam(':description', $description, PDO::PARAM_STR);
    $cmd->bindParam(':gameId', $gameId, PDO::PARAM_INT);

    // Executing the update
    $cmd->execute();

    // Closing the database connection
    $db = null;

    // Confirmation message
    echo 'Game Updated Successfully';

    // Redirecting to the game list page
    header('location:game-list.php');
}
?>
