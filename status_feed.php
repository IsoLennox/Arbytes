<?php include("inc/header.php"); ?> 
 
 <div id="page">
     <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
 <h2 class="headings">Status Feed<span class="right"><a href="following.php"><i class="fa fa-users"> Following</i></a></span></h2>
 
 
 
 	<article class="label">
		<section class="label-title">
 		 
		</section>
		<section class="label-description">  
 
            
            
                 <div class="tabbedPanels">
    <ul class="tabs">
        <li><a href="#panel1" tabindex="1"><i class="fa fa-pencil"></i>  Create Post</a></li>  
        <li><a href="#panel2" tabindex="2"><i class="fa fa-upload"></i>  Upload File</a></li> 
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
<!--     </section>-->
     
     
 
 
  <?php 


//GET ALL status POSTS


$q = "SELECT * FROM status WHERE is_private=0 ORDER BY id DESC"; 
$r = @mysqli_query ($connection, $q); 
 

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
//DISPLAY AL status POSTS
    
    $status_author=$row['user_id'];
    
    
    
    
        $emp_query  = "SELECT * ";
		$emp_query .= "FROM following_status WHERE you = {$_SESSION['user_id']} AND following = {$status_author}"; 
		$all_emps = mysqli_query($connection, $emp_query); 
    if($all_emps){
        $following=mysqli_fetch_assoc($all_emps); 
        
        if(!empty( $following['following'])){
         
        //following or YOU, show status 
        
                        
$comment_count=array();
 
                
                
        $empquery  = "SELECT * ";
		$empquery .= "FROM members ";
		$empquery .= "WHERE id={$row['user_id']} "; 
		$all_rows = mysqli_query($connection, $empquery); 
        $name_array= mysqli_fetch_assoc($all_rows);
 
                
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
            
            
            
                
        $img_query2  = "SELECT * ";
		$img_query2 .= "FROM profile_img ";
		$img_query2 .= "WHERE user_id={$row['user_id']} AND current=1"; 
		$all_imgs2 = mysqli_query($connection, $img_query2); 
        
        if(!empty($all_imgs2)){
        $img_array2= mysqli_fetch_assoc($all_imgs2);
  if(!empty($img_array2)){
            $avatar="<img src=\"{$img_array2['filepath']}\" title=\"View Profile!\" />";
  }else{
            $avatar="<img src=\"img/default_avatar.png\" title=\"View Profiles\" />";
        }
 
        }else{
            $avatar="<img src=\"img/default_avatar.png\" title=\"View Profiles\" />";
        }
            
 
           //GET BOOKMARK
                    $bookmarkq = "SELECT * FROM bookmarks WHERE user_id={$_SESSION['user_id']} AND post_id={$row['id']} ORDER BY id DESC"; 
                    $bookmarkresult = @mysqli_query ($connection, $bookmarkq);  

                    $num_bookmarks = mysqli_num_rows($bookmarkresult);
                    if($num_bookmarks>=1){
                        $bookmark =" <a href=\"bookmarks.php?remove=".$row['id']."&group=0\" ><i title=\"Remove Bookmark\" class=\"fa fa-bookmark\"></i></a>";
                       
 
                    }else{
                       $bookmark =" <a href=\"bookmarks.php?add=".$row['id']."&group=0\" ><i title=\"Bookmark This Post\" class=\"fa fa-bookmark-o\"></i></a>";
                    }
                
            
   
            
                 echo "
        <div class='feed_content'>
        <span class='right'>".$row{'datetime'}."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$bookmark."</span>
        <br/>
        <span class=\"post-left\">
            <a href='member_profile.php?user_id={$row['user_id']}'>".$avatar."<br/>  ".$name_array['first_name']." ".$name_array['last_name']."</a>
            </span>
       
        <span class=\"post-right\">
        
            <a href='status_single.php?post_id={$row['id']}'><h2>".$row['title']."</h2></a> <br />

            <span id=\"summary\">".$summary."   </span><br/><br/>

            <a href='status_single.php?post_id={$row['id']}'>Read More</a> 

            <br/><br/>". count($comment_count)." comments<br/>
         
        </span> 
        </div> "; 
                
        
 
 
    }//end check if following
       
           }//end search foollowing_status 
    
    

} // End of WHILE loop. 

mysqli_free_result ($r); 


//LINKS!!

if ($pages > 1) { 
    
    
    echo '<br /><div id="page_count">';
    $current_page = ($start/$display) + 1; 
    
    // CREATE PREVIOUS LINK
    if ($current_page != 1) { 
        echo '<a href="paginate.php?s=' . ($start - $display) .    '&p=' . $pages . '">Previous</a> '; 
                        }// end if current page
    
    for ($i = 1; $i <= $pages; $i++ ){ 
        if ($i != $current_page) {  
            echo '<a href="paginate.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '">' . $i . '</a> '; 
        }else {  
            echo '<span id="current_page">'.$i . '</span> '; 
        } 
    }//end for
    
    
    
    // CREATE NEXT LINK
    
    if ($current_page != $pages) { 
        echo '<a href="paginate.php?s=' . ($start + $display) . '&p=' . $pages . '">Next</a>'; 
    } //end next link
    
    
     echo '</div>'; 
} // End of links section. 
?>
</div>
</div>
</div>
<?php include("inc/footer.php"); ?> 