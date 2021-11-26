<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once './includes/connect.php';

$curNav="current_blog";

if (!isset($_SESSION['userid'])) {
    header("Location: signin.php");
}

$error=null;
$successInsert=null;
$lastInsertId=null;

if (isset($_GET['id'])) {
    $id=$_GET['id'];

    //get wlv post
    $sql = "SELECT * FROM wlv_blogs WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id'=>$id]);
    $wlvPost = $stmt->fetch(PDO::FETCH_ASSOC);


    $dateHappening=date("Y-m-d", strtotime($wlvPost['createdAT']));

    //get topic id
    $topicId=$wlvPost['topicId'];

    //get topic
    $sql = "SELECT * FROM wlv_topic WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id'=>$topicId]);
    $topic = $stmt->fetch(PDO::FETCH_ASSOC);


    //LOAD comments wlv_comments
    $sql = "SELECT * FROM wlv_comments WHERE blogId=:id ORDER BY id desc";


    $sql2="SELECT wlv_comments.*, wlv_users.username FROM `wlv_comments` INNER JOIN wlv_users ON wlv_comments.userId= wlv_users.id WHERE wlv_comments.blogId=:id order by id desc";


    $stmt = $conn->prepare($sql2);
    $stmt->execute(['id'=>$id]);
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);



}else{
    header("Location: myposts.php");
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
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>


    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>My Posts</title>
    <style>
    *{
        padding:0;
        margin:0;
        font-family: 'Roboto', sans-serif;
    }
    

    </style>
</head>
<body>

 <div style="display:flex;flex-flow:column;overflow:auto">

    <?php include_once("./includes/header.php") ?>



    <div class="h-96 flex items-center justify-center  text-6xl bg-blue-400 w-screen">

        <h2 class="text-center flex items-center justify-center pointer text-white">

            <?php
            print_r($wlvPost['title']);
            ?>

        </h2>

    </div>

    <div class=" flex justify-around bg-black rounded-md p-2 ml-12 mr-12 mt-2 shadow-xl text-white">
    
    <div><?php print_r($dateHappening)?></div>
    <div class="uppercase"><?php print_r($topic['name'])?></div>
    
    
    </div>

    <div>
       <p class="flex items-center justify-center p-12 text-xl">
              <?php
              print_r($wlvPost['content']);
              ?>
       </p>
    </div>


    <div id="app" class="container mx-auto pl-6 pr-12 ">

        <p class="text-xl">
            <span class="font-bold">Comment Section: </span> <span>{{this.comments.length}} Comments</span></p>


        <form @submit.prevent="createComment">
            <input v-model="commentValue" type="text" placeholder="Make a comment?"/>
        </form>

        <div class="pl-6 pb-2 bg-gray-100 shadow-xl m-2 rounded-md text-2xl flex flex-col  " v-for="comment in comments">
            <p class="text-sm text-gray-800 uppercase">{{comment.username}}</p>
            <p class="text-sm text-gray-500">{{comment.createdAT}}</p>
            <p class="break-all">{{comment.comment}} </p>
            <div class="h-1 bg-gray-200"></div>
        </div>



    </div>


    <script>
            var app = new Vue({
            el: '#app',
            data: {
                comments:<?php echo json_encode($comments,true);?>,
                blogid:<?php print_r($id)?>,
                commentValue:''
            },
            methods:{
                getAllComments(){
                    axios.post('ajax/getComments.php',{
                        blogId:this.blogid
                    }).then(response=>{
                        this.comments=response.data;
                    }).catch(error=>{
                        console.log(error);
                    })
                    
                },
                createComment(){
                    var commentVal=this.commentValue;

                    axios.post('ajax/createComment.php',{
                        "comment":this.commentValue,
                        "userId":<?php echo $_SESSION['userid'];?>,
                        "blogId":this.blogid,
                    }).then(data=>{
                        this.commentValue='';
                        this.getAllComments();
                    });
                }
            }
            })


    </script>

 </div>

