<?php include("inc/header.php");

 if(isset($_GET['add'])){
 
     //ADD BOOKMARK!
     $post_id=$_GET['add'];
     $is_group=$_GET['group'];
     
       
    $query  = "INSERT INTO bookmarks (";
    $query .= "  post_id, user_id, is_group_post ";
    $query .= ") VALUES (";
    $query .= "  {$post_id}, {$_SESSION['user_id']}, {$is_group} ";
    $query .= ") ";
    $r = @mysqli_query($connection, $query);  
  
  if($r){
    $_SESSION["message"] = "Bookmarked!";
//      redirect_to("bookmarks.php");
     header('Location: ' . $_SERVER['HTTP_REFERER']);
    
  }else{
      $_SESSION["message"] = "Could Not Save This Page";
//       redirect_to("bookmarks.php");
     header('Location: ' . $_SERVER['HTTP_REFERER']);
  
  }
     
 }elseif(isset($_GET['remove'])){
 
     //ADD BOOKMARK!
     $post_id=$_GET['remove'];
     $is_group=$_GET['group'];
     
        $query = "DELETE FROM bookmarks WHERE post_id = {$post_id} AND user_id={$_SESSION['user_id']} LIMIT 1";
  $result = mysqli_query($connection, $query);
     
     
  
  if($result){
    $_SESSION["message"] = "Bookmark Removed!";
     header('Location: ' . $_SERVER['HTTP_REFERER']);
    
  }else{
      $_SESSION["message"] = "Could Not UnBookmark This Page";
     header('Location: ' . $_SERVER['HTTP_REFERER']);
  
  }
     
 }else{


?> 

 <div id="page">
     <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
 <h2 class="headings">Bookmarks<span class="right"></h2>
<!--
 
 TO DO:
     
     SORT BY TYPE
     SEARCH
     SORT BY AUTHOR
-->
  
 
 
  <?php 


//GET ALL BOOKMARKED POSTS


$q = "SELECT * FROM bookmarks WHERE user_id={$_SESSION['user_id']} ORDER BY id DESC"; 
$r = @mysqli_query ($connection, $q);  
 
$num_rows = mysqli_num_rows($r);
if($num_rows>=1){
  
foreach($r as $row) {
    
    
//DISPLAY ALL BOOKMARKS
    
   //GET BOOKMARK INFO
    $post_id=$row['post_id']; 
    
    
    $is_group_post=$row['is_group_post'];
    if( $is_group_post){
        $page="post_single";
        $table="posts";
        $author="author";
    }else{
        $page="status_single";
        $table="status";
        $author="user_id";
    }
    
    //GET POST INFO
                
        $empquery  = "SELECT * ";
		$empquery .= "FROM {$table} ";
		$empquery .= "WHERE id={$post_id} "; 
		$all_rows = mysqli_query($connection, $empquery); 
    
    if($all_rows){
         foreach($all_rows as $post){ 
 
                //GET POST INFO
                $content=$post['content'];
        
        
           //GET FILE TYPE                      
                if($post['is_file']){
                    if($post['file_type']){
                    $summary = "<a href='".$page.".php?post_id={$post_id}'><i class=\"fa fa-file-text-o fa-5x\"></i></a>";
                    }else{
                    $summary = "<a href='".$page.".php?post_id={$post_id}'><img onerror=\"if (this.src != 'img/default_img.png') this.src = 'img/default_img.png';\" src=\"".$content."\" /></a>";
                    }
                }else{
                    $summary = substr($content, 0, 100);
                }
            
            
            
                
        $img_query2  = "SELECT * ";
		$img_query2 .= "FROM profile_img ";
		$img_query2 .= "WHERE user_id={$post[$author]} AND current=1"; 
		$all_imgs2 = mysqli_query($connection, $img_query2); 
        
        if(!empty($all_imgs2)){
        $img_array2= mysqli_fetch_assoc($all_imgs2);
  if(!empty($img_array2)){
            $avatar="<img  src=\"{$img_array2['filepath']}\" title=\"View Profile!\" />";
  }else{
            $avatar="<img  src=\"img/default_avatar.png\" title=\"View Profiles\" />";
        }
 
        }else{
            $avatar="<img  src=\"img/default_avatar.png\" title=\"View Profiles\" />";
        }
            
 
            
   
            
                 echo "
        <div class='feed_content'>
        <span class='right'>".$post{'datetime'}."&nbsp; <a href=\"bookmarks.php?remove=".$post['id']."&group=1\" ><i style=\"color:red\" title=\"Remove Bookmark\" class=\"fa fa-trash-o\"></i></a></span>
        <br/>
        <span class=\"post-left\">
            <a href='member_profile.php?user_id={$post[$author]}'>".$avatar."<br/>  ".$name_array['first_name']." ".$name_array['last_name']."</a>
            </span>
       
        <span class=\"post-right\">
        
            <a href='".$page.".php?post_id={$post_id}'><h2>".$post['title']."</h2></a> <br />

            <span id=\"summary\">".$summary."... </span><br/><br/>

            <a href='".$page.".php?post_id={$post_id}'>Read More</a> 

             
         
        </span> 
        </div> "; 
         }//end foreach
        
    }//end if post found
 
    
       
           }//end foreach
    
 }else{
    echo "<p>You have not bookmarked any posts! Look for the <i class=\"fa fa-bookmark-o\"></i> icon to save a post!</p>";
}

mysqli_free_result ($r); 
      }
?>
</div>
</div>
</div>
<?php include("inc/footer.php"); ?> 