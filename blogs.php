<?php
session_start();

$curNav="sports";

include_once("./includes/connect.php");
//connects to the database as we need to grab the events




$events = $conn->query("SELECT * FROM event WHERE eventypeid=1  ORDER BY eventid DESC")->fetchAll();

//print_r(sizeof($events));


 

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
    <title>Sports</title>
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


    <div style="height:200px;display:flex;align-items:center;justify-content:center;">
        <h1 style="color:White;">Recent Blogs</h1>
    </div>

    <div style="display:flex;flex-wrap:wrap;padding:30px;justify-content:Center;">

    <?php foreach($events as $event):?>
  
    <div style="display:flex;flex-flow:column;background-image:url('<?php echo $event['eventPicture'];?>');border-radius:10px;width:300px;min-height:300px;background:black;margin-left:20px;margin-top:20px">
    
    <a href="event.php?eventid=<?php echo $event['eventid'];?>"><p style="text-align: center;font-size:20px;margin-top:20px;color:white"> <?php echo $event['name']?></p></a>
   
   
    <p style="text-align: center;font-size:20px;margin-top:20px;color:white;padding:5px;"> <?php echo substr($event['description'],0,40);?>...</p>
    <p style="text-align: center;font-size:20px;margin-top:20px;font-size:12px;color:white"> <?php echo $event['time']?></p>
    
    <p style="color:white;text-align:center;margin-top:20px">
    (<?php
    //calculate like count
        $evID=$event['eventid'];
        $stmt = $conn->prepare("SELECT COUNT(likesid) as 'total'  FROM likes WHERE postid=?");
        $stmt->execute([$evID]); 
        $allLikes = $stmt->fetchAll();

     
       $totalLikes=$allLikes[0]['total'];
        //stores the total like count

        echo $totalLikes;
 
    ?>) Likes
    </p>
        
        <a style="text-align: center;" href="event.php?eventid=<?php echo $event['eventid'];?>"><button class="btn" style="margin-left:20px;margin-right:20px;margin-top:10px;border-radius:10px;">
        More Details
        </button></a>
    
        <div style="flex-grow: 1;"></div>
        <div style="margin-bottom: 20px;display:flex;align-items: center;justify-content:Center;">
          </div>
    </div>
    <?php endforeach;?>
     
    </div>
   
    

    
   
    </div>

 </div>