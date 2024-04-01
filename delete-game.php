<?php
include('shared/authentication.php');
// Getting the gameId from the URL parameter using $_GET. As we did in Lesson 6, I think. I am just following a similar approach to what prof did.
$gameId = $_GET['game_id'];

// Check if gameId is a valid number
if (is_numeric($gameId)) {
    // Include the database connection
    require 'shared/database.php'; // I just learned that we can use require here too.

    // The usual Stuff..
    $sql = "DELETE FROM games WHERE game_id = :game_id";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':game_id', $gameId, PDO::PARAM_INT);
    $cmd->execute();

    // Disconnect from the database
    $db = null;

    echo 'Game Deleted';

    // Redirect back to the updated game list
    header('Location: game-list.php?message=GameDeleted');
    exit;
} else {
    header('Location: game-list.php?error=InvalidGameID');
    exit;
}
// prof did say that this redirecting stuff is weird in php
?>
