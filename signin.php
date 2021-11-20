<?php
session_start();

if(isset($_SESSION['userid'])){
    header("Location: account.php");

}
 
$warning=null;



 

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['method'])){
    $username= $_POST['username'];
    $password= $_POST['password'];
    if(strlen($username)<=5){
        $warning="Username too small";
    }else if(strlen($password)<=5){
        $warning="Password is too short";
    }else{
        $warning=null;

        include_once("./includes/connect.php");


      

        $username= $_POST['username'];
        $password= $_POST['password'];


        
           
            $username= $_POST['username'];
            $password= $_POST['password'];


            
            $stmt = $conn->prepare("SELECT * FROM wlv_users WHERE username=? AND password=?");
            $stmt->execute([$username,$password]); 
            $userLogin = $stmt->fetchAll();


            
   

            if($userLogin){
                $user_id= $userLogin[0]['id'];
                $_SESSION['userid'] = $user_id;
                $_SESSION['username'] = $username;
                //this email was grabbed from the database
                $emailData= $userLogin[0]['email'];
                $_SESSION['time']     = time();

               header("Location: account.php");
    
            }else{
                $warning="Account does not exist, or password is wrong";
            }

            
            
            
        
        
 

        

        //login
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
    <title>Log In</title>
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

 <div style="display:flex;flex-flow:column; background:pink;height:100vh;width:100vw;overflow:hidden">
 
    <?php
    include_once("./includes/header.php");
    ?>
  <div id="body" style="display:flex;align-items:Center;justify-content:center;;background:white;background-repeat: no-repeat;background-size: cover;;flex-grow:1;background-image: url('https://firebasestorage.googleapis.com/v0/b/skycoin-f383f.appspot.com/o/Campus%20exterior%20006.jpg?alt=media&token=ecd2c6b0-fabf-41f3-8f22-be6169e2f4c7')">
            <div id="signInBox" style="padding-left:20px;padding-right:20px;padding-top:20px;  box-shadow: 1px 1px #888888;height:500px;overflow-y:auto;width:700px;background:white;border-radius:10px">

                <form method="POST">
                <div style=" width:100%;padding:5px">
                    <p style="font-weight: bold;">Username</p>
                    <input  value="<?php 
                        if(isset($_POST['username'])){
                            echo $_POST['username'];
                        }
                    ?>" name="username" placeholder="Enter Username" type="text"/>
                </div>
                <div style=" width:100%;padding:5px">
                    <p style="font-weight: bold;">Password</p>
                    <input name="password" placeholder="Enter Password" type="password"/>
                </div>

                

                <div id="logInButtonContainer" style="flex-grow:1">
                    <div>
                        <input name="method" type="submit" value="Sign In" style="width:100%;height:50px" class="btn"/>
                        <!-- <p style="color:#283593;font-weight:600;cursor:pointer;">Forgot Password</p> -->
                    </div>
                    <div  style="padding:50px;align-items:center ;flex-grow:1;display:flex;">
                        <div style="width: 50%;">
                           <!-- <input type="submit" name="method" value="sign up" style="width:80%;background:#e53935" class="btn"/> -->
                        </div>
                        <div style="width: 50%;">
                        <p>
                            <label>
                                <input type="checkbox" checked="checked"   />
                                <span>Remember Me</span>
                            </label>
                            </p>
                        </div>
                    </div>
                
                </div>
                    <?php if($warning) :?>
                    <div style="height:30px;background:yellow;display:flex;align-items: center;justify-content:center;">
                        <p style="font-weight: bold;"><?php echo $warning;?></p>
                    </div>
                    <?php endif;?>

                </form>
                <p>Don't have an account? Sign up <a href="signup.php">Here</a></p>

            </div>
  </div>
 </div>    
</body>
</html>