<?php

session_start();
$curNav="myblogs";


    include_once('./includes/connect.php');


    $userid=$_SESSION['userid'];


    // select wlv_blogs from userid with pdo
    $sql = "SELECT * FROM wlv_blogs WHERE userid = :userid order by id desc";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':userid', $userid);
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

<title>My Blogs</title>
    <style>

        #top{
            display:flex;
            flex-flow:column;
            overflow:hidden;
        }
   

    </style>
</head>
<body>

 <div id="top" >

    <?php include_once("./includes/header.php") ?>

    
    <div class="mt-5">
    <?php foreach($blogs as $blog): ?>
        
        <div class=" ml-6 mr-6 cursor-pointer pl-6 pr-6 bg-gray-300 mt-2 p-2 rounded-md">
       
         <?php print_r($blog['title']);?>

         <div class="mt-3">
         <a href="/blog.php?id=<?php echo $blog['id']; ?>"><button  class="bg-green-300 rounded-md p-1">View</button></a>
         <button  class="bg-green-300 rounded-md p-1">Edit</button>
         <a href="/deleteBlog.php?id=<?php echo $blog['id'];?>"><button  class="bg-green-300 rounded-md p-1">Delete</button></a>


         <?php if($blog['published']!=1):?>
             <a href="/publishBlog.php?id=<?php echo $blog['id'];?>"><button  class="bg-green-300 rounded-md p-1">Publish</button></a>
        <?php endif;?>

        <?php if($blog['published']==1):?>
             <a href="/unpublishBlog.php?id=<?php echo $blog['id'];?>"><button  class="bg-green-300 rounded-md p-1">Un-Publish</button></a>
        <?php endif;?>



        </div>

        </div>
     
    <?php endforeach; ?>

    </div>
    








</div>
</body>