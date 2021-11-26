<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['id'])){

    include_once ('./includes/connect.php');

    //delete wlv_blogs with pdo
    $stmt = $conn->prepare("DELETE FROM wlv_blogs WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();

    header("Location: myblogs.php");





}else{
    header("Location: myblogs.php");
}


?>