<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  header("Location: ../account.php");

  $uploadOk = 0;
}


// Check file size
if ($_FILES["file"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
    log_background($target_file);
   
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}



function log_background($imagepath){
  include_once('../includes/connect.php');

  $userid=$_SESSION['userid'];

  //update wlv_users with new profileimage using pdo
  $sql = "UPDATE wlv_users SET profileimage = :imagepath WHERE id = :userid";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':imagepath', $imagepath);
  $stmt->bindParam(':userid', $userid);
  $stmt->execute();



  print_r($imagepath);


  header("Location: ../account.php");
}

?>