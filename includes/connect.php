<?php

//enable erros
error_reporting(E_ALL);

$servername = "localhost";
$username = "mag";
$password = "magpass";
 

try {
  $conn = new PDO("mysql:host=$servername;dbname=newblog2", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch(PDOException $e) {
 }
  ?>

 