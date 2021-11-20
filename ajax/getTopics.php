<?php
//allow error
error_reporting(E_ALL);
include_once '../includes/connect.php';


//get wlv_topic


$stmt = $conn->prepare("SELECT * FROM wlv_topic");
$stmt->execute(); 
$topics = $stmt->fetchAll(PDO::FETCH_ASSOC);




$myJSON = json_encode($topics);

echo $myJSON;




?>