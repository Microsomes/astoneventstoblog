<?php
//allow error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../includes/connect.php';

$inputJSON = file_get_contents('php://input');

$input = json_decode($inputJSON, TRUE); //convert JSON into array




$sql = "SELECT * FROM wlv_comments WHERE blogId=:id ORDER BY id desc";


if(isset($input['parent'])){
    $sql2="SELECT wlv_comments.*, wlv_users.username FROM `wlv_comments` INNER JOIN wlv_users ON wlv_comments.userId= wlv_users.id WHERE wlv_comments.blogId=:id AND wlv_comments.parent=:parent order by id desc";

    $stmt = $conn->prepare($sql2);
    $stmt->execute(['id'=>$input['blogId'],'parent'=>$input['parent']]);
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
    echo json_encode($comments,true);
    
    
}else{
    $sql2="SELECT wlv_comments.*, wlv_users.username FROM `wlv_comments` INNER JOIN wlv_users ON wlv_comments.userId= wlv_users.id WHERE wlv_comments.blogId=:id AND parent is null  order by id desc";

$stmt = $conn->prepare($sql2);
$stmt->execute(['id'=>$input['blogId']]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($comments,true);


}





?>