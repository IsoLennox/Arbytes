<?php require_once("functions/session.php"); 
require_once("functions/functions.php"); 
require_once("functions/db_connection.php"); 
require_once("functions/validation_functions.php"); 
 ?>
<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     
     <title>Arbytes</title>
      <link rel='shortcut icon' href='arbytes.ico' type='image/x-icon'/ >
       <link rel="stylesheet" href="css/tabs.css">
     <link rel="stylesheet" href="css/style.css">
<!-- TOUR JS-->

<link rel="stylesheet" type="text/css" href="css/jquerytour.css" />

    <link rel='stylesheet' type='text/css' href='css/grey.css' /> 
     <link rel="stylesheet" href="css/popup.css">
         <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

          <link href='http://fonts.googleapis.com/css?family=Merriweather:400,400italic,900italic,900' rel='stylesheet' type='text/css'>
 <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
 
<!--
    Author: Isobel Lennox
    Created: Winter 2015
    For: Personal Development/CTEC290   
-->
    
  
     
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
   
  
    <header> 
    <span class="min-clear">
<a href="#?">
<span id="messages_notification"><?php echo $_SESSION['msg_num']; ?></span>  
    <span class="notif"><i class="fa fa-envelope-o"></i>
 Messages</span>
        </a> </span>
        
        <a href="#"><span id="messages_notification"><?php echo $_SESSION['notify_num']; ?></span> 
        <span class="notif"><i class="fa fa-bell-o"></i>
 Notifications</span></a>
          
<!--        <a class="button" href="#popup2">  <i id="new" class="fa fa-pencil-square-o fa-2x">New Post</i></a>-->
          
          <div id="popup2" class="overlay light">
	<a class="cancel" href="#"></a>
	<div class="popup">
		<h2>Update Status</h2>
		<div class="content">
      <p>Click outside the popup to close.</p>
      	
    <form action="#" method="post">

    <p>Title:
    <input type="text" name="title" value="" /> </p>

    <p>Privacy:  
    <input type="radio" name="private" value="0" checked />Public
    <input type="radio" name="private" value="1" />Only You
    </p>


    <p>Post: <br/>
    <textarea name="content" value="" rows="3" cols="80"></textarea></p>

    <input type="submit" name="submit" value="Create" />
    </form>

	
	
	
	
		</div>
	</div>
</div><!-- END POPUP-->
           
        
      
         <p id="welcome">Hi, <a title="View your profile"  href="#">Member Name</a> | <a href="grouptour_settings.php"><i class="fa fa-cog"></i>
Settings</a> |  <a href="help.php"><i class="fa fa-sign-out"></i>
 Logout</a></p>

 
        <form id="searchbar" action="#" method="post">
        <input type="text" name="query" value="" placeholder="Search Arbytes:" />   
 
<!--        //submit button with font awesome icon-->
      <input type="submit" name="submit" value="&#xf002;" />
        </form> 
    </header>
    
     
<!--     FULL PAGE MENU -->
   <aside> 
     	<ul>
     	
     	
       <a class="tour_1" title="View your profile"  href="#"> <img src="img/default_avatar.png" title="View Your Profile"/></a> 
   

<li><a title="View your profile"  href="#">Member Name</a></li>

<li><a href="#"><i class="fa fa-book"></i> Your Status</a></li>
<li><a href="#"><i class="fa fa-rss"></i> Status Feed</a></li>
<li><a href="#"><i class="fa fa-user"></i> Following</a></li>
<li><a href="#"><i class="fa fa-users"></i> Contacts</a></li>
       
        <br/>
<h3><a href="#"  title="Browse all groups" >Groups</a></h3>
 
            <select>
                <option>Group Name</option>
                <option>Group Name</option>
                <option>Group Name</option>
                <option>Group Name</option>
                <option>Group Name</option>
            </select>
 
  <li><a href="#"><i class="fa fa-plus-circle"></i>
 Create</a></li>
  <li><a href="#"><i class="fa fa-search"></i>
 Browse</a></li>
                     
 

       </ul>

     </aside> 

 

<!--MEDIA QUERIE/MOBILE MENU-->

 
  
            <nav>
            
            <span class="half">
<li><a href="#"><i class="fa fa-book"></i> Your Status</a></li>
<li><a href="#"><i class="fa fa-rss"></i> Status Feed</a></li>
<li><a href="#"><i class="fa fa-user"></i> Following</a></li>
<li><a href="#"><i class="fa fa-users"></i> Contacts</a></li>
           </span>
           
                <span class="half">
                
 <h3><a href="#"  title="Browse all groups" >Groups</a></h3>
 
            <select>
                <option>Group Name</option>
                <option>Group Name</option>
                <option>Group Name</option>
                <option>Group Name</option>
                <option>Group Name</option>
            </select>
 
  <li><a href="#"><i class="fa fa-plus-circle"></i>
 Create</a></li>
  <li><a href="#"><i class="fa fa-search"></i>
 Browse</a></li>
  
                </span>
           
            </nav> 