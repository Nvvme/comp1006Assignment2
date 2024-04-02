  <?php
  // to catch any errors that might occur
  session_start();
  $title = 'Game Library';
  include('shared/header.php');

  // Connect to the database
  include('shared/database.php');

  //this is messy, I will figure this out later
  $sql = "SELECT g.game_id, g.title, g.release_year, g.genre, g.developer, g.description, p.name AS platformName, g.photo FROM games g LEFT JOIN platform p ON g.platform_id = p.platform_id";

  // Prepare and execute the SQL statement
  $cmd = $db->prepare($sql);
  $cmd->execute();
  $games = $cmd->fetchAll();

  echo '<h1>Game Library</h1>';
  echo '<table><thead><tr><th>Title</th><th>Photo</th><th>Release Year</th><th>Genre</th><th>Platform</th><th>Developer</th><th>Description</th>';
  if (!empty($_SESSION['userId'])) { // Check if the user is logged in to display the Actions column
      echo '<th>Actions</th>';
  }
  echo '</tr></thead><tbody>';
  // I used the same method that proff used 
  // Loop through the result set and displaying each game
  foreach ($games as $game) {
    echo '<tr>
            <td>' . htmlspecialchars($game['title']) . '</td>
            <td><img src="image/uploads/' . htmlspecialchars($game['photo']) . '" alt="Game Photo" style="width:100px; height:auto;"></td>
            <td>' . htmlspecialchars($game['release_year']) . '</td>
            <td>' . htmlspecialchars($game['genre']) . '</td>
            <td>' . htmlspecialchars($game['platformName']) . '</td>
            <td>' . htmlspecialchars($game['developer']) . '</td>
            <td>' . htmlspecialchars($game['description']) . '</td>';
    // Only show the "Update" and "Delete" options to logged-in users
    if (!empty($_SESSION['userId'])) {
        echo '<td>
                <a href="edit-game.php?game_id=' . $game['game_id'] . '">Update</a> 
                <a href="delete-game.php?game_id=' . $game['game_id'] . '" onclick="return confirm(\'Are you sure you want to delete this game?\');">Delete</a>
              </td>';
    }
    echo '</tr>';
  }

  echo '</tbody></table>'; // Close the table

  // Disconnect from the database
  $db = null;
  include('shared/footer.php');
  ?>
