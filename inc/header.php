<?php require_once("functions/session.php"); 
require_once("functions/functions.php"); 
require_once("functions/db_connection.php"); 
require_once("functions/validation_functions.php"); 
confirm_logged_in(); ?>
<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     
     <title>Arbytes</title>
      <link rel='shortcut icon' href='arbytes.ico' type='image/x-icon'/ >
       <link rel="stylesheet" href="css/tabs.css">
     <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" href="css/popup.css">
         <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

          <link href='http://fonts.googleapis.com/css?family=Merriweather:400,400italic,900italic,900' rel='stylesheet' type='text/css'>
 <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
 
<!--
    Author: Isobel Lennox
    Created: Winter 2015
    For: Personal Development/CTEC290   
-->
    
     
<!--     THEMES-->
          <?php
    

		$query  = "SELECT * ";
		$query .= "FROM members ";
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
<!--  DEFAULT White THEME -->
   <link rel='stylesheet' type='text/css' href='css/white.css' />

    <?php }else{ ?>
      
   
   <?php if(!empty($filepath)){ ?>
   <link rel='stylesheet' type='text/css' href='<?php echo $filepath; ?>' />
    <? }else{ ?>
<!--  DEFAULT WHITE THEME -->
   <link rel='stylesheet' type='text/css' href='css/white.css' />
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
   
  
    <header> 
    <span class="min-clear">
<a href="messages.php?user_id=<?php echo $_SESSION['user_id']; ?>">
<span id="messages_notification"><?php echo $_SESSION['msg_num']; ?></span>  
    <span class="notif"><i class="fa fa-envelope-o"></i>
 Messages</span>
        </a> </span>
        
        <a href="notifications.php"><span id="messages_notification"><?php echo $_SESSION['notify_num']; ?></span> 
        <span class="notif"><i class="fa fa-bell-o"></i>
 Notifications</span></a>
          
        <a class="button" href="#popup2">  <i id="new" class="fa fa-pencil-square-o fa-2x"> Status</i></a>
          
          <div id="popup2" class="overlay light">
	<a class="cancel" href="#"></a>
	<div class="popup">
		<h2>Update Status</h2>
		<div class="content">
  
      	
<!--      	TABS-->
      	
      <ul class="tab-sections"> 
    <li>
        <input class="radio-show" type="radio" name="tab-sections" id="tab-section1" checked />
        <label for="tab-section1">Update Status</label>
        <div id="tab-section-content1" class="tab-section-content">
    
            
            
                <form action="create_statuspost.php" method="post">

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
    </li>
  
    <li>
        <input type="radio" name="tab-sections" id="tab-section2" />
        <label for="tab-section2">File Upload</label>
        <div id="tab-section-content2" class="tab-section-content">
         <h2>Upload File </h2>
	              <form action="status_file.php?user_id=<?php echo $_SESSION['user_id']; ?>" method="post" enctype="multipart/form-data">
        <p>Title:
        <input type="text" name="title" value="" /> </p>
          <h6>Accepted file types: png, jpg, gif, docx, rtf, txt, css, php, html</h6>
    Select file or image to upload:
    <input type="file" name="image" id="fileToUpload"><br/> 
    <br/> 
             <p>Privacy:  
        <input type="radio" name="private" value="0" checked />Public
        <input type="radio" name="private" value="1" />Only You
      </p>
    <br/> 
 
    <input type="submit" value="Create" name="submit">
</form>
        </div>
    </li>
</ul>	
      	
      	
      	
      	
      	
      	

	
	
	
	
	
	
	
	
	
		</div>
	</div>
</div><!-- END POPUP-->
           
        
      
         <p id="welcome">Hi, <a title="View your profile" class="tooltip" href="member_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>"><?php echo $_SESSION['first_name']; ?></a> | <a href="settings.php"><i class="fa fa-cog"></i>
Settings</a> |  <a href="logout.php"><i class="fa fa-sign-out"></i>
 Logout</a></p>

 
        <form id="searchbar" action="search.php?go" method="post">
        <input type="text" name="query" value="" placeholder="Search Arbytes:" />   
 
<!--        //submit button with font awesome icon-->
      <input type="submit" name="submit" value="&#xf002;" />
        </form> 
    </header>
    
     
<!--     FULL PAGE MENU -->
   <aside> 
     	<ul>
     	
     	
     	  <?php 
      //Look in profile imgs to see if user has profile img
      
        $img_query  = "SELECT * ";
		$img_query .= "FROM profile_img ";
		$img_query .= "WHERE user_id={$_SESSION['user_id']} AND current=1"; 
		$all_imgs = mysqli_query($connection, $img_query); 
        
        if($all_imgs){
        $img_array= mysqli_fetch_assoc($all_imgs);
  if(!empty($img_array)){
              //show current img
            ?>
       <a title="View your profile" class="tooltip" href="member_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>"> <img id="avatar" src="<?php echo $img_array['filepath']; ?>" title="View Your Profilee"/></a><?php
            
  }else{ 
  
    //else show default_avatar
            ?>
       <a title="View your profile" class="tooltip" href="member_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>"> <img src="img/default_avatar.png" title="View Your Profile"/></a><?php
  }
        }else{
                 //else show default_avatar
            ?>
       <a title="View your profile" class="tooltip" href="member_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>"> <img src="img/default_avatar.png" title="View Your Profile"/></a><?php
        }
      
      ?>
      
   

<li><a title="View your profile" class="tooltip" href="member_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>"><?php echo $_SESSION['first_name']; ?></a></li>
<li><a href="status.php"><i class="fa fa-book"></i> Your Status</a></li>
<li><a href="status_feed.php"><i class="fa fa-rss"></i> Status Feed</a></li>
<li><a href="bookmarks.php"><i class="fa fa-bookmark"></i> Bookmarks</a></li>
<li><a href="following.php"><i class="fa fa-user"></i> Following</a></li>
<li><a href="contacts.php"><i class="fa fa-users"></i> Contacts</a></li>
       
        <br/>
<h3><a href="browse_groups.php"  title="Browse all groups" >Groups</a></h3>
      
<!--      FIND GROUPS USER IS IN-->
      <?php
        $groups  = "SELECT * FROM members_groups ";
		$groups .= "WHERE member_id={$_SESSION['user_id']}"; 
		$groups_found = mysqli_query($connection, $groups); 
        
        if($groups_found){
      $group_array= mysqli_fetch_assoc($groups_found);
            
            //START SELF SUBMIT FORM
 echo "<form action=\"go.php\" method=\"POST\">";           
 echo "<select id=\"groupslist\" name=\"groupslist\" onchange=\"this.form.submit()\" >";
       echo "<option name=\"group\" value=\"\" >Your Groups</option>";
      foreach($groups_found as $groupinfo){
       
          //get each group info
        $this_group  = "SELECT * FROM groups ";
		$this_group .= "WHERE id={$groupinfo['group_id']}"; 
		$this_group_found = mysqli_query($connection, $this_group); 
         
          
          
        if($this_group_found){
            
            $this_group_array= mysqli_fetch_assoc($this_group_found);
            $groupname = $this_group_array['group_name'];
            $group_id = $this_group_array['id'];
            
//  echo "<li style=\"list-style-type: square;\"><a href='posts.php?group_id=".$group_id."&group_name=".$groupname."'>".$groupname."</a></li>";
            echo "<option name=\"group_id\" value=\"".$group_id."\" ><a href=posts.php?group_id=\"".$group_id."\" >".$groupname."</a></option>";
            
        }
            
          
      }//end iterate through groups you are in
            
               echo "</select></form>"; 
   
        }//end search for groups
   
            
            
            ?>
 
  <li><a href="new_group.php"><i class="fa fa-plus-circle"></i>
 Create</a></li>
  <li><a href="browse_groups.php"><i class="fa fa-search"></i>
 Browse</a></li>
                     
 

       </ul>

     </aside> 



















<!--MEDIA QUERIE/MOBILE MENU-->

 
  
            <nav>
            
            <span class="half">
<li><a href="status.php"><i class="fa fa-book"></i> Your Status</a></li>
<li><a href="status_feed.php"><i class="fa fa-rss"></i> Status Feed</a></li>
<li><a href="bookmarks.php"><i class="fa fa-bookmark"></i> Bookmarks</a></li>
<li><a href="following.php"><i class="fa fa-user"></i> Following</a></li>
<li><a href="contacts.php"><i class="fa fa-users"></i> Contacts</a></li>
           </span>
           
                <span class="half">
                
<!--      FIND GROUPS USER IS IN-->
      <?php
        $groups  = "SELECT * FROM members_groups ";
		$groups .= "WHERE member_id={$_SESSION['user_id']}"; 
		$groups_found = mysqli_query($connection, $groups); 
        
        if($groups_found){
      $group_array= mysqli_fetch_assoc($groups_found);
            
            //START SELF SUBMIT FORM
 echo "<form action=\"go.php\" method=\"POST\">";           
 echo "<select id=\"groupslist\" name=\"groupslist\" onchange=\"this.form.submit()\" >";
       echo "<option name=\"group\" value=\"\" >Your Groups</option>";
      foreach($groups_found as $groupinfo){
       
          //get each group info
        $this_group  = "SELECT * FROM groups ";
		$this_group .= "WHERE id={$groupinfo['group_id']}"; 
		$this_group_found = mysqli_query($connection, $this_group); 
         
          
          
        if($this_group_found){
            
            $this_group_array= mysqli_fetch_assoc($this_group_found);
            $groupname = $this_group_array['group_name'];
            $group_id = $this_group_array['id'];
            
//  echo "<li style=\"list-style-type: square;\"><a href='posts.php?group_id=".$group_id."&group_name=".$groupname."'>".$groupname."</a></li>";
            echo "<option name=\"group_id\" value=\"".$group_id."\" ><a href=posts.php?group_id=\"".$group_id."\" >".$groupname."</a></option>";
            
        }
            
          
      }//end iterate through groups you are in
            
               echo "</select></form>"; 
   
        }//end search for groups
  
   
            
            
            ?>
 
  <li><a href="new_group.php"><i class="fa fa-plus-circle"></i>
 Create</a></li>
  <li><a href="browse_groups.php"><i class="fa fa-search"></i>
 Browse</a></li>
                </span>
           
            </nav> 