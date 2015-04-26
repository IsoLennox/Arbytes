<?php include("inc/header.php"); ?> 
 
 <div id="page">
<?php

$filepath =$_GET['filepath'];
    //query to view files that belong to your group
        $query  = "SELECT * ";
		$query .= "FROM profile_img ";
		$query .= "WHERE filepath='{$filepath}' "; 
		$all_files = mysqli_query($connection, $query);
if($all_files){
        $files_array= mysqli_fetch_assoc($all_files);




        if(!empty($files_array)){ 

            foreach($all_files as $file){
                
                
                 $query  = "SELECT * ";
		$query .= "FROM members ";
		$query .= "WHERE id={$file['user_id']} "; 
		$all_files = mysqli_query($connection, $query); 
        $array= mysqli_fetch_assoc($all_files);
 
                
                $filepath=$file['filepath']; 
                
                echo message();

                echo "<div class='singlefile'><span class='right'> By: <a href='member_profile.php?user_id={$file['user_id']}'>".$array['first_name']." ".$array['last_name']."</a></span><br/><img src=\"".$filepath."\" /> <br/><br/> "; 
                
             
            
if($file['user_id']==$_SESSION['user_id']){
                    echo "<span class='right'><a href='update_profile_img.php?filepath={$filepath}'><i class=\"fa fa-camera\"></i> Make Current Profile Image</a>
                    <br/>
                    <br/>
       <a href='delete.php?filepath={$filepath}'><i class=\"fa fa-trash-o\"></i> Delete Image</a>
                    
                    </span>";
                }
                    
        
            }
 
        
        
        }elseif(empty($files_array)){
            echo "This file does not exist.";
        }
}
 
?>
     <br/><hr/>
     <br/>
     <br/>
  <section class="wrapper">
	<div class="container" id="accordian">
 	<article class="label">
		<section class="label-title">
			<h1 class="name"><i class="fa fa-pencil"></i> Create comment</h1>
<!--			<section class="subtitle">Subtitle Area</section>-->
		</section>
		<section class="label-description"> 
		
		<p>This feature is not available yet.</p>
<!--
    
    <form action="create_file_comment.php?file_id=<?php echo $file_id; ?>" method="post">
 
         
         <p>comment: <br/>
    <textarea name="content" value="" rows="10" cols="80"></textarea></p>
         
      <input type="submit" name="submit" value="Create comment" />
    </form>
-->
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
            echo "<span class='right'><a href='delete_file_comment.php?comment_id={$comment['id']}&file_id={$file_id}' onclick=\"return confirm('DELETE this comment?');\"><i class=\"fa fa-trash-o\"></i> Delete Comment</a></span>";
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