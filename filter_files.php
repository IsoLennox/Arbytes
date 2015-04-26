<?php include("inc/header.php"); ?>  
<div id="page">

 <?php
 
//FILTER fileS

$member_id=$_GET['member_selected'];

$member_query  = "SELECT * ";
		$member_query .= "FROM members WHERE group_id={$_SESSION['group_id']} ";
		$member_found = mysqli_query($connection, $member_query); 
        
        
        
        if(!empty($member_found)){
            
            $member_array= mysqli_fetch_assoc($member_found);
            
              echo "<form action=\"filter_files.php?member_id={$member_array['id']}\" >";
     
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
    
redirect_to("files.php");

}else{

 
        $member_query  = "SELECT * ";
        $member_query .= "FROM members WHERE id={$member_id} ";
        $member_found = mysqli_query($connection, $member_query); 


        if(!empty($member_found)){
            $member_array= mysqli_fetch_assoc($member_found);
            foreach($member_found as $member){
                echo "<h3  class=\"headings\">files by ".$member['first_name']." ".$member['last_name']."</h3>";
            }
        }else{
        echo "This member does not exist";
        }
    
    echo "<hr/>";
    
    
    
    //query to view files that belong to your group
$query  = "SELECT * ";
		$query .= "FROM files ";
		$query .= "WHERE author_id={$member_id} ORDER BY id DESC"; 
		$all_files = mysqli_query($connection, $query); 
        $files_array= mysqli_fetch_assoc($all_files);

 

        if(!empty($files_array)){ 

            foreach($all_files as $file){
 
                
                
                 $query  = "SELECT * ";
		$query .= "FROM members ";
		$query .= "WHERE id={$file['author_id']} "; 
		$all_files = mysqli_query($connection, $query); 
                
                if($all_files){
        $array= mysqli_fetch_assoc($all_files);
                }
                
                $content=$file['content'];
                $summary = substr($content, 0, 100); 
                
                if($file['type']==0){
                    //is image
                     echo "<div class='files'> <a href='file_single.php?file_id={$file['id']}'><img src={$file['filepath']} title=\"file-icon\" /></a><span class='right'> <a href='file_single.php?file_id={$file['id']}'><strong>".$file['title']."</strong></a> <br /><a href='member_profile.php?user_id={$file['author_id']}'>".$array['first_name']." ".$array['last_name']."</a> <br />  ".$file{'datetime'}."</span><br/></div> "; 
             
                    
                }//end check file type
                
                
                if($file['type']==1){
                    //is docx, rtf, csv, or txt file
                     echo "<div class='files'> <a href='file_single.php?file_id={$file['id']}'><img src=\"img/file.PNG\" title=\"file-icon\" /></a><span class='right'> <a href='file_single.php?file_id={$file['id']}'><strong>".$file['title']."</strong></a> <br /><a href='member_profile.php?user_id={$file['author_id']}'>".$array['first_name']." ".$array['last_name']."</a> <br />  ".$file{'datetime'}."</span><br/></div> "; 
               
                    
                }//end check file type
                
                
                
            }
 
        
        
        }elseif(empty($array)){
            echo "No files";
        }
    
    
    
    
}





include("inc/footer.php"); ?> 