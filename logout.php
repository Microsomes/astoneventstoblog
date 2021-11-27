<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
session_unset();

echo 1;
//perform logout logic

header("Location: signin.php")
 
?>