<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if(!isset($_SESSION['userid'])){
    header("Location: home.php");
}

include_once('./includes/connect.php');

//get profile image using pdo
$sql = "SELECT * FROM wlv_users WHERE id = :userid";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userid', $_SESSION['userid']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);


$profileImage= $result['profileImage'];






$section="interests";

$curNav="account";


if(isset($_GET['section'])){
    $section= $_GET['section'];
}else{
    $_GET['section']=null;
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
    <!--tailwind cdn-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
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

    .active{
        background-color: #f5f5f5;
        border:1px solid lightgray; 
        border-radius: 2px;;
    }

    </style>
</head>
<body style="background-image:url('https://firebasestorage.googleapis.com/v0/b/skycoin-f383f.appspot.com/o/bckground.png?alt=media&token=0fbfb5cd-3f36-4851-8354-4f35167fa262');
    background-repeat:no-repeat;background-size:cover;">

 <div class="h-screen">

    <?php include_once("./includes/header.php") ?>

    <!--accounts page-->
    <div class="container mx-auto">
        <div class="row">
            <div class="col-md-3">
                <div class="card p-12">
                    <div class="card-body">
                        <div class="card-title">
                            <h3><?php echo $_SESSION['username'];?></h3>
                            <div class="h-24 w-24 mt-2 rounded-full bg-black">

                             <img class="w-full h-full rounded-full" src="./includes/<?php echo $profileImage;?>"/>

                             </div>


                        </div>


                        <div class="card-text mt-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link <?php if($_GET['section']=="picture"){echo "active";} ?>" href="account.php?section=picture">Profile Picture</a>
                                </li>
                              
                                <li class="nav-item">
                                    <a target="_blank" class="nav-link <?php if($section=="logout"){echo "active";} ?>" href="logout.php">Logout</a>
                                </li>
                            </ul>
                        </div>


                        
                    </div>
                </div>
            </div>

            


            <?php if(isset($_GET['section'])): ?>
                <?php print_r($_GET['section']);?>
            <div class="col-md-9">
                <div class="card">
                    <div class="p-12 card-body">
                        <div class="card-title">
                        </div>
                        <div class="card-text">
                            <?php
                            if($section=="picture"){
                                
                                include_once("./includes/picture.php");
                                
                                
                            }else if($section=="settings"){
                                include_once("./includes/settings.php");
                            }else if($section=="logout"){
                                include_once("./includes/logout.php");
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
        </div>

    

 
    

 </div>