<?php include("inc/header.php"); 

$group_id=$_GET['group_id'];
if(empty($group_id)){
    redirect_to("browse_groups.php");
}

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
            
            
            
            //SHOW POSTING FORM IF A MEMBER
            
            $show_files ="<a href=\"members.php?group_id=". $group_id."&group_name=". $group_name."\"><i title=\"View Members\" class=\"fa fa-users\"></i></a>  | <a href=\"group_files.php?group_id=". $group_id."\"><i title=\"View Files\" class=\"fa fa-file-text-o\"></i></a> | ";
            
             $show_post_form = "
             <form id=\"groupsearch\" action=\"search.php?group=".$group_id."\" method=\"post\">
        <input type=\"text\" name=\"query\" value=\"\" placeholder=\"Search ".$group_name." \" />    
      <input type=\"submit\" name=\"submit\" value=\"&#xf002;\" />
        </form> 
        
        <article class=\"label\">
		<section class=\"label-title\">
 		 
		</section>
		<section class=\"label-description\">  
 
            
            
                 <div class=\"tabbedPanels\">
    <ul class=\"tabs\">
        <li><a href=\"#panel1\" tabindex=\"1\"><i class=\"fa fa-pencil\"></i>  Create Post</a></li>  
        <li><a href=\"#panel2\" tabindex=\"2\"><i class=\"fa fa-upload\"></i>  Upload File</a></li> 
    </ul>

    <div class=\"panelContainer\">

        <div id=\"panel1\" class=\"panel\"> 
            		<form action=\"create_post.php?group_id=". $group_id."&group_name=". $group_name.">\" method=\"post\">
 
        <p>Title:
        <input type=\"text\" name=\"title\" value=\"\" /> </p>
        
         <p>Post: <br/>
    <textarea name=\"content\" value=\"\" rows=\"3\" cols=\"80\"></textarea></p>
         
      <input type=\"submit\" name=\"submit\" value=\"Create\" />
    </form>

        </div><!-- END PANEL 1 -->

        <div id=\"panel2\" class=\"panel\">
              <form action=\"upload_file.php?group_id=". $group_id."&group_name=".$group_name."\" method=\"post\" enctype=\"multipart/form-data\">
        <p>Title:
        <input type=\"text\" name=\"title\" value=\"\" /> </p>
          <h6>Accepted file types: png, jpg, gif, docx, rtf, txt, css, php, html</h6>
    Select file or image to upload:
    <input type=\"file\" name=\"image\" id=\"fileToUpload\"><br/> <br/> 
 
    <input type=\"submit\" value=\"Create\" name=\"submit\">
</form>

        </div><!-- END PANEL 3 -->

    </div> <!--   end panelcontainer  -->      
</div><!-- end tabbed panels -->
 </section>
	</article>";
            
            if($is_admin==1){
                $join= "<a href=\"edit_group.php?group=".$group_id."\"><i title=\"Edit Group\" class=\"fa fa-pencil\"></i></a> | <a onclick='return confirm(\"DELETE this group?\");' href=\"delete.php?group_id=".$group_id."\"><i title=\"DELETE Group\" class=\"fa fa-trash-o\"></i> Delete
</a>";
            }else{
            $join= "<a onclick='return confirm(\"LEAVE this group?\");' href=\"join_leave_group.php?group_id=".$group_id."\"><i title=\"Leave Group\" class=\"fa fa-sign-out\"></i> Leave
</a>";
            }
        }else{
            $show_post_form = "";
            $show_files = "";
           
            
            $join= "<a href=\"join_leave_group.php?group_id=".$group_id."\"><i title=\"Join Group\" class=\"fa fa-sign-in\"></i> Join
</a>";
        }
    }//end find members in group

}//end find group by ID
?>

 <div id="page"><?php echo message(); 
 
     
     ?>
     <h2 class="headings">
     
    <?php echo form_errors($errors); 
  echo  "<a href='posts.php?group_id=".$group_id."&group_name=".$group_name."'>".$group_name."</a>"; ?>
        
       <span  class="right"> <?php echo $show_files; ?> <?php echo $join; ?>  </span>  
       
     

 </h2>
 <?php

    if($profile_content){
    echo "<p>".$profile_content."</p>"; }


 
//SHOW POST FORM AND SEARCH BAR IF IN GROUP

echo $show_post_form;




 


$q = "SELECT * FROM posts WHERE group_id={$group_id} ORDER BY id DESC"; 

$r = @mysqli_query ($connection, $q); 
 

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

    
    //PRINT RECORDS 
                       
$comment_count=array();
                //get comment count
$query  = "SELECT * ";
$query .= "FROM comments ";
$query .= "WHERE post_id={$row['id']} "; 
$all_comments = mysqli_query($connection, $query); 
$comments_array= mysqli_fetch_assoc($all_comments);

                foreach($all_comments as $comment){
                    array_push($comment_count, "1");
    
                }
                
                
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
                
        $img_query2  = "SELECT * ";
		$img_query2 .= "FROM profile_img ";
		$img_query2 .= "WHERE user_id={$row['author']} AND current=1"; 
		$all_imgs2 = mysqli_query($connection, $img_query2); 
        
        if(!empty($all_imgs2)){
        $img_array2= mysqli_fetch_assoc($all_imgs2);
  if(!empty($img_array2)){
            $avatar="<img id=\"avatar_list\" src=\"{$img_array2['filepath']}\" title=\"View Profile!\" />";
  }else{
            $avatar="<img id=\"avatar_list\" src=\"img/default_avatar.png\" title=\"View Profile\" />";
        }
 
        }else{
            $avatar="<img id=\"avatar_list\" src=\"img/default_avatar.png\" title=\"View Profiles\" />";
        }
    
    
           //GET BOOKMARK
                    $bookmarkq = "SELECT * FROM bookmarks WHERE user_id={$_SESSION['user_id']} AND post_id={$row['id']} ORDER BY id DESC"; 
                    $bookmarkresult = @mysqli_query ($connection, $bookmarkq);  

                    $num_bookmarks = mysqli_num_rows($bookmarkresult);
                    if($num_bookmarks>=1){
                        $bookmark =" <a href=\"bookmarks.php?remove=".$row['id']."&group=1\" ><i title=\"Remove Bookmark\" class=\"fa fa-bookmark\"></i></a>";
                       
 
                    }else{
                       $bookmark =" <a href=\"bookmarks.php?add=".$row['id']."&group=1\" ><i title=\"Bookmark This Post\" class=\"fa fa-bookmark-o\"></i></a>";
                    }
                
                
                                echo "<div class='post_list'><span class=\"right\">".$bookmark."</span><a href='post_single.php?post_id={$row['id']}'></a>".$avatar." By: <a href='member_profile.php?user_id={$row['author']}'>".$array['first_name']." ".$array['last_name']."</a> <br/> <h2><a href='post_single.php?post_id={$row['id']}'>".$row['title']."</a></h2> ".$row{'datetime'}."<span class='right'>
                                
                                </span>
                                
                                <br/><br/> ".$summary."... <br/><br/><a href='post_single.php?post_id={$row['id']}'>Read More</a><br/><span class='right'>".count($comment_count)." comments</span><br/></div> "; 
        
 
 
    
    
    

} // End of WHILE loop. 

mysqli_free_result ($r); 

 

echo "</div>";
include("inc/footer.php"); ?> 