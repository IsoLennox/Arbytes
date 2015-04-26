<?php include("inc/header.php"); ?>

 <div id="page">
    <?php 
 
if(isset($_GET['user_id'])){    
    $user_id=$_GET['user_id'];
    
    //GET USERS NAME
    
        $user_query  = "SELECT * ";
		$user_query .= "FROM members ";
		$user_query .= "WHERE id={$user_id} "; 
		$user_found = mysqli_query($connection, $user_query); 
    if($user_found){
        $user_array=mysqli_fetch_assoc($user_found);
    $who = "<a href=\"member_profile.php?user_id=".$user_id."\">".$user_array['first_name']." ".$user_array['last_name']."</a>";
        
        }
    
    
    
        
      //SEE IF FOLLOWING
$query  = "SELECT * ";
$query .= "FROM following_status ";
$query .= "WHERE you={$_SESSION['user_id']} AND following={$user_id} "; 
$all_following_status = mysqli_query($connection, $query); 
            if($all_following_status){
                
                   $num_rows = mysqli_num_rows($all_following_status);
 
     
      if($num_rows>=1){
         //you are following this user
             $follow= "<a href=\"follow.php?user_id={$user_id}&follow=0\"><i class=\"fa fa-user-times\"></i> Unfollow</a><br/><br/>";
    }else{
         $follow= "<a href=\"follow.php?user_id={$user_id}&follow=1\"><i class=\"fa fa-user-plus\"></i> Follow</a><br/><br/>";
    } 
            }else{ $follow= "nothing found"; }
    //END SEE IF FOLLOWING

}else{
    $user_id=$_SESSION['user_id'];
    $who = "Your";
     $view_files = "<span class=\"right\"><a href=\"your_files.php\"><i title=\"View Your Files\" class=\"fa fa-file-text-o\"></i>
</a> </span>";
}




echo form_errors($errors); 
            echo message();  ?>
     <h2 class="headings"><?php echo $who; ?> Status Updates  <?php echo $view_files;   ?></h2>
     <p><?php echo $follow; ?></p>
     
     
   <?php  if($user_id==$_SESSION['user_id']){ ?>
     
<!--     SHOW CREATE POST IF YOUR FEED-->
      	<article class="label">
		<section class="label-title">
 		 
		</section>
		<section class="label-description">  
 
            
            
                 <div class="tabbedPanels">
    <ul class="tabs">
        <li><a href="#panel1" tabindex="1"><i class="fa fa-pencil"></i>  Create Post</a></li>  
        <li><a href="#panel2" tabindex="2"><i class="fa fa-upload"></i>   Upload File</a></li> 
    </ul>

    <div class="panelContainer">

        <div id="panel1" class="panel"> 
            		<form action="create_statuspost.php" method="post">
 
        <p>Title:
        <input type="text" name="title" value="" /> </p>
        
         <p>Privacy:  
        <input type="radio" name="private" value="0" checked />Public
        <input type="radio" name="private" value="1" />Only You
      </p>
        
        
         <p>Post: <br/>
    <textarea name="content" value="" rows="3" cols="80"></textarea></p>
         
      <input type="submit" name="submit" value="Create" />
    </form>

        </div><!-- END PANEL 1 -->

        <div id="panel2" class="panel">
              <form action="status_file.php?user_id=<?php echo $_SESSION['user_id']; ?>" method="post" enctype="multipart/form-data">
        <p>Title:
        <input type="text" name="title" value="" /> </p>
          <h6>Accepted file types: png, jpg, gif, docx, rtf, txt, css, php, html</h6>
    Select file or image to upload:
    <input type="file" name="image" id="fileToUpload"><br/> 
    <br/> 
             <p>Privacy:  
        <input type="radio" name="private" value="0" checked />Public
        <input type="radio" name="private" value="1" />Only You
      </p>
    <br/> 
 
    <input type="submit" value="Create" name="submit">
</form>

        </div><!-- END PANEL 3 -->

    </div> <!--   end panelcontainer  -->      
</div><!-- end tabbed panels -->
 </section>
	</article> 





 <?php
               
              }//end show upload posts if your feed
      if($user_id==$_SESSION['user_id']){ 
$q = "SELECT * FROM status WHERE user_id={$user_id} ORDER BY id DESC"; 
      }else{
      $q = "SELECT * FROM status WHERE user_id={$user_id} AND is_private=0 ORDER BY id DESC";
      }

$r = @mysqli_query ($connection, $q); 
 

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

    
    //PRINT RECORDS 
                       
$comment_count=array();

                
                
        $empquery  = "SELECT * ";
		$empquery .= "FROM members ";
		$empquery .= "WHERE id={$row['user_id']} "; 
		$all_rows = mysqli_query($connection, $empquery); 
    
        
        $is_private=$row['is_private'];
        if($is_private==1){ 
//            $privacy="<i title=\"PRIVATE\" class=\"fa fa-key\"></i>";
            $privacy="<i title=\"PRIVATE\" class=\"fa fa-lock\"></i>
";
        }else{ $privacy="";}
    
    
        $content=$row['content'];
           //GET FILE TYPE                      
                if($row['is_file']){
                    if($row['file_type']){
                    $summary = "<a href='status_single.php?post_id={$row['id']}'><i class=\"fa fa-file-text-o fa-5x\"></i></a>";
                    }else{
                    $summary = "<a href='status_single.php?post_id={$row['id']}'><img onerror=\"if (this.src != 'img/default_img.png') this.src = 'img/default_img.png';\" src=\"".$content."\" /></a>";
                    }
                }else{
                    $summary = substr($content, 0, 100);
                }
     
    
                echo "<div class='feed_content'>
 
                <a href='status_single.php?post_id={$row['id']}'>
                <h2>".$privacy." ".$row['title']."</h2></a> 
             
                <br/>  ".$row{'datetime'}."

                <br/><br/> ".$summary."... <br/><br/><a href='status_single.php?post_id={$row['id']}'>Read More</a><br/><br/>
                
                </div> "; 
    
    
    
    
    
    
    
    
    
    
    
   
} // End of WHILE loop. 

mysqli_free_result ($r); 

 

echo "</div>";
include("inc/footer.php"); ?> 