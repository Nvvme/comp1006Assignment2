<?php
include('shared/authentication.php');
// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Getting the gameId from the URL parameter using $_GET. As we did in Lesson 6, I think. I am just following a similar approach to what prof did.
$gameId = $_GET['game_id'];

// Check if gameId is a valid number
if (is_numeric($gameId)) {
    try {
        // Include the database connection
        require 'shared/database.php'; // I just learned that we can use require here too.

        // Prepare the SQL DELETE statement
        $sql = "DELETE FROM games WHERE game_id = :game_id";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':game_id', $gameId, PDO::PARAM_INT);
        
        // Execute the delete operation
        $cmd->execute();

        // Disconnect from the database
        $db = null;

        echo 'Game Deleted';

    
    } catch (Exception $e) {
        // Redirect to a generic error page if an exception is caught
        header('Location: error.php');
        exit;
    }
} else {
    // Redirect back to the game list with an error message if the gameId is not valid
    header('Location: game-list.php?error=InvalidGameID');
    exit;
}
?>
