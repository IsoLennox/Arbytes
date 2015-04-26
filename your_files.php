<?php include("inc/header.php"); 


//$join_query = "SELECT * FROM members WHERE id='{$_SESSION['user_id']}'"; 
//$result = mysqli_query ($connection, $join_query);

find_user_by_id($_SESSION['user_id']);
$result=$user_set;
 
?>

 <div id="page">
 <?php 
echo message();
echo form_errors($errors); 
     ?>
     
     <h2 class="headings">Your Files 
        <i title="View Files" class="fa fa-file-text-o"></i>
 </h2>
     <form id="groupsearch" action="search.php?your_files" method="post">
        <input type="text" name="query" value="" placeholder="Search Your Files" />   
 
<!--        //submit button with font awesome icon-->
      <input type="submit" name="submit" value="&#xf002;" />
        </form> 
 
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

 


$q = "SELECT * FROM status WHERE user_id={$_SESSION['user_id']} AND is_file=1 ORDER BY id DESC"; 

$r = @mysqli_query ($connection, $q); 
 

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

        $content=$row['content'];

        if($row['file_type']){
            $summary = "<a href='status_single.php?post_id={$row['id']}'><i class=\"fa fa-file-text-o fa-5x\"></i></a>";
        }else{
            $summary = "<a href='status_single.php?post_id={$row['id']}'><img onerror=\"if (this.src != 'img/default_img.png') this.src = 'img/default_img.png';\" src=\"".$content."\" /></a>";
        }


        echo "
        <div class='post_list'>
        <h2><a href='status_single.php?post_id={$row['id']}'>".$row['title']."</a></h2> 
        ".$row{'datetime'}."
        <br/><br/> ".$summary."</div> "; 
        
} // End of WHILE loop. 

mysqli_free_result ($r); 

 

echo "</div>";
include("inc/footer.php"); ?> 