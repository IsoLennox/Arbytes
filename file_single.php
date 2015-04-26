<?php include("inc/header.php"); ?> 
 
 <div id="page">
<?php

$file_id =$_GET['file_id'];
    //query to view files that belong to your group
$query  = "SELECT * ";
		$query .= "FROM files ";
		$query .= "WHERE id={$file_id} "; 
		$all_files = mysqli_query($connection, $query); 
        $files_array= mysqli_fetch_assoc($all_files);
        



        if(!empty($files_array)){ 

            foreach($all_files as $file){
                
                
                 $query  = "SELECT * ";
		$query .= "FROM members ";
		$query .= "WHERE id={$file['author_id']} "; 
		$all_files = mysqli_query($connection, $query); 
        $array= mysqli_fetch_assoc($all_files);
 
                
                $filepath=$file['filepath']; 
                
                echo message();
                
                
                if($file['type']==0){
                    //is image
                    
                echo "<div class='singlefile'><span class='right'> By: <a href='member_profile.php?user_id={$file['author_id']}'>".$array['first_name']." ".$array['last_name']."</a> |  ".$file{'datetime'}."</span><h2>".$file['title']."</h2><br/><img src=\"".$filepath."\" title=\"".$file['title']."\" /> <br/><br/> "; 
                
                if($_SESSION['admin']=="Admin " || $file['author_id']==$_SESSION['user_id']){
                    echo "<span class='right'><a href=\"delete.php?file_id={$file['id']}\" onclick='return confirm(\"DELETE this file?\");'>Delete File</a></span>";
                    
                        
                }
                    
                }//end check file type
                
                
                if($file['type']==1){
                    //is docx, rtf, csv, or txt file
                    
                    $preview=file_get_contents($filepath, FILE_USE_INCLUDE_PATH);
                echo "<div class='singlefile'><span class='right'> By: <a href='member_profile.php?user_id={$file['author_id']}'>".$array['first_name']." ".$array['last_name']."</a> |  ".$file{'datetime'}."</span><h2>".$file['title']."</h2><br/><a href=\"".$filepath."\"><img src=\"img/icons/downloadIcon.png\" title=\"Download this file\" />  Download File</a> <br/><br/>Preview:<h6><em>Please note that only .txt file will be formatted for readability.<br/> .docx, .csv, and .rtf will need to be opened in your text editor of choice.</em></h6><br/><div id=\"preview\"> ".$preview."  </div> "; 
                
                if($_SESSION['admin']=="Admin " || $file['author_id']==$_SESSION['user_id']){
                    echo "<span class='right'><a href='edit_file.php?file_id={$file['id']}'><img src=\"img/icons/tiny-newpost.png\"/> Edit file</a></span>";
                }
                    
                }//end check file type
                
                
                
//                echo "<br/></div><hr/>"; 
            }
 
        
        
        }elseif(empty($files_array)){
            echo "This file does not exist.";
        }
 
?>
     <br/><hr/>
     <br/>
     <br/>
  <section class="wrapper">
	<div class="container" id="accordian">
 	<article class="label">
		<section class="label-title">
			<h1 class="name"><img src="img/icons/tiny-newpost.png"/> Create comment</h1>
<!--			<section class="subtitle">Subtitle Area</section>-->
		</section>
		<section class="label-description"> 
    
    <form action="create_file_comment.php?file_id=<?php echo $file_id; ?>" method="post">
 
         
         <p>comment: <br/>
    <textarea name="content" value="" rows="10" cols="80"></textarea></p>
         
      <input type="submit" name="submit" value="Create comment" />
    </form>
		</section>
	</article>
</div>
     </section>

<h3 class="headings">Comments</h3>
<?php
$query  = "SELECT * ";
$query .= "FROM file_comments ";
$query .= "WHERE file_id={$file_id} ORDER BY id DESC "; 
$all_comments = mysqli_query($connection, $query); 
 

if(!empty($all_comments)){ 
    
     $comments_array= mysqli_fetch_assoc($all_comments);

    foreach($all_comments as $comment){
 

    $query  = "SELECT * ";
    $query .= "FROM members ";
    $query .= "WHERE id={$comment['author']} "; 
    $all_members = mysqli_query($connection, $query); 
    $emp_array= mysqli_fetch_assoc($all_members);
 
    echo "<div class='note'>From: <a href='member_profile.php?user_id={$comment['author']}'>".$emp_array['first_name']." ".$emp_array['last_name']."</a><span class='right'> ".$comment{'datetime'}."</span><br/><br/>".$comment['content']." <br/>";

    if($_SESSION['admin']=="Admin " || $file['author']==$_SESSION['user_id'] || $comment['author']==$_SESSION['user_id'] ){
            echo "<span class='right'><a href='delete.php?file_comment_id={$comment['id']}&parent_file_id={$file_id}' onclick=\"return confirm('DELETE this comment?');\"><img src=\"img/icons/delete.png\"/> Delete Comment</a></span>";
    }
    echo "<br/></div>  "; 

    }
    
   


}else{
    echo "No Comments";
     //echo $comment_count." comments";
}

        ?>

    <br /> 
  </div>

</div>
<?php include("inc/footer.php"); ?> 