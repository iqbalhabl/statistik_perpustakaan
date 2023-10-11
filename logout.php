<?php
session_start(); // Start session

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // User is logged in, so log them out
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session

    // Redirect to the login page after logging out
    header("Location: index.php");
    exit();
}
?>