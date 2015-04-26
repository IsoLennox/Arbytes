<?php include("inc/header.php"); ?>  
<div id="page">

 <?php
 
//FILTER posts

$member_id=$_GET['member_selected'];

$member_query  = "SELECT * ";
		$member_query .= "FROM members WHERE group_id={$_SESSION['group_id']} ";
		$member_found = mysqli_query($connection, $member_query); 
        
        
        
        if(!empty($member_found)){
            
            $member_array= mysqli_fetch_assoc($member_found);
            
              echo "<form action=\"filter_posts.php?member_id={$member_array['id']}\" >";
     
            echo "<select name=\"member_selected\">";
            echo "<option value=\"0\">From all members</option>";
            foreach($member_found as $member){
                echo "<option value=\"".$member['id']."\">".$member['first_name']." ".$member['last_name']."</option>";
            }
            echo "</select>";
              echo "&nbsp;&nbsp;<input type=\"submit\" name=\"submit\" value=\"Filter\" /></form>";
      
        }else{
        echo "something went wrong.";
        }

?>
    
    <br/>
    <br/>
    <br/>
    <?php


if($member_id==0){
    
redirect_to("posts.php");

}else{

 
        $member_query  = "SELECT * ";
        $member_query .= "FROM members WHERE id={$member_id} ";
        $member_found = mysqli_query($connection, $member_query); 


        if(!empty($member_found)){
            $member_array= mysqli_fetch_assoc($member_found);
            foreach($member_found as $member){
                echo "<h3  class=\"headings\">posts by ".$member['first_name']." ".$member['last_name']."</h3>";
            }
        }else{
        echo "This member does not exist";
        }
    
    echo "<hr/>";
    
    
    
        //query to view posts that belong to this member
        $member_post_query  = "SELECT * ";
		$member_post_query .= "FROM posts ";
		$member_post_query .= "WHERE author={$member_id} ORDER BY datetime DESC"; 
		$posts_found = mysqli_query($connection, $member_post_query); 
        

 

        if(!empty($posts_found)){ 
            
            $member_posts_array= mysqli_fetch_assoc($posts_found);

            foreach($posts_found as $post){
                
                        
$comment_count=array();
                //get comment count
$member_post_query  = "SELECT * ";
$member_post_query .= "FROM comments ";
$member_post_query .= "WHERE post_id={$post['id']} "; 
$all_comments = mysqli_query($connection, $member_post_query); 
$comments_array= mysqli_fetch_assoc($all_comments);

                foreach($all_comments as $comment){

//                     echo "comment<br/>";
                    array_push($comment_count, "1");
    
                }
                
                
                 $member_post_query  = "SELECT * ";
		$member_post_query .= "FROM members ";
		$member_post_query .= "WHERE id={$post['author']} "; 
		$posts_found = mysqli_query($connection, $member_post_query); 
        $array= mysqli_fetch_assoc($posts_found);
 
                
                $content=$post['content'];
                $summary = substr($content, 0, 100);
                
                echo "<div class='post'><strong>".$post['title']."</strong><span class='right'> By: <a href='member_profile.php?user_id={$post['author']}'>".$array['first_name']." ".$array['last_name']."</a> |  ".$post{'datetime'}."</span><br/><br/>".$summary."...<br/><a href='post_single.php?post_id={$post['id']}'>Read More</a><br/><span class='right'>".count($comment_count)." comments</span><br/></div> "; 
            }
 
        
        
        }elseif(empty($array)){
            echo "This member has not created any posts";
        }
    
    
    
    
}





include("inc/footer.php"); ?> 