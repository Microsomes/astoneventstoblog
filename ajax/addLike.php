<?php
//allow error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../includes/connect.php';

$inputJSON = file_get_contents('php://input');

$input = json_decode($inputJSON, TRUE); //convert JSON into array


print_r($input);

//insert into wlv_blogs

// $sql = "INSERT INTO wlv_blogs (`title`, `author`, `content`, `topicId`, `userid`) VALUES (?,?,?,?,?)";
// $stmt= $conn->prepare($sql);
// $stmt->execute([$input['title'],$input['author'],$input['content'],$input['topicId'],$input['userid']]);

// $id = $conn->lastInsertId();

// echo json_encode(['id'=>$id]);




?>