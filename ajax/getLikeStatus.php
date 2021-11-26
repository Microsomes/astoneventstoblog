<?php
//allow error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../includes/connect.php';

$inputJSON = file_get_contents('php://input');

$input = json_decode($inputJSON, TRUE); //convert JSON into array

//get into wlv_likes_comments status using pdo
$sql = "SELECT * FROM wlv_likes_comments WHERE commentid = :comment_id AND userid = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':comment_id', $input['commentid']);
$stmt->bindParam(':user_id', $input['userid']);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($row,true);



?>