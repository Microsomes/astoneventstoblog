<?php


if(isset($_GET['id'])){
    $blogid= $_GET['id'];

    include_once('./includes/connect.php');

    //wlv_blog update published to 1 using pdo
    $sql = "UPDATE wlv_blogs SET published = 0 WHERE id = :blogid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':blogid', $blogid, PDO::PARAM_INT);
    $stmt->execute();

    echo $blogid;

    header('Location: myblogs.php');
}


?>