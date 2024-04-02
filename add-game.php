<?php
$title = 'Add New Game';
include('shared/header.php'); // included the header file
include('shared/authentication.php');
require 'shared/database.php';

?>
<h2>Add New Game</h2>
<form action="insert-game.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="title">Game Name:</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div>
        <label for="release_year">Release Year:</label>
        <input type="number" id="release_year" name="release_year" required min="1950" max="<?= date('Y') ?>">
    </div>
    <div>
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required>
    </div>
    <div>
        <label for="platform_id">Platform:</label>
        <select id="platform_id" name="platform_id" required>
            <?php
                     try {
            // Fetch platforms from the database to populate the dropdown
            $sql = "SELECT * FROM platform ORDER BY name";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $platforms = $stmt->fetchAll();

            foreach ($platforms as $platform) {
                // looks pretty complex huh
                echo '<option value="' . htmlspecialchars($platform['platform_id']) . '">' . htmlspecialchars($platform['name']) . '</option>';
            }
        } catch (Exception $e) {
            echo '<option value="">Error loading platforms</option>';
            }
            ?>
        </select>
    </div>
    <div>
        <label for="developer">Developer:</label>
        <input type="text" id="developer" name="developer">
    </div>
    <div>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" />
    </div>
        </br>
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
    </div>
    <button type="submit">Add Game</button>
</form>
<!-- Created the form that will be on the webpage, on the frontend -->
<?php include('shared/footer.php'); // linked my footer ?>
