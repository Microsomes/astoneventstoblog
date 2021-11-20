<?php
session_start();

if(!isset($_SESSION['userid'])){
    header("Location: home.php");
}

$section="interests";

$curNav="account";


if(isset($_GET['section'])){
    $section= $_GET['section'];
}else{
    $_GET['section']="interests";
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
    <title>Account</title>
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
<body style=" background-image:url('https://firebasestorage.googleapis.com/v0/b/skycoin-f383f.appspot.com/o/bckground.png?alt=media&token=0fbfb5cd-3f36-4851-8354-4f35167fa262');
    background-repeat:no-repeat;background-size:cover;">

 <div style="display:flex;flex-flow:column;height:100vh;overflow:auto">

    <?php include_once("./includes/header.php") ?>


    <div style="margin-bottom:20px;flex-flow:column;200px;display:flex;align-items:center;justify-content:center;">
    <h1 style="color:white;">Hello, <?php echo $_SESSION['username'];?></h1>
    <h5 style="color:white;"> <?php echo $_SESSION['email'];?></h5>
        <a href="./logout.php"><button class="btn" style="border-radius: 20px;;"> Log Out</button></a>
        

    </div>

    <div style="margin: 0 auto;width:700px;">
    <div style="display:flex;height:70px;background:black;border-radius:20px">

    <div style="background:<?php

if(isset($_GET['section']) && $_GET['section']=="likedblogs"){
    echo "#558B2F";
}

 ?>;width:50%;display:flex;align-items:center;justify-content:center"><a href="?section=likedblogs" style="color:white;font-size:20px;">Liked Blogs (Interests)</a></div>
    <div style="background:<?php

    if(isset($_GET['section']) && $_GET['section']=="pastComments"){
        echo "#558B2F";
    }
    
     ?>; width:50%;display:flex;align-items:center;justify-content:center"><a href="?section=pastComments" style="color:white;font-size:20px;">Past Comments</a></div>
     
    
    </div>
     

        <?php if($_GET['section']=="likedblogs"): ?>
        <div style="background:white;padding:20px;border-radius:5px;margin-top:20px;">
         <?php include_once("./account_liked_blogs.php")?>
         <?php else: ?>
            <div style="background:white;padding:20px;border-radius:5px;margin-top:20px;">
            <?php include_once("./account_past_comments.php")?>
            </div>
         <?php endif;?>
        </div>


   
    </div>
    

 </div>