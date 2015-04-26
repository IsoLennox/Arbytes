<?php include("inc/header.php"); ?> 
<?php

 

?>
 

    
     

 <div id="page">
     <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
 <h2 class="headings"><?php if($_SESSION['is_group']==0){
    //this is a group
     echo "Group "; } ?>Files</h2>
 
 
 <section class="wrapper">
	<div class="container" id="accordian">
 	<article class="label">
		<section class="label-title">
			<h1 class="name"><img src="img/icons/tiny-newpost.png"/> Upload A File</h1>
		 
		</section>
		<section class="label-description"> 

<form action="upload_file.php" method="post" enctype="multipart/form-data">
   <h6>Accepted file types: png, jpg, gif, docx, rtf, txt, css, php, html</h6>
    Select file or image to upload:
    <input type="file" name="image" id="fileToUpload"><br/>
    Title:
    <input type="text" name="title" value="" ><br/><br/>
    <input type="submit" value="Upload File" name="submit">
</form>
		</section>
	</article>
</div>
     </section>
 
 
     
  <?php

$page_title = 'View the Current Users'; 
$display = 6;

   
if (isset($_GET['p']) && is_numeric($_GET['p'])) { 
    $pages = $_GET['p'];
} else {



$q = "SELECT COUNT(id) FROM files WHERE group_id={$_SESSION['group_id']}"; 

$r = @mysqli_query ($connection, $q); 
$row = @mysqli_fetch_array ($r, MYSQLI_NUM); 
    $records = $row[0];


if ($records > $display) {  
    $pages = ceil ($records/$display); 
} else { $pages = 1; }
    
    }//end of p IF

if (isset($_GET['s']) && is_numeric($_GET['s'])) {
    $start = $_GET['s']; 
} else { 
    $start = 0; 
} 


$q = "SELECT * FROM files WHERE group_id={$_SESSION['group_id']} ORDER BY id DESC LIMIT $start, $display"; 

$r = @mysqli_query ($connection, $q); 
 

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

    
    //PRINT RECORDS 
                       
$comment_count=array();
                //get comment count
$query  = "SELECT * ";
$query .= "FROM file_comments ";
$query .= "WHERE file_id={$row['id']} "; 
$all_comments = mysqli_query($connection, $query); 
$comments_array= mysqli_fetch_assoc($all_comments);

                foreach($all_comments as $comment){
                    array_push($comment_count, "1");
    
                }
                
                
        $empquery  = "SELECT * ";
		$empquery .= "FROM members ";
		$empquery .= "WHERE id={$row['author_id']} "; 
		$all_rows = mysqli_query($connection, $empquery); 
        $name_array= mysqli_fetch_assoc($all_rows);
 
                
               // $content=$row['content'];
               // $summary = substr($content, 0, 100);
                
                 
 if($row['type']==0){
                    //is image
                     echo "<div class='files'> <a href='file_single.php?file_id={$row['id']}'><span id=\"wrapper\"><img id=\"thumb\" src={$row['filepath']} onerror=\"if (this.src != 'img/default_img.png') this.src = 'img/default_img.png';\" title=\"file-icon\" /></span></a><span class='right'> <a href='file_single.php?file_id={$row['id']}'><strong>".$row['title']."</strong></a> <br /><a href='member_profile.php?user_id={$row['author_id']}'>".$name_array['first_name']." ".$name_array['last_name']."</a> <br />  ".$row{'datetime'}."</span><br/><br/>". count($comment_count)." comments<br/></div> "; 
             
                    
                }//end check file type
                
                
                if($row['type']==1){
                    //is docx, rtf, csv, or txt file
                     echo "<div class='files'> <a href='file_single.php?file_id={$row['id']}'><img src=\"img/file.PNG\" title=\"file-icon\" /></a><span class='right'> <a href='file_single.php?file_id={$row['id']}'><strong>".$row['title']."</strong></a> <br /><a href='member_profile.php?user_id={$row['author_id']}'>".$name_array['first_name']." ".$name_array['last_name']."</a> <br />  ".$row{'datetime'}."</span><br/><br/>". count($comment_count)." comments<br/></div> "; 
               
                    
                }//end check file type
                
        
 
 
    
    
    

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
<?php include("inc/footer.php"); ?> 