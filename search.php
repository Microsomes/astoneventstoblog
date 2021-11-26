<?php
session_start();

if (isset($_GET['query'])) {
    $search = $_GET['query'];


    include_once('./includes/connect.php');


 

    



    $filter= $_GET['filter'];

    if($filter =='all'){

        if(isset($_GET['topic'])){
            $topics= $_GET['topic'];
            $query = "SELECT * FROM posts WHERE MATCH(title, body) AGAINST('$search') AND topic_id = $topics";

            echo 1;

        }else{

        $sql = "SELECT * FROM wlv_blogs WHERE title LIKE '%$search%' OR content LIKE '%$search%'";

        $result= $conn->query($sql);
        $blogs= $result->fetchAll(PDO::FETCH_ASSOC);

        }
        
        
    }else{

    //search from wlv_blogs using pdo and with the filter of the search called filter
    $sql = "SELECT * FROM wlv_blogs WHERE $filter LIKE '%$search%' ORDER BY ID DESC";
    $result= $conn->query($sql);
    $blogs= $result->fetchAll(PDO::FETCH_ASSOC);

    }




    
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

    <!--show filter used-->
    <h2 class="text-center text-xl font-bold mb-4">Filter: <?php echo $filter; ?></h2>

   



    

    <?php foreach($blogs as $blog): ?>


        <!--link to blog with a tag-->

        <a href="/blog.php?id=<?php echo $blog['id'];?>"><div class="ml-6 mr-6 cursor-pointer pl-6 pr-6 bg-gray-300 mt-2 p-2 rounded-md">
            
            <?php



            //get the topic of the blog
            $sql = "SELECT * FROM wlv_topic WHERE id=".$blog['topicId'];
            $result= $conn->query($sql);
            $topic= $result->fetch(PDO::FETCH_ASSOC);
        
            
            ?>

            <!--topic name-->
            <h2 class="text-xl font-bold mb-2"><?php echo $topic['name']; ?></h2>


        <?php print_r($blog['title']);?>
        </div></a>

    <?php endforeach; ?>
</div>
    



</body>
</html>