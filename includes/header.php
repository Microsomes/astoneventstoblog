<nav>
    <div class="nav-wrapper" style="background:black">
      <a href="index.php" style="margin-left:20px;" class="brand-logo hide-on-med-and-down">WLVBlog</a>
      <ul id="nav-mobile" class="right  ">

      


      <li><a  style="background:<?php
          if(isset($curNav) && $curNav=="home"){
            echo "#d32f2f";
          }
      ?>" href="index.php">Home</a></li>
      <li><a style="background:<?php 

        if(isset($curNav) && $curNav=="blogs"){
            echo "#d32f2f";
        }
      
      ?>" href="blogs.php">Blogs</a></li>


     
      <li><a style="background:<?php 

        if(isset($curNav) && $curNav=="myblogs"){
            echo "#d32f2f";
        }
      
      ?>" href="myblogs.php">My Blogs</a></li>



      <li><a style="background:<?php 
        if(isset($curNav) && $curNav=="myposts"){
            echo "#d32f2f";
        }

        ?>" href="createBlog.php">Create</a></li>
  
        
        <?php if(isset($_SESSION['userid'])):?>
        <li><a style="background:<?php 
        if(isset($curNav) && $curNav=="account"){
            echo "#d32f2f";
        }

        ?>" href="account.php">My Account (<?php echo $_SESSION['username'];?>) </a></li>
        <?php endif;?>

    <?php if(isset($_SESSION['userid'])):?>
      <!-- <li><a href="logout.php">Sign Out (<?php
        echo $_SESSION['username'];
        ?>)</a></li> -->
        <?php else: ?>
            <li><a href="signin.php">Sign In/(Up)</a></li>
        <?php endif;?> 
      
      
       </ul>
    </div>
  </nav>