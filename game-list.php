<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// to catch any errors that might occur
$title = 'Game Library';
include('shared/header.php');

// Connect to the database
include('shared/database.php');

//this is messy, I will figure this out later
$sql = "SELECT g.game_id, g.title, g.release_year, g.genre, g.developer, g.description, p.name AS platformName FROM games g LEFT JOIN platform p ON g.platform_id = p.platform_id";

// Prepare and execute the SQL statement
$cmd = $db->prepare($sql);
$cmd->execute();
$games = $cmd->fetchAll();

echo '<h1>Game Library</h1>';
echo '<table><thead><tr><th>Title</th><th>Release Year</th><th>Genre</th><th>Platform</th><th>Developer</th><th>Description</th></tr></thead><tbody>';
// I used the same method that proff used 
// Loop through the result set and displaying each game
foreach ($games as $game) {
    echo '<tr>
            <td>' . htmlspecialchars($game['title']) . '</td>
            <td>' . htmlspecialchars($game['release_year']) . '</td>
            <td>' . htmlspecialchars($game['genre']) . '</td>
            <td>' . htmlspecialchars($game['platformName']) . '</td>
            <td>' . htmlspecialchars($game['developer']) . '</td>
            <td>' . htmlspecialchars($game['description']) . '</td>
          </tr>';
}


echo '</tbody></table>';

// Disconnect from the database
$db = null;
include('shared/footer.php');
?>
