<nav>
    <div class="nav-wrapper" style="background:black">
      <a href="index.php" style="margin-left:20px;" class="brand-logo hide-on-med-and-down">Aston Events</a>
      <ul id="nav-mobile" class="right  ">
      
      <?php if(isset($isEventPage)):?>
      <li><a style="background:#d32f2f" href="event.php?eventid=<?php echo $eventID;?>">
      Current Event(<?php echo $eventTitle;?>)
      </a></li>
      <?php endif;?>


      <li><a  style="background:<?php
          if(isset($curNav) && $curNav=="home"){
            echo "#d32f2f";
          }
      ?>" href="index.php">Home</a></li>
      <li><a style="background:<?php 

        if(isset($curNav) && $curNav=="sports"){
            echo "#d32f2f";
        }
      
      ?>" href="blogs.php">Blogs</a></li>
      <li><a style="background:<?php 
        if(isset($curNav) && $curNav=="culture"){
            echo "#d32f2f";
        }

        ?>" href="myposts.php">My Posts</a></li>
  
        
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