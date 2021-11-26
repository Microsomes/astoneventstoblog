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


    $sql2="SELECT wlv_comments.*, wlv_users.username FROM `wlv_comments` INNER JOIN wlv_users ON wlv_comments.userId= wlv_users.id WHERE wlv_comments.blogId=:id and parent is null order by id desc";


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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


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

    .noselect {
  -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome, Edge, Opera and Firefox */
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

        <div class="pl-6 pb-2 bg-gray-100 shadow-xl m-2 rounded-md text-2xl flex flex-col mt-5  " v-for="comment in comments">
            <p class="text-sm text-gray-800 uppercase">{{comment.username}}</p>
            <p class="text-sm text-gray-500">{{comment.createdAT}}</p>
            <p class="break-all">{{comment.comment}} </p>
            <div class="h-1 bg-gray-200"></div>
            <inner-comment
                :parentid='comment.id'
                :blogid='<?php echo $_GET['id'];?>'
            ></inner-comment>

        </div>




    </div>


    <script>


        Vue.component('inner-comment', {
        data: function () {
            return {
            showComments: false,
            innercomments: [],
            commentValue: '',
            showReply:false,
            currentLikeValue:-1,

            }
        },
        created(){
            console.log("inner")
            this.getAllComments();
            this.getLikeStatus();
        },
        methods:{
            addLike(){
                var home=this;
                axios.post('/ajax/addLike.php',{
                    "type":"comment",
                    "commentid":this.parentid,
                    "userid":<?php echo $_SESSION['userid'];?>,
                    "val":"1"
                }).then(res=>{
                    console.log(res.data)
                   home.getLikeStatus();
                })
            },
            addDislike(){
                var home=this;
                axios.post('/ajax/addLike.php',{
                    "type":"comment",
                    "commentid":this.parentid,
                    "userid":<?php echo $_SESSION['userid'];?>,
                    "val":"0"
                }).then(res=>{
                    console.log(res.data)
                   home.getLikeStatus();
                })
            },
            getLikeStatus(){
                var home=this;
                axios.post('/ajax/getLikeStatus.php',{
                    "type":"comment",
                    "commentid":this.parentid,
                    "userid":<?php echo $_SESSION['userid'];?>
                }).then(res=>{
                    console.log(res.data)
                    if(res.data){
                        home.currentLikeValue=res.data.val;
                    }else{
                        return;
                    }
                  
                })
                
            },
            getAllComments(){
                    axios.post('ajax/getComments.php',{
                        blogId:this.blogid,
                        parent:this.parentid
                    }).then(response=>{
                        this.innercomments=response.data;
                    }).catch(error=>{
                        console.log(error);
                    })
                    
                },
            createComment: function () {
               
                var home=this;
                axios.post('ajax/createComment.php', {
                    "comment":this.commentValue,
                    "userId":<?php echo $_SESSION['userid'];?>,
                    "blogId":this.blogid,
                    "parent":this.parentid
                })
                .then(function (response) {
                    console.log(response);
                    home.commentValue = '';
                    home.getAllComments();
                    home.showReply=false;
                    this.showComments=true;

                })
                .catch(function (error) {
                    console.log(error);
                });
            }
            
     
        
        },
        props:['parentid','blogid'],
        template: `
        <div class="noselect">

        
        <!--create like count and dislike count and reply button-->
        <div class="flex">

        <div @click="addLike" class="flex items-center m-2 cursor-pointer">
            <i :class="{'text-gray-500':currentLikeValue==1}" class="material-icons text-gray-300">thumb_up</i>
        </div>

        <div @click="addDislike" class="flex items-center m-2 cursor-pointer">
            <i :class="{'text-gray-500':currentLikeValue==0}" class="material-icons text-gray-300">thumb_down</i>
        </div>

        <div class="flex items-center m-2 cursor-pointer">
            <i @click="showReply=true" class="material-icons text-gray-300">reply</i>
            <div class="ml-2 text-xl text-gray-500">{{innercomments.length}}</div>
        </div>
        </div>

        <!--show reply input-->
        <div v-if="showReply">
        <form @submit.prevent="createComment">
            <input v-model="commentValue" type="text" placeholder="Make a comment?"/>
        </form>
        </div>

       <p class="text-sm cursor-pointer" @click="showComments=!showComments"> <span v-if="showComments==false">Show</span> <span v-else>Hide</span> {{innercomments.length}} Reply </p>
       
        <div  v-if="showComments" class="pl-6 pb-2 bg-gray-100 shadow-xl m-2 rounded-md text-2xl flex flex-col  " v-for="comment in innercomments">
            <p class="text-sm text-gray-800 uppercase">{{comment.username}}</p>
            <p class="text-sm text-gray-500">{{comment.createdAT}}</p>
            <p class="break-all">{{comment.comment}} </p>
            <div class="h-1 bg-gray-200"></div>
            </div>
           

        </div>
        `
        })



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
                        location.reload();
                    });
                }
            }
            })


    </script>

 </div>

