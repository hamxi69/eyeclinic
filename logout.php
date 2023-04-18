<?php
$_SESSION = array();
session_destroy();

// Set the expiration date for the session cookie to a past date
setcookie(session_name(), '', 1, '/');

// Prevent browser caching of the logout page
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect the user to the login page
header("Location:login.php");
exit;
?>