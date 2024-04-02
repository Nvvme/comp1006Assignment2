<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$title = 'Saving New Game...';
include('shared/authentication.php');
include('shared/header.php');

try {
    $finalName = null; // Default value if no file is uploaded

    // Check if a file is uploaded
    if ($_FILES['photo']['error'] == UPLOAD_ERR_OK && $_FILES['photo']['size'] > 0) {
        $tmp_name = $_FILES['photo']['tmp_name'];
        $type = mime_content_type($tmp_name);

        // Validate file type
        if (in_array($type, ['image/jpeg', 'image/png', 'image/gif'])) {
            $photoName = $_FILES['photo']['name'];
            $finalName = session_id() . '-' . $photoName; // Creating a unique file name based on session
            $uploadPath = 'image/uploads/' . $finalName; // Corrected path to match your folder structure
            move_uploaded_file($tmp_name, $uploadPath);
        } else {
            throw new Exception('Invalid file type. Only JPEG, PNG, and GIF are allowed.'); // Using Exception for error handling
        }
    }

    // Capture form inputs into variables
    $Title = $_POST['title'];
    $releaseYear = $_POST['release_year'];
    $genre = $_POST['genre'];
    $platform_id = $_POST['platform_id'];
    $developer = $_POST['developer'];
    $description = $_POST['description'];
    $ok = true;

    // Input validation 
    if (empty($Title)) { echo 'Game name is required<br />'; $ok = false; }
    if (empty($releaseYear)) { echo 'Release year is required<br />'; $ok = false; }
    else if (!is_numeric($releaseYear) || $releaseYear < 1970) { echo 'Release year must be a number greater than 1969<br />'; $ok = false; }
    if (empty($genre)) { echo 'Genre is required<br />'; $ok = false; }
    if (empty($platform_id)) { echo 'Platform is required<br />'; $ok = false; }

    if ($ok) {
        include('shared/database.php'); // Ensure database connection

        // SQL Insert command
        $sql = "INSERT INTO games (title, release_year, genre, platform_id, developer, description, photo) 
                VALUES (:title, :release_year, :genre, :platform_id, :developer, :description, :photo)";

        $cmd = $db->prepare($sql);
        $cmd->bindParam(':title', $Title, PDO::PARAM_STR, 255);
        $cmd->bindParam(':release_year', $releaseYear, PDO::PARAM_INT);
        $cmd->bindParam(':genre', $genre, PDO::PARAM_STR, 255);
        $cmd->bindParam(':platform_id', $platform_id, PDO::PARAM_INT);
        $cmd->bindParam(':developer', $developer, PDO::PARAM_STR, 255);
        $cmd->bindParam(':description', $description, PDO::PARAM_STR);
        $cmd->bindParam(':photo', $finalName, PDO::PARAM_STR);
        $cmd->execute();
        
        $db = null; // Disconnect from database
        
        echo '<h1>Game Saved Successfully</h1>'; // Confirmation message
    }
} catch (Exception $e) {
    header('location:error.php'); // Redirecting to an error page if any exception is caught
    exit();
}

include('shared/footer.php');
?>
</body>
</html>
