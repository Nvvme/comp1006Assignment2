<?php
$title = 'Register - Game Database';
include('shared/header.php');
$message = ''; // Initialize a message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture form inputs
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $good = true; // again changing ok to good for a bit of variety

    // Validate inputs
    if (empty($username)) {
        $message .= 'Email is required.<br />';
        $good = false;
    }

    if (strlen($password) < 8 || !preg_match("/[a-z]/", $password) || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
        $message .= 'Password must be at least 8 characters long, include a digit, an upper-case letter, and a lower-case letter.<br />'; // found something that I can do differently
        $good = false;
    }

    if ($password !== $confirm) {
        $message .= 'Passwords do not match.<br />';
        $good = false;
    }

    if ($good) {
        require 'shared/database.php';
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $passwordHash, PDO::PARAM_STR, 255);
        $cmd->execute();

        $db = null;

        // I think this is nice for the User Experience
        header('Location: login.php?message=Registration successful');
        exit;
    }
}
?>
<h2>User Registration</h2>
<!-- Display validation message -->
<div><?php echo $message; ?></div>
<form method="post">
    <fieldset>
        <label for="username">Email Address:</label>
        <input name="username" id="username" required type="email" placeholder="yourname@example.com" />
    </fieldset>
    <fieldset>
        <label for="password">Create Password:</label>
        <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
    </fieldset>
    <fieldset>
        <label for="confirm">Confirm Password:</label>
        <input type="password" name="confirm" id="confirm" required />
    </fieldset>
    <button type="submit" class="offset-button">Register</button>
</form>
<?php include('shared/footer.php'); ?>
