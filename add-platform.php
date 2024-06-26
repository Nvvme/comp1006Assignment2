<?php
$title = 'Add New Platform';
include('shared/header.php'); // Linked the header
include('shared/authentication.php');
?>

<h2>Add New Platform</h2>
<!-- Display error message if any -->
<?php if (isset($_GET['error'])): ?>
    <div style="color: red;">
        Error: <?= htmlspecialchars($_GET['error']); ?>
    </div>
<?php endif; ?>

<form action="insert-platform.php" method="post">
    <div>
        <label for="name">Platform Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <button type="submit">Add Platform</button>
</form>
<!-- there are some things that I still don't understand, but this was a fun assignment and it made me learn
a lot of things-->
<?php
include('shared/footer.php'); // Linked the footer
?>
