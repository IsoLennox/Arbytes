<?php include("inc/header.php"); ?> 
<?php 
    
    $group_id=$_GET['group_id']; 
     
//get all instances of group in group join table to find its members
    $group_query  = "SELECT * FROM members_groups WHERE group_id={$group_id} AND  member_id = '{$_SESSION['user_id']}' "; 
    $group_retrieved = mysqli_query($connection, $group_query);

if($group_retrieved){
    
    
        $num_rows = mysqli_num_rows($group_retrieved);
    
    
        $this_group_query  = "SELECT * FROM groups WHERE id={$group_id} "; 
        $this_group_retrieved = mysqli_query($connection, $this_group_query);
        $this_group_array = mysqli_fetch_assoc($this_group_retrieved);
        $this_group_id=$this_group_array['id'];
        $this_group_name=$this_group_array['group_name'];
     
      if($num_rows>=1){


                          //LEAVE GROUP
            $query = "DELETE FROM members_groups WHERE member_id = '{$_SESSION['user_id']}' AND group_id = {$group_id} LIMIT 1";
            $result = mysqli_query($connection, $query);

            if ($result && mysqli_affected_rows($connection) == 1) {
            // Success
                $_SESSION["message"] = "Left ".$this_group_name."! ";
            redirect_to("posts.php?group_id=$group_id&group_name=$this_group_name"); 
            } else{
            // Failure
            $_SESSION["message"] = "Could not leave group";
            redirect_to("posts.php?group_id=$group_id&group_name=$this_group_name"); 
            }

          
    }else{
            //JOIN GROUP
            $query  = "INSERT INTO members_groups (";
            $query .= "  group_id, member_id ";
            $query .= ") VALUES (";
            $query .= "  {$group_id},'{$_SESSION['user_id']}'";
            $query .= ") ";
            $new_join_created = mysqli_query($connection, $query);

            if ($new_join_created) {
                $_SESSION["message"] = "Joined ".$this_group_name."! ";
            redirect_to("posts.php?group_id=$group_id&group_name=$this_group_name"); 
            } else {
            // Failure
            $_SESSION["message"] = "Could Not Join this group!";
                redirect_to("posts.php?group_id=$group_id&group_name=$this_group_name");
            }
    }
    
    

  
    
   
}else{

    
                //LEAVE GROUP
            $query = "DELETE FROM members_groups WHERE member_id = '{$_SESSION['user_id']}' AND group_id = {$group_id} LIMIT 1";
            $result = mysqli_query($connection, $query);

            if ($result && mysqli_affected_rows($connection) == 1) {
            // Success
                $_SESSION["message"] = "Left ".$this_group_name."! ";
            redirect_to("posts.php?group_id=$group_id&group_name=$this_group_name"); 
            } else{
            // Failure
            $_SESSION["message"] = "Could not leave group";
            redirect_to("posts.php?group_id=$group_id&group_name=$this_group_name"); 
            }


}
  