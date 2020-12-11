<?php
 /**
 * Reset all session details and log the users out
 */

// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header('Location: /');
exit;
?>