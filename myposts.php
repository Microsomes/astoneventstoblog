<?php
session_start();
$curNav="myposts";
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

        <form class="p-12">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Title
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Blog Title... ">
            </div> 
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Content
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Blog Title... "></textarea>
            </div> 


            <div class="relative">

            <label class="block 	 text-gray-700 text-sm font-bold mb-2" for="username">
                    Topic
                </label>


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


                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="topicOptions">
                </select>




        </form>


    </div>

 </div>

