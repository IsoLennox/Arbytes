<?php require_once("functions/session.php"); 
require_once("functions/functions.php"); 
require_once("functions/db_connection.php"); 
require_once("functions/validation_functions.php"); 
  ?>
<!DOCTYPE html>
 <html lang="en">
 <head>
    <!--
    Author: Isobel Lennox
    Created: Winter 2015
    For: Personal Development/CTEC290   
-->
     <meta charset="UTF-8">
     
     <title>Arbytes</title>
      <link rel='shortcut icon' href='arbytes.ico' type='image/x-icon'/ >
       <link rel="stylesheet" href="css/tabs.css">
     <link rel="stylesheet" href="css/style.css">
 
 
<!-- TOUR JS-->

<link rel="stylesheet" type="text/css" href="css/jquerytour.css" />

    
     
<!--     THEMES-->
          <?php
    

		$query  = "SELECT * ";
		$query .= "FROM employees ";
		$query .= "WHERE id={$_SESSION['user_id']} "; 
		$theme_found = mysqli_query($connection, $query); 
        $array= mysqli_fetch_assoc($theme_found);
        $theme= $array['theme']; 




		$themequery  = "SELECT * ";
		$themequery .= "FROM themes ";
		$themequery .= "WHERE id={$theme} "; 
		$themequery_found = mysqli_query($connection, $themequery); 
        $theme_array= mysqli_fetch_assoc($themequery_found);
        $filepath=$theme_array['filepath'];
           
//GREY THEME
if($theme==0){ ?>
<!--  DEFAULT GREY THEME -->
   <link rel='stylesheet' type='text/css' href='css/grey.css' />

    <?php }else{ ?>
      
   
   <?php if(!empty($filepath)){ ?>
   <link rel='stylesheet' type='text/css' href='<?php echo $filepath; ?>' />
    <? }else{ ?>
<!--  DEFAULT GREY THEME -->
   <link rel='stylesheet' type='text/css' href='css/grey.css' />
 <?php } ?>
     
     

    <?php }



//if theme=0 default
//else = # == themes.id




?>

     
     <!-- Arbyte is a pun branched from the term "Arbeit" meaning 'task' or 'work' and "bytes" -->
     
     
     
     
<!--     TABS -->
     
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" ></script>  
 <script src="js/tabs.js" ></script> 
 
 
 
<!--SLIDE DOWN MENU-->

    <link rel="stylesheet" href="css/slide-down.css">
    <script src="js/jquery_2.1.1.js"></script>
    <script>$(document).ready(function(){
	$("#accordian .label-title").click(function(){
		//slide up all the link lists
		$("#accordian .label-description").slideUp();
		//slide down the link list below the h3 clicked - only if its closed
		if(!$(this).next().is(":visible"))
		{
			$(this).next().slideDown();
		}
	})
})</script> 
 

 </head>
 <body>
   
      
    <header class="tour_7"> 
        
       
      <a href="home.php"> <img id="logo" src="img/full_logo3.png" title="arbytes logo" /></a>
        
<!--        class="tooltip"-->
         <p id="welcome">Hi, <a title="View your profile"  href="employee_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>"><?php echo $_SESSION['first_name']; ?></a> | <a href="messages.php?user_id=<?php echo $_SESSION['user_id']; ?>"><span id="messages_notification"><?php echo $_SESSION['msg_num']; ?></span>  <img src="img/icons/tiny-white-messages.png" title="See all Messages" /></a> | <a href="notifications.php"><span id="messages_notification"><?php echo $_SESSION['notify_num']; ?></span>  <img src="img/icons/tiny-white-notifications.png" title="See all notifications" /> </a>  </p>

 
        <form id="searchbar" action="search.php?go" method="post">
        <input type="text" name="query" value="" placeholder="Search <?php echo $_SESSION['company_name']; ?>:" />  
      <input type="submit" name="submit" value="Ask" />
        </form> 
    </header>
    
     
<!--     FULL PAGE MENU -->
   <aside> 
     	<ul>
     	
      
       <a class="tour_1" title="View your profile"  href="employee_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>"> <img src="img/default_avatar.png" title="View Your Profile"/></a> 
      
      
<!--   class="tooltip"-->

<li><a title="View your profile"  href="employee_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>"><?php echo $_SESSION['first_name']; ?></a></li>


<?php
       $co_query  = "SELECT * ";
		$co_query .= "FROM company ";
		$co_query .= "WHERE id={$_SESSION['company_id']}"; 
		$all_cos = mysqli_query($connection, $co_query); 
        
        if($all_cos){
        $co_array= mysqli_fetch_assoc($all_cos);
            $company_name = $co_array['company_name'];
        }
            
            ?>
<!-- class="tooltip"-->
 <li><a class="tour_2" title="View your Group Profile"  href="company_profile.php?company_id=<?php echo $_SESSION['company_id']; ?>"><?php echo $company_name; ?></a></li>
            
  
        <?php
  
//  } 
            
            ?>



 

    <li><a href="blog.php?user_id=<?php echo $_SESSION['user_id']; ?>"><img src="img/icons/book.png" title="See all Files" /> Your Blog</a></li>
    <li><a class="tour_3" href="blog_feed.php"><img src="img/icons/tiny-feedview.png" title="See all Files" /> Blog Feed</a></li>
        <br/>
       
  <li><a href="notes.php"><img src="img/icons/book.png" title="See all Notes" />Group Posts</a></li>
                     
             
  <li><a class="tour_4" href="files.php"><img src="img/icons/files.png" title="See all Files" /> Files</a></li>
  
 
    
      <li><a class="tour_5" href="employees.php"><img src="img/icons/tiny-contacts.png" title="See all Employees" /> Members</a></li>
      
   
 
<br/> 
<li><a class="tour_6" href="settings.php"><img src="img/icons/settings.png" title="Settings" /> Settings</a></li>
<li><a href="logout.php"><img src="img/icons/logout.png" title="Log Out" /> Logout</a></li>
       </ul>

     </aside>  




 