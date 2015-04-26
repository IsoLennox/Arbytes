<?php include("inc/header.php"); 

$group_id=$_GET['group_id'];

$profile_query = "SELECT * FROM groups WHERE id={$group_id}"; 

$group_found= @mysqli_query ($connection, $profile_query);
if($group_found){
$group_array=mysqli_fetch_assoc($group_found);
$profile_content = $group_array['profile_content'];
$group_name=$group_array['group_name'];
 

 
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

}//end find group by ID
?>

 <div id="page"><?php echo message(); ?>
     <h2 class="headings">
     
    <?php echo form_errors($errors); 
  echo  "<a href='posts.php?group_id=".$group_id."&group_name=".$group_name."'>".$group_name."</a> Files"; ?>
        
       <span  class="right"><a href="members.php?group_id=<?php echo $group_id; ?>&group_name=<?php echo $group_name; ?>"><i title="View Members" class="fa fa-users"></i></a> | <i title="View Files" class="fa fa-file-text-o"></i> | <?php echo $join; ?>  </span>  
       
     

 </h2>
     <form id="groupsearch" action="search.php?group=<?php echo $group_id; ?>" method="post">
        <input type="text" name="query" value="" placeholder="Search <?php echo $group_name; ?>" />   
 
<!--        //submit button with font awesome icon-->
      <input type="submit" name="submit" value="&#xf002;" />
        </form> 
 
 
     
     <?php

 


$q = "SELECT * FROM posts WHERE group_id={$group_id} AND is_file=1 ORDER BY id DESC"; 

$r = @mysqli_query ($connection, $q); 
 

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

    
    //PRINT RECORDS 
 
                
                
        $empquery  = "SELECT * ";
		$empquery .= "FROM members ";
		$empquery .= "WHERE id={$row['author']} "; 
		$all_rows = mysqli_query($connection, $empquery); 
        $array= mysqli_fetch_assoc($all_rows);
 
                
                $content=$row['content'];
                if($row['is_file']){
                    if($row['file_type']){
                    $summary = "<a href='post_single.php?post_id={$row['id']}'><i class=\"fa fa-file-text-o fa-5x\"></i></a>";
                    }else{
                    $summary = "<a href='post_single.php?post_id={$row['id']}'><img onerror=\"if (this.src != 'img/default_img.png') this.src = 'img/default_img.png';\" src=\"".$content."\" /></a>";
                    }
                }else{
                    $summary = substr($content, 0, 100);
                }
 
    
    
                
                                echo "
                                <div class='post_list'>
                                
                                <a href='member_profile.php?user_id={$row['author']}'>".$array['first_name']." ".$array['last_name']."</a> 
                                <br/> 
                                <h2>
                                <a href='post_single.php?post_id={$row['id']}'>".$row['title']."</a></h2> ".$row{'datetime'}."
                                <br/><br/> ".$summary."</div> "; 
        
 
 
    
    
    

} // End of WHILE loop. 

mysqli_free_result ($r); 

 

echo "</div>";
include("inc/footer.php"); ?> 