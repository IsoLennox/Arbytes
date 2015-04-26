<?php include("inc/header.php"); ?>
<div id="page">


<?php echo message();
$group_id=$_GET['group_id'];
$group_name=$_GET['group_name'];

$join_query = "SELECT * FROM members_groups WHERE member_id='{$_SESSION['user_id']}' AND group_id={$group_id}"; 
$result = mysqli_query ($connection, $join_query);

    if($result){
        $result_array=mysqli_fetch_array($result);
        $is_admin=$result_array['is_admin'];
        $num_rows = mysqli_num_rows($result);


        if($num_rows>=1){
            if($is_admin==1){
                $join= "<a onclick='return confirm(\"LEAVE this group?\");' href=\"delete_group.php?group_id=".$group_id."\"><i title=\"Leave Group\" class=\"fa fa-trash-o\"></i> Delete
</a>";
            }else{
            $join= "<a onclick='return confirm(\"LEAVE this group?\");' href=\"join_leave_group.php?group_id=".$group_id."\"><i title=\"Leave Group\" class=\"fa fa-sign-out\"></i> Leave
</a>";
            }
        }else{
            $join= "<a href=\"join_leave_group.php?group_id=".$group_id."\"><i title=\"Join Group\" class=\"fa fa-sign-in\"></i> Join
</a>";
        }
    }//end find members in group


?>
     <h2 class="headings">
     
    <?php echo form_errors($errors); 
  echo  "<a href='posts.php?group_id=".$group_id."&group_name=".$group_name."'>".$group_name."</a> Members"; ?>
        
       <span  class="right"><i title="View Members" class="fa fa-users"></i> | <a href="group_files.php?group_id=<?php echo $group_id; ?>"><i title="View Files" class="fa fa-file-text-o"></i></a> | <?php echo $join; ?>  </span>  
       
     

 </h2>




<p><a href="invite_member.php?group_id=<?php echo $group_id; ?>&group_name=<?php echo $group_name ?>"><i class="fa fa-user-plus"></i> Invite Member</a></p>
<p><a href="posts.php?group_id=<?php echo $group_id; ?>&group_name=<?php echo $group_name; ?>">&laquo; Back To Group Feed</a></p>
 

<hr/>
<?php

//GET GROUP ID

//CHANGE group TO GROUP
 
		$query  = "SELECT * ";
		$query .= "FROM members_groups ";
		$query .= "WHERE group_id={$group_id} "; 
		$all_members = mysqli_query($connection, $query); 
        
        
        
        if($all_members){
            
           foreach($all_members as $members){
               
              if($members['is_admin']){
                $an_admin= "<i class=\"fa fa-user-secret\"></i> Admin";
                  
                   if($is_admin && $members['member_id']!= $_SESSION['user_id']){
                      $an_admin.="<br/><a style=\"color:red\" href=\"edit.php?make_admin=".$members['member_id']."\"><i class=\"fa fa-user-secret\"></i> Remove Admin</a>";
                  }
                  
                  
               }else{
                  
                $an_admin= "Member";
                  if($is_admin){
                      $an_admin.="<br/><a href=\"edit.php?make_admin=".$members['member_id']."\"><i class=\"fa fa-user-secret\"></i> Make Admin</a>";
                  }
               }
 
               
               //GET MEMBER INFO
            
            
       $query  = "SELECT * ";
		$query .= "FROM members ";
		$query .= "WHERE id={$members['member_id']} "; 
		$members_found = mysqli_query($connection, $query); 
            
            
            //members in this group exist

            foreach($members_found as $member){
                //loop through all members and create a user display card
               echo "<div class=\"files\">";
                    
       //GET AND SHOW PROFILE IMAGE
          
                
         $img_query  = "SELECT * ";
		$img_query .= "FROM profile_img ";
		$img_query .= "WHERE user_id={$member['id']} AND current=1"; 
		$all_imgs = mysqli_query($connection, $img_query); 
        
        if($all_imgs){
            //user has current profile image
        $img_array= mysqli_fetch_assoc($all_imgs);
  if(!empty($img_array)){
            $avatar="<img id=\"avatar_list\" src=\"{$img_array['filepath']}\" title=\"View Profile\" />";
            
  }else{ 
       //no image, show default user profile avatar
            $avatar="<img id=\"avatar_list\" src=\"img/default_avatar.png\" title=\"View Profile\" />";
        }
        }else{
            //no image, show default user profile avatar
            $avatar="<img id=\"avatar_list\" src=\"img/default_avatar.png\" title=\"View Profile\" />";
        }//end GET profile image
      
  
           
                    
                    
                     
                    
                // SHOW AVATAR AND NAME
  
 echo " <a href='member_profile.php?user_id={$member['id']}'>".$avatar."</a>
 
 

 <span class=\"right\"><a href='member_profile.php?user_id={$member['id']}'>".$member['first_name']." ".$member['last_name']."</a><br/>".$an_admin."<br/>";
              
                
 //find if you have added user as contact
                
    $if_contact  = "SELECT * ";
    $if_contact .= "FROM contacts ";
    $if_contact .= "WHERE user_id={$_SESSION['user_id']} "; 
    $if_contact .= "AND contact_id={$member['id']} "; 
    $contact_found = mysqli_query($connection, $if_contact); 
    $contact_array = mysqli_fetch_assoc($contact_found);
        
        if(empty($contact_array)){
            
            //Not your contact

        if($member['id']!==$_SESSION['user_id']){
            //get other user ID: NOT YOU

            echo " <br/><a href=\"add_contact.php?contact_id={$member['id']}\"><i class=\"fa fa-user-plus\"></i> Collect Contact</a> ";
            }
            
            
            
        }else{
            
            //is your contact
             if($member['id']!==$_SESSION['user_id']){
                 //get other user ID: NOT YOU
    
            echo " <br/><a href=\"delete_contact.php?user_id=".$member['id']."\" onclick='return confirm(\"DELETE this contact?\");'><i class=\"fa fa-user-times\"></i> Drop Contact</a> ";
             } 
        }//end see if this person is your contact
                
                

                
                
                
                

                
                
    
            
        if($member['id']!==$_SESSION['user_id']){
            //member is NOT YOU, see if you are following their status
            
            
            //SEND MESSAGE
            echo "<br/><a href=\"create_message.php?user_id=".$member['id']."&name=".$member['first_name']."%20".$member['last_name']."\"><i class=\"fa fa-envelope-o\"></i> Send Message</a><br/>";
            
            
            //VIEW status
            echo "<br/><a href=\"status.php?user_id=".$member['id']."\"><i class=\"fa fa-pencil-square-o\"></i> View status</a>";
            
            
            //see if following
        $emp_query  = "SELECT * ";
		$emp_query .= "FROM following_status WHERE you = {$_SESSION['user_id']} AND following = {$member['id']}"; 
		$all_emps = mysqli_query($connection, $emp_query); 
    if($all_emps){
        $following=mysqli_fetch_assoc($all_emps); 
        if(empty( $following['following'])){
        
         //not following
        echo "<br/><a href=\"follow.php?user_id={$member['id']}&follow=1\"><i class=\"fa fa-user-plus\"></i> Follow</a>";
        }else{
        //following
        echo "<br/><a href=\"follow.php?user_id={$member['id']}&follow=0\"><i class=\"fa fa-user-times\"></i> Unfollow</a>";
        }
       
           } 
            
            
            
            } 
            
         echo "<br/></span></div> "; //end div.files
      
                      
                
                
                
                

            }
             
            }//end foreach member in group
        }else{
        echo "There are no users in this group!";
        }
      
?>


</div>
<?php include("inc/footer.php"); ?> 