<?php
session_start();
$curNav="home";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--link tailwind cdn-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Culture</title>
    <style>
    *{
        padding:0;
        margin:0;
        font-family: 'Roboto', sans-serif;
    }
    
    #signInBox{
        display: flex;;
        flex-flow: column;
    }
    #logInButtonContainer{
        display: flex;
        flex-flow: column;
    }

    </style>
</head>
<body>

 <div style="display:flex;flex-flow:column;height:100vh;overflow:hidden">

    <?php include_once("./includes/header.php") ?>

    <div style="flex-grow:1;
    background-image:url('https://firebasestorage.googleapis.com/v0/b/wlvuni-d24d6.appspot.com/o/university_of_wolverhampton.jpg?alt=media&token=777f4480-6ab9-42e7-80df-4baa7323f027');
    background-repeat:no-repeat;background-size:cover;

    display:flex;align-items:center;justify-content:center;
  

    ">
    
        <div style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;background:none;border-radius:10px;padding:20px;background:black">
            <h1 class="text-center" style="color:white">Welcome to <span style="font-weight: bold;color:orange">WLVBlogs</span></h1>

            <div class="text-center" style="display:flex;justify-content:space-around">
                <a class="text-center" href="blogs.php"><button style="border-radius:20px;" class="btn">
                Check out the Blogs
                </button></a>
             </div>
        
        </div>

</div>


</div>
</body>