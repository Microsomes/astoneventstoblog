<?php
$user_id=$_SESSION['userid'];
$postid= $event['eventid'];


//try and get to see if this post is liked

 //grabs the venue details
 $stmt = $conn->prepare("SELECT * FROM likes WHERE userid_postid=?");
 $stmt->execute([$user_id.$postid]); 
 $likedata = $stmt->fetch();

  

//register a like if posted
if(isset($_POST['userid']) && isset($_POST['postid']) && isset($_POST['type'])){
    //insert 1 like to the database for this user id and postid

    include_once("./includes/connect.php");


    $compositeID= $user_id."".$postid;

    if($_POST['type']=="Like"){
        try{
            $sql = "INSERT INTO likes (userid, postid, userid_postid) VALUES (?,?,?)";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$user_id, $postid, $compositeID]);
        
                 //grabs the venue details
         $stmt = $conn->prepare("SELECT * FROM likes WHERE userid_postid=?");
         $stmt->execute([$user_id.$postid]); 
         $likedata = $stmt->fetch();
        
        
            }catch(Exception $err){
                //probably a duplicate 
            }
    }else{

        $stmt = $conn->prepare("DELETE FROM  likes WHERE userid_postid=?");
        $stmt->execute([$user_id.$postid]); 
                //grabs the venue details
                $stmt = $conn->prepare("SELECT * FROM likes WHERE userid_postid=?");
                $stmt->execute([$user_id.$postid]); 
                $likedata = $stmt->fetch();
     }


    
}

?>

<form method="POST">
 
<?php if($likedata):?>
    <input type="submit" name="type"  style="background:#c62828;border-radius: 20px;margin-top:20px" class="btn btn-warning" value="UnLike"/>
<?php else:?>
     <input type="submit" name="type"  style="background:green;border-radius: 20px;margin-top:20px" class="btn" value="Like"/>
<?php endif;?>
 

<input style="display:none;" name="userid" style="color:white;" type="text" value="<?php echo $user_id;?>"/>
<input  style="display:none;" name="postid" style="color:white;" type="text" value="<?php echo $postid;?>"/>
 </form>
<?php
 ?>