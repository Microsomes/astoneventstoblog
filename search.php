<?php
session_start();

if (isset($_GET['query'])) {
    $search = $_GET['query'];


    include_once('./includes/connect.php');

    //search from wlv_blogs uding pdo
    $sql = "SELECT * FROM wlv_blogs WHERE title LIKE '%$search%' OR content LIKE '%$search%'";
    $result = $conn->query($sql);
    $blogs = $result->fetchAll(PDO::FETCH_ASSOC);



    
}else{
    header("Location: blogs.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--add tailwindcss cdn-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@^1.0/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <title>Search Results</title>
</head>
<body>

    <?php
        include_once('./includes/header.php');
    
    ?>

<div class="container mx-auto mt-6">
    
    <!--search results title-->
    <h1 class="text-center text-2xl font-bold mb-4">Search Results</h1>

    <?php foreach($blogs as $blog): ?>
        <div class="ml-6 mr-6 cursor-pointer pl-6 pr-6 bg-gray-300 mt-2 p-2 rounded-md">
        <?php print_r($blog['title']);?>
        </div>

    <?php endforeach; ?>
</div>
    



</body>
</html>