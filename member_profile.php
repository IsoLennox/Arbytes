<?php include("inc/header.php"); 

$member_id=$_GET['user_id'];
   
        $query  = "SELECT * FROM members ";
		$query .= "WHERE id={$member_id}"; 
		$all_members = mysqli_query($connection, $query); 
        
    if($all_members){    
         $array= mysqli_fetch_assoc($all_members);
        
 
            ?>
  
     <div id="page">
           <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
        <div class="tabbedPanels">
        <ul class="tabs">
        <li><a href="#panel1" tabindex="1">Contact Info</a></li>  
        <li><a href="#panel5" tabindex="2">Avatar Gallery</a></li>
        <li><a href="#panel7" tabindex="2">Groups</a></li>
             
            
            </ul>
            
            
            
            <div class="panelContainer">
             <h1><?php echo $array['first_name']." ".$array['last_name']; ?> </h1>    
            <div id="panel1" class="panel"><h2>Contact Info</h2>
            <a href="status.php?user_id=<?php echo $array['id'] ?>"><i class="fa fa-book"> View Status Updates</i></a>
            <?php  
        if($array['id']!==$_SESSION['user_id']){
            
            //user is not you
            
        echo " <br/><a href=\"create_message.php?user_id=".$array['id']."&name=".$array['first_name']."%20".$array['last_name']."\"><i class=\"fa fa-envelope-o\"></i>
 Send Message</a><br/>  ";
                
        //see if this person is your contact_id
            $if_contact  = "SELECT * ";
    $if_contact .= "FROM contacts ";
    $if_contact .= "WHERE user_id={$_SESSION['user_id']} "; 
    $if_contact .= "AND contact_id={$array['id']} "; 
    $contact_found = mysqli_query($connection, $if_contact); 
    $contact_array = mysqli_fetch_assoc($contact_found);
        
        if(empty($contact_array)){
      
        
      
                    
            echo "<a href=\"add_contact.php?contact_id={$array['id']}\"><i class=\"fa fa-user-plus\"></i>
 Collect Contact</a>";
            
            
            }else{ 
        echo "<a href=\"delete_contact.php?user_id=".$array['id']."\" onclick='return confirm(\"DELETE this contact?\");'><i class=\"fa fa-user-times\"></i>
 Drop Contact</a>";
            
        }
        }else{
             if($array['id']!==$_SESSION['user_id']){
            echo "<a href=\"delete_contact.php?user_id=".$array['id']."\" onclick='return confirm(\"DELETE this contact?\");'><i class=\"fa fa-user-times\"></i> Drop Contact</a>";
             }
        }//end see if this person is your contact
            ?>

           <br/>
           <br/>
           <br/>
              <?php
        
        
                //AVATAR
                
                
                
            $img_query  = "SELECT * ";
            $img_query .= "FROM profile_img ";
            $img_query .= "WHERE user_id={$member_id} AND current=1"; 
            $all_imgs = mysqli_query($connection, $img_query); 

            if($all_imgs){
            $img_array= mysqli_fetch_assoc($all_imgs);
            if(!empty($img_array)){
            //show current img
            ?>
            <img id="avatar" src="<?php echo $img_array['filepath']; ?>" title="View Profile"/><?php


            }else{
            //else show default_avatar?>
            <img src="img/default_avatar.png" title="No Profile Image"/><?php
            }
            }


            if($_SESSION['user_id']==$array['id']){ ?>
            <br/><br/> <a href="upload_profile_img.php"><i class="fa fa-upload"></i>  Upload New Profile Picture</a>
            <?php  }   
        
        
        
        
                                   
        
        
        
                ?>        
                        
           
            <p><i class="fa fa-envelope"></i>  <?php echo $array['email']; ?></p> 
                 
            
           <div class="post"><?php echo $array['profile']; ?></div>
            
            
            <?php
             if($array['id']==$_SESSION['user_id']){
                    echo "<span class='right'><a href='edit_profile.php?user_id={$array['id']}' ><i class=\"fa fa-pencil-square-o\"></i>
 Edit Profile</a></span><br/><br/>";
             }
               
        ?>
 
            
 </div><!-- END PANEL 1 -->
   
   
 

  

    <div id="panel5" class="panel">
        <h2>Profile Images</h2>
        <?php
          if($_SESSION['user_id']==$array['id']){ ?>
          <a href="upload_profile_img.php"><i class="fa fa-upload"></i>
 Upload New Profile Picture</a><br/>
            <?php  } ?>
        <br/> <a href="profile_img_gallery.php?user_id=<?php echo $member_id; ?>"><i class="fa fa-eye"></i>
 View All</a><br/><Br/>
          
          <?php
              
    //query to view files that belong to your group
        $img_query  = "SELECT * ";
		$img_query .= "FROM profile_img ";
		$img_query .= "WHERE user_id={$member_id}"; 
		$all_imgs = mysqli_query($connection, $img_query); 
        
        if(!empty($all_imgs)){
        $img_array= mysqli_fetch_assoc($all_imgs);
            
                    if(!empty($img_array)){ 

            foreach($all_imgs as $file){
    echo "<div class='avatar_gallery'><a href=\"view_image.php?filepath=".$file['filepath']."\"><img src=\"{$file['filepath']}\" title=\"profile image\" /></a></div> "; 
            }
 
        }else{
            echo "This user has not uploaded any profile images.";
        }
        }else{
            echo "No Profile Images for user ".$array['id']." have been uploaded";
        }


 


         
         ?>
          
          
    </div><!-- END PANEL 5 -->
    
    
    

                
                
                
 <div id="panel7" class="panel">
        <h2>Groups</h2>
        <?php
//            FIND GROUPS USER IS IN 
  
        $groups  = "SELECT * FROM members_groups ";
		$groups .= "WHERE member_id={$member_id}"; 
		$groups_found = mysqli_query($connection, $groups); 
        
        if($groups_found){
      $group_array= mysqli_fetch_assoc($groups_found);
 
      
      foreach($groups_found as $groupinfo){
       
          //get each group info
        $this_group  = "SELECT * FROM groups ";
		$this_group .= "WHERE id={$groupinfo['group_id']}"; 
		$this_group_found = mysqli_query($connection, $this_group); 
         
          
          
        if($this_group_found){
            
            $this_group_array= mysqli_fetch_assoc($this_group_found);
            $groupname = $this_group_array['group_name'];
            $group_id = $this_group_array['id'];
            
  echo "<li style=\"list-style-type: none;\"><a href='posts.php?group_id=".$group_id."&group_name=".$groupname."'>".$groupname."</a></li>";
        }
            
          
      }//end iterate through groups you are in
   
        }//end search for groups
         
         ?>
          
          
    </div><!-- END PANEL 7 -->
                 
    
    
    
    
    
 
    
    

</div> <!--   end panel container-->
            
            
        
</div><!-- end tabbed panels -->

<?php
        }else{
        echo "something went wrong.";
        }
        
        ?>
</div>
<?php include("inc/footer.php"); ?> 