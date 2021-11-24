<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once './includes/connect.php';

$curNav="blogs";

if (!isset($_SESSION['userid'])) {
    header("Location: signin.php");
}

$error=null;
$successInsert=null;
$lastInsertId=null;

if (isset($_POST) &&  count($_POST)>=1){



if (
    isset($_POST['title'])
    && isset($_POST['content'])
    && isset($_POST['topicOption'])
){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $topicOption = $_POST['topicOption'];


    //insert in to wlv_blogs
    $sql = "INSERT INTO wlv_blogs (`title`, `author`, `content`, `topicId`, `userid`) VALUES (?,?,?,?,?)";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$title,$_SESSION['username'],$content,$topicOption,$_SESSION['userid']]);

    $id = $conn->lastInsertId();

    $successInsert=true;
    $lastInsertId=$id;


    $error=null;
}else{

   $error="Please fill in all fields";
}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>My Posts</title>
    <style>
    *{
        padding:0;
        margin:0;
        font-family: 'Roboto', sans-serif;
    }
    

    </style>
</head>
<body>

 <div style="display:flex;flex-flow:column;height:100vh;overflow:hidden">

    <?php include_once("./includes/header.php") ?>



    <div class="h-96 flex items-center justify-center  text-6xl bg-blue-400 w-screen">

        <h2 class=" pointer text-white">Recent Submitted Blogs</h2>

    </div>

    <div>

   




    </div>

 </div>

