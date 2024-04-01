<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nav's Game Database</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Press+Start+2P&display=swap" rel="stylesheet">
    <script src="js/scripts.js" defer> </script>
<!--I found this nice font which really goes with the gaming website aesthetic-->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
</head>
<body>
<header>
    <h1>Nav's Game Database</h1>
    <nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <?php if (!empty($_SESSION['userId'])): ?>
            <!-- Show these links only to logged-in users -->
            <li><a href="add-game.php">Add Game</a></li>
            <li><a href="game-list.php">Game List</a></li>
            <li><a href="add-platform.php">Add Platform</a></li>
            <li><a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a></li>
        <?php else: ?>
            <!-- These links are visible to all visitors -->
            <li><a href="game-list.php">Game List</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>
<!-- I think three pages are fine for what I am trying to do-->
        </ul>
    </nav>
</header>
