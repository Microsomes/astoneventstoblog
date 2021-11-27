<?php
//allow error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once ('../includes/connect.php');

$inputJSON = file_get_contents('php://input');

$input = json_decode($inputJSON, TRUE); //convert JSON into array



function add_comment_like($comment_id, $user_id,$val) {

    //insert into wlv_likes_comments using pdo
    global $conn;

    //dublicate check
    $sql = "SELECT * FROM wlv_likes_comments WHERE commentId = :comment_id AND userId = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['comment_id'=>$comment_id, 'user_id'=>$user_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

   if($result){
        //update
        $sql = "UPDATE wlv_likes_comments SET val = :val WHERE commentId = :comment_id AND userId = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['val'=>$val, 'comment_id'=>$comment_id, 'user_id'=>$user_id]);

   }else{
    $sql = "INSERT INTO wlv_likes_comments (commentId, userId, val) VALUES (:comment_id, :user_id, :val)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(
        ':comment_id' => $comment_id,
        ':user_id' => $user_id,
        ':val' => $val
    ));
}



}


if(isset($input['type'])){
    $type = $input['type'];

    switch($type){
        case 'comment':
            add_comment_like($input['commentid'], $input['userid'],$input['val']);
            break;
        }
}



?>