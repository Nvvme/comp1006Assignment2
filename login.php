<?php
// Set the title of the webpage
$title = 'Login - Game Database';
require 'shared/header.php';
?>

<!-- welcome message -->
<h2>Login to Your Account, Adventurer</h2>
<p>Welcome back Gamer(s), please login to your account.</p>

<!-- Create a login form that submits data via POST request to validate.php -->
<form method="post" action="verification.php"> <!-- I was going to use validation.php but that didn't seem right -->
  <fieldset>
    <label for="username">Username (Email):</label>
    <input name="username" id="username" required type="email" placeholder="you@example.com" />
  </fieldset>

  <fieldset class="password-container">
                <label for="loginPassword">Password:</label>
                <input type="password" id="loginPassword" name="password" required>
                <button type="button" class="toggle-password">👁</button>
            </fieldset>

  <!-- Button element for Log In -->
  <button type="submit" class="offset-button">Log In</button>
</form>

<!-- Include footer content after main body content -->
<?php include('shared/footer.php'); ?>