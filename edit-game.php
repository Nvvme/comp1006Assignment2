<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL); // added the above to catch the errors
$title = 'Edit Game'; // Dynamic page title like always
include('shared/header.php'); // Included the header
include('shared/authentication.php');

$gameId = $_GET['game_id'];

$name = $releaseYear = $genre = $platformId = $developer = $description = $photo = null;
// pretty cool way to do it eh
// added photo

if (is_numeric($gameId)) {
    try {
        require 'shared/database.php'; // Ensuring the database connection is established

        $sql = "SELECT * FROM games WHERE game_id = :game_id";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':game_id', $gameId, PDO::PARAM_INT);
        $cmd->execute();
        $game = $cmd->fetch(); // Fetching a single record

        //pre-population stuff
        $title = $game['title'];
        $releaseYear = $game['release_year'];
        $genre = $game['genre'];
        $platformId = $game['platform_id'];
        $developer = $game['developer'];
        $description = $game['description'];
        $photo = $game['photo'];
    } catch (Exception $e) {
        header('location:error.php');
        exit();
    }
}
?>

<!--using the same method I used in my assignment 1-->
<h2>Edit Game Details</h2>
<form method="post" action="update-game.php" enctype="multipart/form-data">
    <div>
        <label for="title">Game Name: *</label>
        <input name="title" id="title" required value="<?php echo htmlspecialchars($title); ?>" />
    </div>
    <div>
        <label for="release_year">Release Year: *</label>
        <input name="release_year" id="release_year" required type="number" min="1950" value="<?php echo htmlspecialchars($releaseYear); ?>" />
    </div>
    <div>
        <label for="genre">Genre: *</label>
        <input name="genre" id="genre" required value="<?php echo htmlspecialchars($genre); ?>" />
    </div>
    <div>
        <label for="platform_id">Platform: *</label>
        <select id="platform_id" name="platform_id" required>
            <?php
            // Fetch platforms from the database to populate the dropdown
            $sql = "SELECT * FROM platform ORDER BY name";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $platforms = $stmt->fetchAll();

            foreach ($platforms as $platform) {
                // looks pretty complex huh
                echo '<option value="' . htmlspecialchars($platform['platform_id']) . '">' . htmlspecialchars($platform['name']) . '</option>';
            }
            ?>
        </select>
    </div>
    <div>
        <label for="developer">Developer:</label>
        <input name="developer" id="developer" value="<?php echo htmlspecialchars($developer); ?>" />
    </div>
    <input type="hidden" name="game_id" value="<?php echo $gameId; ?>" />
    <div>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" />
        <input type="hidden" id="currentPhoto" name="currentPhoto" value="<?php echo $photo; ?>" />
        <?php if (!empty($photo)): ?>
            <img src="image/uploads/<?php echo $photo; ?>" alt="Game Photo" style="width:100px; height:auto;">
        <?php endif; ?>
        </div>
    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description"><?php echo htmlspecialchars($description); ?></textarea>
    </div>
    <input type="hidden" name="game_id" id="gameId" value="<?php echo $gameId; ?>" />
    <button type="submit">Update Game</button>
</form>

<?php include('shared/footer.php'); // Including the footer ?>
