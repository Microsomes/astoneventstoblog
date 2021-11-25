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

//get wlv_blogs
$sql2="SELECT wlv_blogs.*, wlv_users.username,wlv_topic.name FROM wlv_blogs INNER JOIN wlv_users ON wlv_blogs.userId= wlv_users.id INNER JOIN wlv_topic ON wlv_topic.id= wlv_blogs.topicId ORDER BY id desc";

$stmt = $conn->prepare($sql2);
$stmt->execute();
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);



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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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

 <div style="display:flex;flex-flow:column;overflow:hidden">

    <?php include_once("./includes/header.php") ?>



    <div class="h-96 flex items-center justify-center  text-6xl bg-blue-400 w-screen">

        <h2 class=" pointer text-white">Recent Submitted Blogs</h2>

    </div>

    <div>

    <?php foreach($blogs as $blog): ?>
        <a href="blog.php?id=<?php  print_r($blog['id']);?>"><div  class="hover:bg-gray-400 ml-6 mr-6 cursor-pointer pl-6 pr-6 bg-gray-300 mt-2 p-2 rounded-md">

        <p class="font-bold text-xl"><?php print_r($blog['username']);?></p>
        <!-- <p class="text-sm"><?php print_r($blog['createdAT']);?></p> -->

        <!--Calculate the difference timing createdAT from Now-->
        <?php
        $now = new DateTime();
        $createdAT = new DateTime($blog['createdAT']);
        $diff = $createdAT->diff($now);
        print_r($diff->format("%d days, %h hours, %i minutes"));
        ?>

        <br>
       <p class="text-3xl"> <?php print_r($blog['title']);?></p>
         
        </div></a>
        <?php endforeach; ?>

    </div>

    <div>

   




    </div>

 </div>

