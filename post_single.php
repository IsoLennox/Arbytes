<?php include("inc/header.php"); ?> 
 
 <div id="page">
 
<?php

$post_id =$_GET['post_id'];

    //query to view posts that belong to your group
$query  = "SELECT * ";
		$query .= "FROM posts ";
		$query .= "WHERE id={$post_id} "; 
		$all_posts = mysqli_query($connection, $query); 
        $posts_array= mysqli_fetch_assoc($all_posts);
        
?>
   <p><a href="posts.php?group_id=<?php echo $posts_array['group_id']; ?>">&laquo; Back To Group Feed</a></p>
   <?php


        if(!empty($posts_array)){ 

            foreach($all_posts as $post){
                
                
                 $query  = "SELECT * ";
		$query .= "FROM members ";
		$query .= "WHERE id={$post['author']} "; 
		$all_posts = mysqli_query($connection, $query); 
        $array= mysqli_fetch_assoc($all_posts);
 
                
                $content=$post['content']; 
                
                if($post['is_file']){
                    if($post['file_type']){
                        
                        $preview=file_get_contents($content, FILE_USE_INCLUDE_PATH);
                        
                        $summary = "<a href=\"".$content."\" >Download File</a><br/>
                       <br/><br/>Preview:<h6><em>Please note that only .txt file will be formatted for readability.<br/> .docx, .csv, etc will need to be opened in your text editor of choice.</em></h6><br/><div id=\"preview\"> ".$preview."  </div>";
                        
                        
                        
                    }else{
                       $summary = "<img onerror=\"if (this.src != 'img/default_img.png') this.src = 'img/default_img.png';\" src=\"".$content."\" />";
                    }
                }else{
                    $summary = $content;
                }
                
                echo message();
                
                //GET BOOKMARK
                    $q = "SELECT * FROM bookmarks WHERE user_id={$_SESSION['user_id']} AND post_id={$post['id']} ORDER BY id DESC"; 
                    $r = @mysqli_query ($connection, $q);  

                    $num_rows = mysqli_num_rows($r);
                    if($num_rows>=1){
                        $bookmark =" <a href=\"bookmarks.php?remove=".$post['id']."&group=1\" ><i title=\"Remove Bookmark\" class=\"fa fa-bookmark\"></i></a>";
                       
 
                    }else{
                       $bookmark =" <a href=\"bookmarks.php?add=".$post['id']."&group=1\" ><i title=\"Bookmark This Post\" class=\"fa fa-bookmark-o\"></i></a>";
                    }
                
               
                
                
                echo "<div class='singlepost'>".$bookmark."<span class='right'> By: <a href='member_profile.php?user_id={$post['author']}'>".$array['first_name']." ".$array['last_name']."</a> |  ".$post{'datetime'}."  </span><h2>".$post['title']."</h2><br/>".$summary." <br/>  "; 
                
                if($_SESSION['admin']=="Admin " || $post['author']==$_SESSION['user_id']){
                    echo "<span class='right'><a href='edit_post.php?post_id={$post['id']}&post_author={$post['author']}'><i class=\"fa fa-pencil\"></i> Edit post</a></span>";
                }
                echo "";
                echo "<br/></div><hr/>"; 
            }
 
        
        
        }elseif(empty($posts_array)){
            echo "This post has been deleted by the author.";
        }
 
?>
  <section class="wrapper">
	<div class="container" id="accordian">
 	<article class="label">
		<section class="label-title">
			<h1 class="name"><i class="fa fa-pencil"></i> Create comment</h1>
<!--			<section class="subtitle">Subtitle Area</section>-->
		</section>
		<section class="label-description"> 
    
    <form action="create_comment.php?post_id=<?php echo $post_id; ?>" method="post">
 
         
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
$query .= "FROM comments ";
$query .= "WHERE post_id={$post_id} "; 
$all_comments = mysqli_query($connection, $query); 
$comments_array= mysqli_fetch_assoc($all_comments);

  

//$comment_count=0;
//foreach($all_comments as $comment_count){
//        $comment_count+="1";
//    }


if(!empty($comments_array)){ 
    
    
   //echo "<h3>".$comment_count." Comments</h3>";

    foreach($all_comments as $comment){
 

    $query  = "SELECT * ";
    $query .= "FROM members ";
    $query .= "WHERE id={$comment['author']} "; 
    $all_comments = mysqli_query($connection, $query); 
    $array= mysqli_fetch_assoc($all_comments);


    $content=$comment['content']; 

    
    echo "<div class='post'>From: <a href='member_profile.php?user_id={$comment['author']}'>".$array['first_name']." ".$array['last_name']."</a><span class='right'> ".$comment{'datetime'}."</span><br/><br/>".$content." <br/>";

    if($_SESSION['admin']=="Admin " || $post['author']==$_SESSION['user_id'] || $comment['author']==$_SESSION['user_id'] ){
            echo "<span class='right'><a href='delete.php?comment_id={$comment['id']}&parent_post_id={$post_id}' onclick=\"return confirm('DELETE this comment?');\"><i class=\"fa fa-trash-o\"></i> Delete Comment</a></span>";
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