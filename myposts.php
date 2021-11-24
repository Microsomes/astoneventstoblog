<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once './includes/connect.php';

$curNav="myposts";

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

        <h2 class=" pointer text-white">Create a Blog Post?</h2>

    </div>

    <div>

        <form class="p-12" action="/myposts.php" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Title
                </label>
                <input name="title" id="title" type="text"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Blog Title... ">
            </div> 
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Content
                </label>
                <textarea name="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="content" type="text" placeholder="Blog Title... "></textarea>
            </div> 


            <div class="relative">

            <label class="block 	 text-gray-700 text-sm font-bold mb-2" for="username">
                    Topic
                </label>


            

                <div class="mt-3">
                <select name="topicOption" class="mt-3 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                id="topicOptions">
                </select>
                </div>


                <?php if ($error!=null){ ?>
                <div class=" top-0 right-2 mt-4 mr-4 ml-3 text-red-500 text-sm">
                    <?php echo $error; ?>
                </div>  
                <?php } ?>

                <div class=" px-2 py-4 flex items-center justify-between">
                    <button type="submit" class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                        Publish Post
                    </button>
                </div>

                <?php if ($successInsert): ?>
                <div class="h-18 flex items-center justify-center text-2xl p-1 rounded-md shadow-xl bg-green-400">
                    <p>Success Post Added <a class="underline" href="blog.php?id=<?php echo $lastInsertId;?>">View</a></p>
                </div>
                <?php endif; ?>






        </form>


        <script>

axios.get("/ajax/getTopics.php").then(data=>{
    const topics=data.data;
    //add options too the select #topicOptions
    for(let i=0;i<topics.length;i++){
        const topic=topics[i];
        const option=document.createElement("option");
        option.value=topic.id;
        option.innerText=topic.name;
        document.getElementById("topicOptions").appendChild(option);
    }
});

</script>


    </div>

 </div>

