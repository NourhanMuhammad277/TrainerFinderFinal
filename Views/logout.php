<?php
session_start();

// Destroy all session data
session_destroy();

// Redirect to login page or homepage
header("Location: LoginSignupView.php");
exit;
?>
