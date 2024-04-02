<?php
// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include the header file to add a consistent header part across the pages
include('shared/header.php');

include('shared/authentication.php');

// Check if the form was submitted using the POST method and the 'name' field isn't empty
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['name'])) {
    try {
        // Include the database connection file
        include('shared/database.php');
        
        // Retrieve the 'name' field value from the form submission
        $name = $_POST['name'];

        // SQL statement to insert the new platform name into the 'platform' table
        $sql = "INSERT INTO platform (name) VALUES (:name)";
        
        // Prepare the SQL statement for execution
        $stmt = $db->prepare($sql);
        
        // Bind the 'name' parameter to the corresponding input value, ensuring it's treated as a string
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        
        // Execute the prepared statement
        $stmt->execute();

        // Inform the user that the platform was added successfully
        echo '<p>Platform added successfully.</p>';
        
        // Provide a link to add another platform
        echo '<a href="add-platform.php" style="color: blue; text-decoration: underline; font-weight: bold;">Add another platform</a>';//added inline style

        // Disconnect from the database
        $db = null;

    } catch (Exception $e) {
        // Catch and handle any exceptions/errors during the database operation
        header('location:error.php');
        exit();
    }
} else {
    echo '<p>Name is required.</p>';
}

include('shared/footer.php');
?>
