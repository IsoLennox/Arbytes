<?php include("inc/header.php"); ?>  
<?php

 
   
        $query  = "SELECT * FROM members ";
		$query .= "WHERE id={$_SESSION['user_id']}"; 
		$all_members = mysqli_query($connection, $query); 
        
    if($all_members){    
         $array= mysqli_fetch_assoc($all_members);
   
 
            ?>
  
     <div id="page">
           <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
         
            
            
         <h2 class="headings">Your Contacts</h2>
     
    
<?php
 
//get all contact_id's of people you have added ad a contact
    $query  = "SELECT * ";
    $query .= "FROM contacts ";
    $query .= "WHERE user_id={$_SESSION['user_id']} "; 
    $all_members = mysqli_query($connection, $query); 
    


    if(!empty($all_members)){
        $array= mysqli_fetch_assoc($all_members);
        if(!empty($array)){
        ?>
        
                <form id="groupsearch" action="search.php?contacts" method="post">
        <input type="text" name="query" value="" placeholder="Search Your Contacts  <?php echo $group_name; ?>" />   
 
<!--        //submit button with font awesome icon-->
      <input type="submit" name="submit" value="&#xf002;" />
        </form> 
        <br/><Br/>  
        <?php
         
        //get all member data for each contact_id you have added
        
        
          

    foreach($all_members as $member){
        
        
       // echo $member['contact_id']."<br/>";
 
            $query  = "SELECT * ";
            $query .= "FROM members ";
            $query .= "WHERE id={$member['contact_id']} "; 
            $all_member_data = mysqli_query($connection, $query); 
            $member_array= mysqli_fetch_assoc($all_member_data);
        foreach($all_member_data as $memberInfo){
             
            
            
            
            
                            //SEE IF FOLLOWING
$query  = "SELECT * ";
$query .= "FROM following_status ";
$query .= "WHERE you={$_SESSION['user_id']} AND following={$memberInfo['id']} "; 
$all_following_status = mysqli_query($connection, $query); 
            if($all_following_status){
                
                   $num_rows = mysqli_num_rows($all_following_status);
 
     
      if($num_rows>=1){
         //you are following this user
              $following = "<a href=\"follow.php?user_id={$memberInfo['id']}&follow=0\"><i class=\"fa fa-user-times\"></i> Unfollow</a>";
    }else{
         $following = "<a href=\"follow.php?user_id={$memberInfo['id']}&follow=1\"><i class=\"fa fa-user-plus\"></i> Follow</a>";
    }
                
                
              
           
                } 
            
       
            
            
            
            //GET AND SHOW PROFILE IMAGE
          
                
         $img_query  = "SELECT * ";
		$img_query .= "FROM profile_img ";
		$img_query .= "WHERE user_id={$memberInfo['id']} AND current=1"; 
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
      
  
       
            echo "<div class='contacts'><a href='member_profile.php?user_id={$memberInfo['id']}'>".$avatar."</a><span class=\"right\"><a style=\"color:red\" href=\"delete.php?user_id=".$memberInfo['id']."\" onclick='return confirm(\"DELETE this contact?\");'><i class=\"fa fa-trash-o\"></i></a></span><a href=\"member_profile.php?user_id=".$memberInfo['id']."\"><h2>".$memberInfo['first_name']." ".$memberInfo['last_name']."</h2></a>Email:".$memberInfo['email']."<br/><br/><a href=\"create_message.php?user_id=".$memberInfo['id']."&name=".$memberInfo['first_name']."%20".$memberInfo['last_name']."\"><i class=\"fa fa-envelope-o\"></i>
 Send Message</a><br/><br/>".$following." Status Updates</div> ";
            
            
        }

    }
        
    }else
            echo "You have no Contacts!<br/><br/>You can find users to add as a contact by joining groups or searching for users in the search bar!<br/><br/>Collect a contact by selecting: <strong><i class=\"fa fa-user-plus\"></i> Collect Contact</strong>";
        }
   
    }else{
    echo "No Contacts";
    }
?>
 
</div>
<?php include("inc/footer.php"); ?> 
         
