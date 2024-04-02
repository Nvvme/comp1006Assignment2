<?php
// Set the title of the webpage
$title = 'Register - Game Database';
require 'shared/header.php';
if (!empty($_GET['duplicate'])) {
    echo '<h3 class="error">Username already exists. Please choose a different one.</h3>';
}
?>

<!-- Display registration heading -->
<h2>Create Your Account</h2>
<p>Become a part of my neat little Assignment! Register to share and discover great games.</p>


<form method="post" action="save-registration.php">
  <!-- Define a fieldset for related form controls -->
  <fieldset>
    <!-- Label for Email Address input -->
    <label for="username">Email Address:</label>
    <input name="username" id="username" required type="email" placeholder="yourname@example.com" />
  </fieldset>

  <fieldset>
    <label for="password">Create Password:</label>
    <div class="password-container">
        <input type="password" name="password" id="password" required
          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" />
        <button type="button" id="togglePassword" class="toggle-password">👁</button> <!--pretty cool right-->
    </div>
</fieldset>

<fieldset>
    <label for="confirm">Confirm Password:</label>
    <div class="password-container">
        <input type="password" name="confirm" id="confirm" required
          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        <button type="button" class="toggle-password">👁</button>
    </div>
</fieldset>

  <!-- Button element for Registration -->
  <button type="submit" class="offset-button">Register</button>
</form>

<!-- Included footer element -->
<?php include('shared/footer.php'); ?>