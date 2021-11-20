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
    background-image:url('https://firebasestorage.googleapis.com/v0/b/skycoin-f383f.appspot.com/o/bckground.png?alt=media&token=0fbfb5cd-3f36-4851-8354-4f35167fa262');
    background-repeat:no-repeat;background-size:cover;

    display:flex;align-items:center;justify-content:center;
  

    ">
    
        <div style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;background:none;border-radius:10px;padding:20px;">
            <h1 style="color:white">Welcome to <span style="font-weight: bold;color:orange">WLVBlogs</span></h1>

            <div style="display:flex;justify-content:space-around">
                <a href="
                "><button style="border-radius:20px;" class="btn">
                Check out the Blogs
                </button></a>
             </div>
        
        </div>

</div>


</div>
</body>