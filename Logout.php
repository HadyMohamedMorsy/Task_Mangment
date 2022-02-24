<?php



session_start();
// session

// session



// remove all session variables
session_unset();

// destroy the session
session_destroy();

header("Location: " . $_SERVER["HTTP_REFERER"]);

// if ($_SERVER["HTTP_REFERER"] == '/H-A/Admin-system.php') {
//     header('Location: index.php');
// }else {
//     header("Location: " . $_SERVER["HTTP_REFERER"]);
// }
//header("location: index.php");
?>