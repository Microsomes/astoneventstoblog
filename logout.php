<?php
session_start();
session_unset(true);

echo 1;
//perform logout logic

header("Location: signin.php")
 
?>