<?php include("inc/header.php"); ?> 
<?php 
if (isset($_POST['groupslist'])) {
    
    $group_id=$_POST['groupslist']; 
     
  // Process the form
    redirect_to("posts.php?group_id=$group_id");
  
} 

 



if (isset($_POST['maillist'])) {
    
    $user_id=$_POST['maillist']; 
    
      $query  = "SELECT * ";
            $query .= "FROM members ";
            $query .= "WHERE id={$user_id} LIMIT 1"; 
            $all_member_data = mysqli_query($connection, $query); 
    if($all_member_data){
            $member_array= mysqli_fetch_assoc($all_member_data);
            $first_name=$member_array['first_name'];
            $last_name=$member_array['last_name'];
     
  // Process the form
//    redirect_to("create_message.php?user_id=$user_id");
    redirect_to("create_message.php?user_id=$user_id&name=$first_name%20$last_name");
  
        
        //&name=".$memberInfo['first_name']."%20".$memberInfo['last_name']."
} 
}


?>