<?php include("inc/header.php"); ?>

 <div id="page"><?php echo message(); ?>
     <h2 class="headings">Status Updates You are Following</h2>
     
    <?php echo form_errors($errors); 
 
 
 
                       
 
                //get all statuss youre following
$query  = "SELECT * ";
$query .= "FROM following_status ";
$query .= "WHERE you={$_SESSION['user_id']} "; 
$all_following_status = mysqli_query($connection, $query); 
$num_rows=mysqli_num_rows($all_following_status);
if($num_rows>=1){
$following_status_array= mysqli_fetch_assoc($all_following_status);

                foreach($all_following_status as $status){
                  
                    
$empquery  = "SELECT * ";
$empquery .= "FROM members ";
$empquery .= "WHERE id={$status['following']} "; 
$user_found = mysqli_query($connection, $empquery); 
                    if($user_found){
$user_array= mysqli_fetch_assoc($user_found);
                        
                        $profquery  = "SELECT * FROM profile_img WHERE user_id={$status['following']} AND current=1 "; 
                        $prof_found = mysqli_query($connection, $profquery); 
                        $profile_array = mysqli_fetch_assoc($prof_found); 
                        echo "<div id=\"following_list\">";
                    echo "<a href=\"member_profile.php?user_id=".$status['following']."\">
                   <img onerror=\"if (this.src != 'img/default_img.png') this.src = 'img/default_avatar.png';\" id=\"avatar_list\" src=\"".$profile_array['filepath']."\" />
                       </a><br/><a href=\"member_profile.php?user_id=".$status['following']."\">".$user_array['first_name']." ".$user_array['last_name']."</a>";
                        
                        echo   "<a href=\"status.php?user_id=".$status['following']."\"><i class=\"fa fa-book\"> View Status</i></a>";
                        
                    echo "<br/><br/><a class=\"unfollowbutton\" href=\"follow.php?user_id={$status['following']}&follow=0\">- Unfollow</a>";
                        echo "</div>";
                        
                }
                }
}else{
                
                echo "You are not following anyone!<br/><br/> You can find users to follow by joining groups, searching through your contacts or searching for users in the searchbar!<br/><br/>Start following a user by selecting: <strong><i class=\"fa fa-user-plus\"></i> Follow </strong> to start seeing their status updates in your status feed!";
                }

echo "</div>";
include("inc/footer.php"); ?> 